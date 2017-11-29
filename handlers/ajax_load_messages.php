<?php

	include("../config.php");
	include("../classes/UserClass.php");
	include("../classes/MessageClass.php");

	$limit = 7;

	$userLoggedIn = $_REQUEST['userLoggedIn'];
    $time = time();
    $status_query = mysqli_query($con, "UPDATE user SET status_timestamp = '$time' WHERE User_id = '$userLoggedIn'");

	$message_obj = new MessageClass($con, $_REQUEST['userLoggedIn']);
	echo $message_obj->getConvosDropdown($_REQUEST, $limit);

?>