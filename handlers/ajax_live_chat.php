<?php

	include("../config.php");
	include("../classes/UserClass.php");
	include("../classes/MessageClass.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
		header("Location: login.php");
	}

	//echo "User to is: "; 
	//echo $_POST['user_to'];

	$user_obj = new UserClass($con, $userLoggedIn);
	$message_obj = new MessageClass($con, $userLoggedIn);

	if ($_POST['func'] == "getMessages")
	{
		if (isset($_POST['user_to']))
		{
			$user_to = $_POST['user_to']; 
			echo $message_obj->getMessages($user_to);
		}
	}


	if ($_POST['func'] == "sendMessages")
		//echo "Function racehed here";
	{
		if (isset($_POST['body']))
		{
			$user_to = $_POST['user_to'];
			$body =  $_POST['body'];
			$date = $_POST['date'];


			$message_obj->sendMessage($user_to, $body, $date);
		}
	}

	mysqli_close($con);
?>