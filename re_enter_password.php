<?php
	include("config.php");
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	$email_id = $_POST["email_id"];
	$pswrd = $_POST["new_password"];
	$confirm_pswrd = $_POST["confirm_password"];

	$sql = "SELECT user_id FROM login WHERE email_id='$email_id'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    
    if($count == 1) {

    	if($pswrd == $confirm_pswrd){

            $salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
            $password_hash = hash('sha512', $pswrd . $salt);
    		$sql2 = "UPDATE login SET Password='". $password_hash ."', salt='". $salt ."' WHERE User_id='". $email_id. "'";
        	$querry = mysqli_query($db,$sql2);
        	$msg = "Password changed successfully";
    	}
    	else{
    		$msg = "Password and confirm password are different. Please retry.";
    	}
    }else {
    	$msg = "Email ID is blank or invalid";
    }

    echo $msg;
?>