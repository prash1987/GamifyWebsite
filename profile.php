	<?php  
	require 'config.php';
	include("header.php");
	include("classes/UserClass.php");

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

	<br><br><br><br>
	<div class="user_details column">
		<br><br>
		<img src="<?php echo 'profile_pics/' . $user_info['propic']; ?>" height='126' width='126'> 

		<div class="user_details_left_right">			
			<?php echo $user_obj->getFirstAndLastName(); ?>
			<br>
			<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
			echo "Contact: " . $user_obj->getUserContact() ;
			?>
		</div>
	</div>

	<div class="main_column column">
		<?php echo $username ?>
	</div>

</body>
</html>