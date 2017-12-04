<?php
	include("config.php");
	include("initial-header.php");
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	$email_id = $_POST["email_id"];
	$pswrd = $_POST["new_password"];
	$confirm_pswrd = $_POST["confirm_password"];

	$sql = "SELECT user_id FROM login WHERE email_id='$email_id'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
	$success_msg = "";
	$success_flag = False;
	$msg = "";
    if($count == 1) {
        //if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pswrd)) {
            //$msg = "The password does not meet the requirements. Password must contain at least 8 characters made of alphabets, at least one number and at least one special character.";
        //} else {

        if($pswrd == $confirm_pswrd){

			$salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
			$password_hash = hash('sha512', $pswrd . $salt);
			$sql2 = "UPDATE login SET Password='". $password_hash ."', salt='". $salt ."' WHERE User_id='". $email_id. "'";
			$querry = mysqli_query($db,$sql2);
			$success_flag = TRUE;
			session_start();
			session_unset();
			session_destroy();
			$success_msg = "<h4>Password changed successfully</h4>
					<br>
					<h5>You will be redirected to login page in <span id='counter'>3</span> second(s).</h5>";
						
        }
        else{
        	$msg = "Password and confirm password are different. Please retry.";
        }
        //}

    }else {
    	$msg = "Email ID is blank or invalid";
    }
	$success_str = "
					<div class='page-content container'>
						<div class='row'>
							<div class='col-md-4 col-md-offset-4'>
								<div class='login-wrapper'>
									<div class='box'>
										<div class='content-wrap'>
											<span>$success_msg</span>
										</div>
									</div>
								</div>
							</div>
							<div class='mastfoot'>
  								<div class='inner'>
      								<p>Gamify website developed by <a href='#'>@SE_GROUP 1</a></p>
  								</div>
							</div>
						</div>
					</div>

					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					<script src='https://code.jquery.com/jquery.js'></script>
					<!-- Include all compiled plugins (below), or include individual files as needed -->
					<script src='bootstrap/js/bootstrap.min.js'></script>
					<script src='js/custom.js'></script>
				</body>
			</html>"; 
			
	$failure_str = 	"
					<div class='page-content container'>
						<div class='row'>
							<div class='col-md-4 col-md-offset-4'>
								<div class='login-wrapper'>
									<div class='box'>
										<div class='content-wrap'>
											<span><h4>$msg</h4></span>
											<br>
											<h5><a href='forgot_password_2.php'>Forgot Password using Security Questions<a></h5>
										</div>
									</div>
								</div>
							</div>
							<div class='mastfoot'>
								<div class='inner'>
									<p>Gamify website developed by <a href='#'>@SE_GROUP 1</a></p>
								</div>
							</div>
						</div>
					</div>

					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					<script src='https://code.jquery.com/jquery.js'></script>
					<!-- Include all compiled plugins (below), or include individual files as needed -->
					<script src='bootstrap/js/bootstrap.min.js'></script>
					<script src='js/custom.js'></script>
				</body>
			</html>"; 
				
							
    if($success_flag){
		echo $success_str;
	}
	else{
		echo $failure_str;
	}
		
?>


<script type="text/javascript">
window.onload = function WindowLoad(event) {
	setInterval(function(){ countdown(); },1000);
}
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<2) {
        location.href = 'login.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}

</script>