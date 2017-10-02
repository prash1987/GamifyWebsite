<!DOCTYPE html>

<?php
	include("config.php");
	
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	$email_id = "";
	$email_id = $_POST["email_id"];
	$mysec_ans1 = "";
	$mysec_ans1 = $_POST["sec_ans1"];
	$mysec_ans2 = "";
	$mysec_ans2 = $_POST["sec_ans2"];	

		$sql1 = "SELECT * from user WHERE email='".$email_id . "';";
		$ret_val = mysqli_query($db,$sql1);
		
		if ( $ret_val  == FALSE ) 
		{
			echo "Email ID does not exist";
			echo mysql_error();
 		}
 		else 
 		{
 			$row = mysqli_fetch_array($ret_val);
	        $sec_ans1 = $row["sec_ans1"];
	        $sec_ans2 = $row["sec_ans2"];		

			if($mysec_ans1 == $sec_ans1 && $mysec_ans2 == $sec_ans2)
			{
				echo"<form action = 're_enter_password.php' method = 'post'>";
				echo "<input class='form-control' type='text' name = 'email_id' value=$email_id readonly>";
				echo "<input class='form-control' type='text' name = 'new_password' placeholder='New Password'>";
				echo "<input class='form-control' type='text' name = 'confirm_password' placeholder='Confirm Password'>";
				echo "<div class='action'>";
				echo "<input type = 'submit' class='btn btn-primary signup'  value = 'Change Password' /><br/>";
				echo "</div></form>";
			}
			else
			{
				echo "Security answers are not correct. Please try again from the beginning";
			}
		}
?>