<!DOCTYPE html>

<?php
	include("config.php");
	
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
	$u_otp = "";
	$u_otp = $_POST["otp"];
	$u_name = "";
	$u_name = $_POST["email_id"];
	$got_otp = "";

		$sql1 = "SELECT * from login WHERE email_id='".$u_name . "';";
		$ret_val = mysqli_query($db,$sql1);
		//$result1 = $db->query($sql1);
		
		if ( $ret_val  == FALSE ) 
		{
			echo "Email ID does not exist";
			echo mysql_error();
 		}
 		else 
 		{
 			$row = mysqli_fetch_array($ret_val);
	        $got_member_email = $row["email_id"];
	        $got_otp = $row["otp"];
		}

		if($u_otp == $got_otp)
		{
			//require_once("re_enter_password.php");
			echo "Redirect to enter new password page";
			//header('Location: re_enter_password.php');

			echo"<form action = 're_enter_password.php' method = 'post'>";
			echo "<input class='form-control' type='text' name = 'email_id' value=$u_name readonly>";
			echo "<input class='form-control' type='text' name = 'new_password' placeholder='New Password'>";
			echo "<input class='form-control' type='text' name = 'confirm_password' placeholder='Confirm Password'>";
			echo "<div class='action'>";
			echo "<input type = 'submit' class='btn btn-primary signup'  value = 'Change Password' /><br/>";
			echo "</div></form>";
			
		}
		else
		{
			echo "OTP entered does not match. Please try again from the beginning";
		}
?>