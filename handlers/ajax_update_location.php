<?php
	include("../config.php");
	include("../classes/UserClass.php");

	if(isset($_SESSION['login_user'])){
		$myusername = $_SESSION['login_user'];
	}
	else
	{
		header("Location: login.php");
	}

	$user_obj = new UserClass($con, $myusername);

	if(isset($_POST['location']))
	$location = $_POST['location'];

	$query = mysqli_query($con,"UPDATE user SET address= '". $location ."' WHERE user_id= '". $myusername. "'");
?>