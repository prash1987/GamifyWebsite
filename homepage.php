<?php 

	include("header.php");   

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['login_user'])){
		$userLoggedIn = $_SESSION['login_user'];
	}
	else{
		header("Location: login.php");
	}

	$user_obj = new UserClass($con, $userLoggedIn);

	if(isset($_POST['post'])){
		if(isset($_FILES['post_image'])){
			$upload_image=$_FILES['post_image']['name'];
			$folder="images/";
			move_uploaded_file($_FILES['post_image']['tmp_name'], $folder . $_FILES['post_image']['name']);
		}

		$post = new PostClass($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], $_POST['post_location'], $_POST['post_time'], $_POST['post_game'], $_POST['post_gender'], $upload_image,
		$_POST['post_type']);
	}

    $details = json_decode(file_get_contents("http://ipinfo.io/"));
    $city_name= $details->city;

	$data_member= "";
	$options = "";
	$options .= "<option value='0' selected>Public</option>";
	$sqlMember = mysqli_query($con, "SELECT group_id, group_name FROM groups WHERE members like '%" . $userLoggedIn . "%';");
	while($row_member = mysqli_fetch_array($sqlMember)) {
		$member_group_name = $row_member['group_name'];
		$member_group_id = $row_member['group_id'];		
		// To display group names in 3rd column	
		$div_member = "<div style='font-size:14px;'><a href='group_posts.php?group_id=" . $member_group_id . "'>" . $member_group_name . "</a></div>";
		$data_member .= $div_member . "<br>";
		$value =  "<option value='" . $member_group_id . "'>" . $member_group_name . "</option>";
		$options .= $value; 
	}
?>
	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">        
		<link href="css/styles.css" rel="stylesheet">
		<script src = "js/search.js"></script>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

   		<script>

			function noPrefFunction()
			{
				// Unselecting Gender Preferences
				document.getElementById("gender_pref_men_only").checked = false;
				document.getElementById("gender_pref_women_only").checked = false;
				document.getElementById("gender_pref_all").checked = false;

				//Unselecting Game preferences
				document.getElementById("game_pref_cricket").checked = false;
				document.getElementById("game_pref_badminton").checked = false;
				document.getElementById("game_pref_tennis").checked = false;
				document.getElementById("game_pref_squash").checked = false;
				document.getElementById("game_pref_running").checked = false;
				document.getElementById("game_pref_football").checked = false;
				document.getElementById("game_pref_basketball").checked = false;
				document.getElementById("game_pref_cycling").checked = false;
				document.getElementById("game_pref_gym").checked = false;
				document.getElementById("game_pref_dance").checked = false;
				document.getElementById("game_pref_martialarts").checked = false;
				document.getElementById("game_pref_dispall").checked = false;
			    document.pref_form.action = "homepage.php";
			    document.pref_form.submit(); 
			    return true;
			}

			function delete_function(id){
				//alert('data is reached' + id);
				$.ajax({
                	type:'POST',
                	data: {'post_id' : id},
                	url: 'delete_post.php',
                	success: function(data) {
                    	location.reload();
                	}
          		});
			}
		</script>


		<style>
			.mySlides {
				display:none;
				z-index: -1;
			}

			input[type="file"] {
				display: inline-block !important; 
			}
		</style>
		<style>
			#myBtn {
			  display: none;
			  position: fixed;
			  bottom: 20px;
			  right: 30px;
			  z-index: 99;
			}
		</style>
	</head>


	<body onload="showPosition(1)">  
	<br><br><br>
	<div class="col-md-2 column col-md-offset-0-5">
	<!--<div class="user_details column">-->
		
		<a href="<?php echo 'profile.php?profile_username=' . $userLoggedIn;?>"><img height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>"> </a>

		<br><br>

		<div class="user_details_left_right">
			<a href="<?php echo 'profile.php?profile_username=' . $userLoggedIn;?>">
			<b><?php echo $user_obj->getFirstAndLastName(); ?></b>
			</a>
			<br>
			<?php echo "<span id='location'>Location: " . $user_obj->getUserLocation() . "</span><br>"; 
			echo "Contact: " . $user_obj->getUserContact() ; ?>
		
			<form action="homepage.php" name="pref_form" method="POST">
				<br>
				<fieldset>
         			<h4><b>Select Preferences</b></h4>
         				<h5><b>Gender Preferences</b></h5>
	       				<input type = "radio" id = "gender_pref_men_only" name="gender_pref" value = "men" />
     					<label class="pref_label" for = "event_pref_men_only">Men Only</label> 
     					<br>
     					<input type = "radio" id = "gender_pref_women_only" name= "gender_pref" value = "women" />
     					<label for = "event_pref_women_only">Women Only</label> 
     					<br>	
						<input type = "radio" id = "gender_pref_all" name= "gender_pref" value = "all" />
     					<label for = "event_pref_women_only">All Events</label> 
     					<br>
         				<h5><b>Game Preferences</b></h5>
	       				<input type = "checkbox" id = "game_pref_cricket" name="game_pref_cricket" value="Cricket"/>
     					<label for = "game_pref_cricket">Cricket</label> 
     					<br>
     					<input type = "checkbox" id = "game_pref_badminton" name= "game_pref_badminton" value="Badminton"/>
     					<label for = "game_pref_badminton">Badminton</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_tennis" name= "game_pref_tennis" value="Tennis"/>
     					<label for = "game_pref_tennis">Tennis</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_squash" name= "game_pref_squash" value="Squash"/>
     					<label for = "game_pref_squash">Squash</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_running" name= "game_pref_running" value="Running"/>
     					<label for = "game_pref_running">Running</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_football" name= "game_pref_football" value="Football"/>
     					<label for = "game_pref_football">Football</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_basketball" name= "game_pref_basketball" value="Basketball"/>
     					<label for = "game_pref_basketball">Basketball</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_cycling" name= "game_pref_cycling" value="Cycling"/>
     					<label for = "game_pref_cycling">Cycling</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_gym" name= "game_pref_gym" value="Gym"/>
     					<label for = "game_pref_gym">Gym</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_dance" name= "game_pref_dance" value="Dance"/>
     					<label for = "game_pref_dance">Dance</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_martialarts" name= "game_pref_martialarts" value="MartialArts" />
     					<label for = "game_pref_martialarts">Martial Arts</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_dispall" name= "game_pref_dispall" value="All" />
     					<label for = "game_pref_dispall">All Games</label>
     					<br><br>
     					<input type = "submit" class="btn btn-primary btn-xs" value="Change Preferences" />
     					<br><br>
     					<input type = "button" class="btn btn-primary btn-xs" name ="no_pref_button" id="no_pref_button" value="Clear Preferences" onclick="noPrefFunction()" />
     			</fieldset>

    		</form>
		</div>
	<!--</div>-->
