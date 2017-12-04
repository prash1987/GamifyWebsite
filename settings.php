	<?php  
	include("header.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
		$user_obj = new UserClass($con, $userLoggedIn);
	}
	else {
		header("Location: login.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" and (isset($_POST['userEmail']))){
	    $firstname=$_POST["firstName"];
	    $lastname=$_POST["lastName"];    
	    $contact=$_POST["userContact"];
	    $location=$_POST["userAddress"];

	    $date = $_POST["userDOB"];
    
	    if(isset($_FILES['userPic'])){
	       $errors= "";
	       $file_name = $_FILES['userPic']['name'];
	       $file_size =$_FILES['userPic']['size'];
	       $file_tmp =$_FILES['userPic']['tmp_name'];
	       $file_type=$_FILES['userPic']['type'];
	       $ext_delim=".";
	       $file_ext=strtolower(end(explode($ext_delim,$_FILES['userPic']['name'])));
	      
	       $expensions= array("jpeg","jpg","png","JPEG","JPG","PNG");
	      
	       if(in_array($file_ext,$expensions)=== false){
	          $errors="extension not allowed, please choose a JPEG or PNG file. It is " . $file_ext;
	       }
	  
	       if(empty($errors)==true){
	            $new_file_name=$_FILES['userPic']['name'];
		   		$folder="profile_pics/";
		   		move_uploaded_file($_FILES['userPic']['tmp_name'], $folder . $_FILES['userPic']['name']);
	       }else{
	        	$split_path = explode("/", $user_obj->getProPic());
	    		$new_file_name=$split_path[1];
	       }
	    }
	    else{
			$split_path = explode("/", $user_obj->getProPic());
	    	$new_file_name=$split_path[1];
	    }

	    $user_id = $user_obj->getUserName();

	    $sql = "UPDATE user set first_name='$firstname', last_name='$lastname', address='$location', dob='$date', contact='$contact', propic='$new_file_name' WHERE user_id='$user_id';";

		if ($con->query($sql) === TRUE) {
			header('Location: homepage.php');			 
			//echo "<b><p>Profile updated successfully</p></b>"; 
		}
		else {
			echo "Something went wrong. Error: " . $sql . "<br>" . $conn->error;
		}
	}
	?>

	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
		<link href="css/styles.css" rel="stylesheet">
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   	</head>

	<br><br><br><br>
	<div class="col-md-2 column col-md-offset-0-5">
		<img class="img-circle" height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>">
		<br><br>

		<div class="user_details_left_right">				
				<b><?php echo $user_obj->getFirstAndLastName(); ?></b>
				<br>
				<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
				echo "Contact: " . $user_obj->getUserContact() ; ?>
		</div>
		<br><br>
		
	</div>

	<div class="col-md-6 column col-md-offset-0-5">
		<h3>Update Profile</h3><hr>

		<form action="" method="post" class="form-horizontal"  enctype="multipart/form-data">
			<div class="form-group">
			    <label  class="col-sm-2 control-label">First Name</label>
			    <div class="col-sm-10">
			    	<div class="input-group">
      					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>	
						<input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo $user_obj->getFirstName(); ?>" required autofocus>
					</div>
			    </div>
			</div>
            <div class="form-group">
			    <label  class="col-sm-2 control-label">Last Name</label>
				<div class="col-sm-10">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>	
			      		<input type="text" class="form-control" name="lastName" style="height:35px;" placeholder="Last Name" value="<?php echo $user_obj->getLastName(); ?>" required>
					</div>					
				</div>
			</div>
			<div class="form-group">
			    <label  class="col-sm-2 control-label">Email/User Name</label>
			    <div class="col-sm-10">			      	
			      	<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
			      		<input type="email" class="form-control" name="userEmail" placeholder="Email address" value="<?php echo $user_obj->getUserName(); ?>" readonly>
					</div>
				</div>
			</div>
            <div class="form-group">
			    <label  class="col-sm-2 control-label">Location</label>
			    <div class="col-sm-10">
			      	<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></span>
			      		<input type="text" class="form-control" id = "userAddress" style="height:36px;" name="userAddress" value="<?php echo $user_obj->getUserLocation(); ?>" placeholder="Address" required>
					</div>
				</div>
			 </div>
            <div class="form-group">
			    <label  class="col-sm-2 control-label">Phone Number</label>
			    <div class="col-sm-10">
			    	<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
			      		<input type="text" pattern="\d*" maxlength="10" class="form-control" name="userContact" title='Invalid phone number' value="<?php echo $user_obj->getUserContact(); ?>" placeholder="Phone Number" required>
					</div>
				</div>
			</div>
            <div class="form-group">
			    <label  class="col-sm-2 control-label">Date of Birth</label>
			    <div class="col-sm-10">
			      	<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
			      		<input type="date" class="form-control" id = "userDOB" name="userDOB" placeholder="Date of Birth" value="<?php echo $user_obj->getDOB(); ?>" required>
					</div>
				</div>
			</div>
		  	<div class="form-group">
			  	<label class="col-sm-2 control-label">Profile Picture</label>
			  	<div class="col-sm-10">
			  		<label class="btn btn-primary">
                		Browse&hellip; <input type="file" name="userPic" id="userPic" style="display: none;">
            		</label>
			  	</div>
			</div>
	        <br>
	        <div class="action">
                <input type="submit" class="btn btn-primary signup"  value="Update"/><br/>
            </div>             
            </form>
            <hr>

            <form action="chg_pswrd.php" method="post">
            		<input type='hidden' name ='email_id' value ="<?php echo $user_obj->getUserName(); ?>" readonly>
                	<input type="submit" class="btn btn-primary signup" value="Change Password">
            </form><br>

            <form action="block.php" method="post">
                	<input type="submit" class="btn btn-primary signup" value="Unblock Users">
            </form>
	</div>

<!-- 	<div class="col-md-3 column col-md-offset-0-5">
	</div> -->
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
	</script>
	</body>
</html>
