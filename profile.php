	<?php  
	require 'config.php';
	include("header.php");
	include("classes/UserClass.php");
	include("classes/PostClass.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
		header("Location: login.php");
	}

	if (isset($_GET['profile_username'])) {
		$username = $_GET['profile_username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$username'");
		$user_info = mysqli_fetch_array($user_details_query);
		$user_obj = new UserClass($con, $username);
	}
	else {
		header("Location: login.php");
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
		<?php if($username==$userLoggedIn){
			echo "<button name='update_profile' class='btn btn-primary btn-sm'>Update Profile</button>";
		}
		?>

	</div>

	<div class="col-md-6 column col-md-offset-0-5">
		<?php
			echo "<h3>Posts by ";
			echo $user_obj->getFirstAndLastName();
			echo "</h3><hr>";
			$post = new PostClass($con, $username);
			$post->loadPostsOwn($username);
		?>
	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		<?php echo "Ads appear here" ?>
	</div>

</body>
</html>