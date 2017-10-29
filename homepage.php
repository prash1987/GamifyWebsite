<?php 
    
    include("config.php");
    include("header.php");    
    include("classes/UserClass.php");
    include("classes/PostClass.php");
    include("classes/MessageClass.php");


	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
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
		$post->submitPost($_POST['post_text'], $_POST['post_location'], $_POST['post_time'], $_POST['post_game'], $_POST['post_gender'], $upload_image);
	}
?>
	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
        
		<link href="css/styles.css" rel="stylesheet">
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
				alert('data is reached' + id);
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

	</head>

	<br><br><br>
	<div class="user_details column">
		<br><br>
		<a href="<?php echo $userLoggedIn;?>">  <img height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn;?>">
			<?php echo $user_obj->getFirstAndLastName(); ?>
			</a>
			<br>
			<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
			echo "Contact: " . $user_obj->getUserContact() ;
			?>
		</div>
			<form action="homepage.php" name="pref_form" method="POST">
				<br>
				<fieldset>
         			<legend>Select Pref</legend>
         				<p>Gender Pref</p>
	       				<input type = "radio" id = "gender_pref_men_only" name="gender_pref" value = "men" />
     					<label for = "event_pref_men_only">Men Only</label> 
     					<br>
     					<input type = "radio" id = "gender_pref_women_only" name= "gender_pref" value = "women" />
     					<label for = "event_pref_women_only">Women Only</label> 
     					<br>	
						<input type = "radio" id = "gender_pref_all" name= "gender_pref" value = "all" />
     					<label for = "event_pref_women_only">All Events</label> 
     					<br>
    					<!--input type = "submit" value="Change Preferences" /-->
     					<!--input type = "button" name ="clear_pref_button" id="clear_pref_button" value="Clear Preferences" onclick="noPrefFunction()" /-->
         				<p>Game Pref</p>
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
     					<input type = "submit" value="Change Preferences" />
     					<br><br>
     					<input type = "button" name ="no_pref_button" id="no_pref_button" value="Clear Preferences" onclick="noPrefFunction()" />
     			</fieldset>

    		</form>
		
	</div>

	<div class="main_column column">
		<form class="post_form" action="homepage.php" method="POST" enctype="multipart/form-data">
			<textarea name="post_text" id="post_text" placeholder="Post here" required></textarea>
			<input type="submit" name="post" id="post_button" value="Post" style="color:#000000"><br>
			<label for="post_image">Upload Image</label> <input type="file" name="post_image" id="post_image">
			<input type="text" name="post_location" id = "post_location" placeholder="Location" required>
			<input type="datetime-local" name="post_time" id = "post_time" placeholder="Date and Time" required>
			
		    <label for="post_game">Game</label>
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
		  	<br>
		  	<label for="post_gender">Gender</label>
			
			  <label class="form-check-label">
			    <input class="form-check-input" type="radio" name="post_gender" id="inlineRadio1" value="A" checked="checked"> All
			  </label>
			
			  <label class="form-check-label">
			    <input class="form-check-input" type="radio" name="post_gender" id="inlineRadio2" value="M"> Male
			  </label>
			
			  <label class="form-check-label">
			    <input class="form-check-input" type="radio" name="post_gender" id="inlineRadio3" value="F"> Female
			  </label>
			
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
</body>
</html>