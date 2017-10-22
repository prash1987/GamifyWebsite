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
			$success_msg = "Password changed successfully
					<br>
					<p>You will be redirected to login page in <span id='counter'>3</span> second(s).</p>";
						
        }
        else{
        	$msg = "Password and confirm password are different. Please retry.";
        }
        //}

    }else {
    	$msg = "Email ID is blank or invalid";
    }
	$success_str = "<html>
					<head>
					<title>Gamify</title>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'>
					<!-- Bootstrap -->
					<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>
					<!-- styles -->
					<link href='css/styles.css' rel='stylesheet'>

					<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
					<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
					<!--[if lt IE 9]>
					  <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
					  <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
					<![endif]-->
				 </head>
				<body class='login-bg'>
					<div class='header'>
						 <div class='container'>
							<div class='row'>
							   <div class='col-md-12'>
								  <!-- Logo -->
								  <div class='logo'>
									 <h1><a href='index.php'>Gamify</a></h1>
								  </div>
							   </div>
							</div>
						 </div>
					</div>

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
						</div>
					</div>



					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					<script src='https://code.jquery.com/jquery.js'></script>
					<!-- Include all compiled plugins (below), or include individual files as needed -->
					<script src='bootstrap/js/bootstrap.min.js'></script>
					<script src='js/custom.js'></script>
				</body>
			</html>"; 
			
	$failure_str = 	"<html>
				<head>
					<title>Gamify</title>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'>
					<!-- Bootstrap -->
					<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>
					<!-- styles -->
					<link href='css/styles.css' rel='stylesheet'>

					<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
					<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
					<!--[if lt IE 9]>
					  <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
					  <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
					<![endif]-->
				 </head>
				<body class='login-bg'>
					<div class='header'>
						 <div class='container'>
							<div class='row'>
							   <div class='col-md-12'>
								  <!-- Logo -->
								  <div class='logo'>
									 <h1><a href='index.php'>Gamify</a></h1>
								  </div>
							   </div>
							</div>
						 </div>
					</div>

					<div class='page-content container'>
						<div class='row'>
							<div class='col-md-4 col-md-offset-4'>
								<div class='login-wrapper'>
									<div class='box'>
										<div class='content-wrap'>
											<span>$msg</span>
											<br>
											<a href='forgot_password_2.php'>Forgot Password using Security Questions<a>
										</div>
									</div>
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
    if (parseInt(i.innerHTML)<=1) {
        location.href = 'login.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}

</script>