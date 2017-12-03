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

	    $sql = "UPDATE user set first_name='$firstname', last_name='$lastname', contact='$contact', dob='$date', propic='$new_file_name' 
				WHERE user_id='$user_id';";

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
   		<script src = "js/search.js"></script>
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
			  	<div class="col-sm-10"><input type="file" name="userPic" id="userPic"></div>
			</div>
	        <br>
	        <div class="action">
                <input type="submit" class="btn btn-primary signup"  value="Update"/><br/>
            </div>             
            </form>
            <hr>

            <form action="chg_pswrd.php" method="post" class="form-horizontal">            	
            	<div class="action">
            		<input type='hidden' name ='email_id' value ="<?php echo $user_obj->getUserName(); ?>" readonly>
                	<input type="submit" class="btn btn-primary signup" value="Change Password">
            	</div>
            </form>
	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		<?php echo "Ads appear here"; ?>
	</div>