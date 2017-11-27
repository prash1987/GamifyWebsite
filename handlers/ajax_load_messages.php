<?php

	include("../config.php");
	include("../classes/UserClass.php");
	include("../classes/MessageClass.php");

	$limit = 7;

	$message_obj = new MessageClass($con, $_REQUEST['userLoggedIn']);
	echo $message_obj->getConvosDropdown($_REQUEST, $limit);

?>