</div>

	<div class="col-md-6 column col-md-offset-0-5">		
		<form class="post_form" action="homepage.php" method="POST" enctype="multipart/form-data">
			<textarea name="post_text" id="post_text" placeholder="Post here" required></textarea>
			<input type="submit" name="post" id="post_button" value="Post" class="btn btn-primary btn-lg" ><br><br>
			
			<label for="post_game">Game:  </label>
			    <select id="post_game" name="post_game">
			      <option value="Cricket">Cricket</option>
			      <option value="Badminton">Badminton</option>
			      <option value="Tennis">Tennis</option>
			      <option value="Squash">Squash</option>
				  <option value="Running">Running</option>
				  <option value="Football">Football</option>
				  <option value="Basketball">Basketball</option>
				  <option value="Cycling">Cycling</option>
				  <option value="Gym">Gym</option>
				  <option value="Dance">Dance</option>
				  <option value="MartialArts">Martial Arts</option>
			    </select>
		  	
			<label for="post_gender" style="margin-left: 3px;">Gender Selection:  </label>
			
			<label class="form-check-label">
			    <input class="form-check-input" type="radio" name="post_gender" id="inlineRadio1" value="A" checked="checked"> All
			</label>
			
			<label class="form-check-label">
			    <input class="form-check-input" type="radio" name="post_gender" id="inlineRadio2" value="M"> Male
			</label>
			
			<label class="form-check-label">
			    <input class="form-check-input" type="radio" name="post_gender" id="inlineRadio3" value="F"> Female
			</label>

			&nbsp;&nbsp;&nbsp;&nbsp;

			<input type="text" name="post_location" id = "post_location" placeholder="Enter Location of event" width="10px" required> 
			<br>
			<label for="post_time">Event Date and Time:  </label> <input type="datetime-local" name="post_time" id = "post_time" placeholder="Date and Time" required>
		    <label for="post_image" style="margin-left: 3px;"> Upload Image:  </label>&nbsp;&nbsp;<input type="file" name="post_image" id="post_image">
		    <br>

		    <label for="post_type">Post Type:  </label>
			    <select id="post_type" name="post_type">
			      <?php	
						echo $options;
			      ?>
			    </select>		  	
			
			<hr>
		</form>

		<?php 
				$gender_pref = "";
				$game_pref = "";
				$post = new PostClass($con, $userLoggedIn);
				//$user_location = $_POST['post_location'];
				if(isset($_POST['gender_pref'])){
					if ($_POST['gender_pref'] == "men")
						$gender_pref = 'M';
					elseif ($_POST['gender_pref'] == "women")
						$gender_pref = 'F';
					elseif ($_POST['gender_pref'] == "all")
						$gender_pref = 'A';
				}
		
				if(isset($_POST['game_pref_cricket'])){
					$game_pref .= "'Cricket',";
				}
				if(isset($_POST['game_pref_badminton'])){
					$game_pref .= "'Badminton',";
				}
				if(isset($_POST['game_pref_tennis'])){
					$game_pref .= "'Tennis',";
				}
				if(isset($_POST['game_pref_squash'])){
					$game_pref .= "'Squash',";
				}
				if(isset($_POST['game_pref_running'])){
					$game_pref .= "'Running',";
				}
				if(isset($_POST['game_pref_football'])){
					$game_pref .= "'Football',";
				}
				if(isset($_POST['game_pref_basketball'])){
					$game_pref .= "'Basketball',";
				}
				if(isset($_POST['game_pref_cycling'])){
					$game_pref .= "'Cycling',";
				}
				if(isset($_POST['game_pref_gym'])){
					$game_pref .= "'Gym',";
				}
				if(isset($_POST['game_pref_dance'])){
					$game_pref .= "'Dance',";
				}
				if(isset($_POST['game_pref_martialarts'])){
					$game_pref .= "'MartialArts',";
				}
				$game_pref = rtrim($game_pref,',');
				if(isset($_POST['game_pref_dispall'])){
					$game_pref = "All";
				}
				$game_pref = strtoupper($game_pref);

				$post->loadPostsFriends($gender_pref, $game_pref);
				?>

	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		<h4>Groups You own/are member of</h4><br>
		<?php	
			echo $data_member;	
		?>
	</div>
	<div class="col-md-3 ads">
		<div style="max-width: 500px;">	
	  
	  		<a target="_blank" href="https://www.ebay.com/b/Mens-Fitness-Running-Shoes/158952/bn_1965202">
	  		<img class="mySlides" src="images/ads/ad_ebay.jpg" style="width:100%"></a>
	  
	  		<a target="_blank" href="http://www.indianavolleyballcamps.com/index.html">
	  		<img class="mySlides" src="images/ads/ad_volleyball.jpg" style="width:100%"></a>

	  		<a target="_blank" href="http://northamericasports.blogspot.ca/2012/09/new-nike-epl-match-ball-maxim-for.html">
	  		<img class="mySlides" src="images/ads/ad_nike.jpg" style="width:100%"></a>
	  
	  		<a target="_blank" href="https://www.anytimefitness.com/gyms/2822/bloomington-in-47401/">
	  		<img class="mySlides" src="images/ads/ad_gym.jpg" style="width:100%"></a>

	  		<a target="_blank" href="https://www.pinterest.com/pin/316659417526781056/">
	  		<img class="mySlides" src="images/ads/ad_adidas.jpg" style="width:100%"></a>

	  		<a target="_blank" href="https://www.amazon.com/Best-Sellers-Health-Personal-Care-Sports-Nutrition-Protein/zgbs/hpc/6973704011/ref=zg_bs_unv_hpc_3_6973717011_2">
	  		<img class="mySlides" src="images/ads/ad_protein.jpg" style="width:100%"></a>
		</div>

		<button onclick="topFunction()" id="myBtn" class="btn btn-primary btn-lg" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
	</div>
		
	<script>
			var myIndex = 0;
			carousel();

			function carousel() {
	    	var i;
	    	var x = document.getElementsByClassName("mySlides");
	    	for (i = 0; i < x.length; i++) {
	       		x[i].style.display = "none";  
	    	}
	    	myIndex++;
	    	if (myIndex > x.length) {myIndex = 1}    
	    	x[myIndex-1].style.display = "block";  
	    	setTimeout(carousel, 3000); // Change image every 3 seconds
			}


			// When the user scrolls down 20px from the top of the document, show the button
			// Implemented by Sagar
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			        document.getElementById("myBtn").style.display = "block";
			    } else {
			        document.getElementById("myBtn").style.display = "none";
			    }
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
			    document.body.scrollTop = 0;
			    document.documentElement.scrollTop = 0;
			}
	</script>

	<!--@Author: Harsha- User Location Checker-->

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		function getLocation() {
		    if (navigator.geolocation) {
		        navigator.geolocation.getCurrentPosition(showPosition, showError);
		    } else {
		       alert('Geolocation is not supported by this browser');
		    }
		}

		function showPosition(position) {
		    var defaultUserLocation = "<?php echo($user_obj->getUserLocation()); ?>";
		    var current_location = "<?php echo @$city_name; ?>";
		    console.log(current_location);
		         	
		            if (current_location!=defaultUserLocation) {

		            	swal("Your current location is "+defaultUserLocation+". Do you want to change it to "+current_location+"?", {
		  				buttons: ["No, Use default", "Yes"],
						})
						.then((Yes) => {
		  					if (Yes) {		  						
								var ajax_location = current_location;
								$.post("handlers/ajax_update_location.php", {location:ajax_location});
		    					swal("Your location changed to "+current_location);
		    					setTimeout(function(){location.reload();}, 2000);
		    				}
		  					else
		    			 		swal("You'll only be able to see posts in "+defaultUserLocation);
						});
		            }
		}

		function showError(error) {
		    switch(error.code) {
		        case error.PERMISSION_DENIED:
		            alet("User denied the request for Geolocation.");
		            break;
		            
		        case error.POSITION_UNAVAILABLE:
		            alert("Location information is unavailable.");
		            break;
		        case error.TIMEOUT:
		            alert("The request to get user location timed out.");
		            break;
		        case error.UNKNOWN_ERROR:
		            alert("An unknown error occurred.");
		            break;
		    }
		}
	</script>


	</body>
</html>