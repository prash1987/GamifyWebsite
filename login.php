<!DOCTYPE html>
<?php
   include("config.php");
   include('swift/lib/swift_required.php');

   $error = ".";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $error = ".";

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
       
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT email_id, Password, salt FROM login WHERE email_id='$myusername' ";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
    
      // If email ID exists in the login table
		
      if($count == 1) {
        $salt = $row["salt"];
        $password_hash = $row["Password"];
        $myhash = hash('sha512', $mypassword . $salt);

        //If the password is correct
        if($password_hash == $myhash){
          $_SESSION['login_user'] = $myusername;
          $_SESSION['loggedin'] = true;

          //Send OTP to '$myusername' and also store it in the login table
          $random =  rand(100000,999999);
          $sql2 = "UPDATE login SET otp=". $random ." WHERE User_id='". $myusername. "'";
          $querry = mysqli_query($db,$sql2);

          $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl") //smtp for mailing
          ->setUsername('gamify101@gmail.com')  //username for account to mail
          ->setPassword('gamify123456789'); //password for the account to mail

          $mailer = Swift_Mailer::newInstance($transport);  //mailer to mail to admin

          $text = "Greetings. Your one time password is";
          $body = "$text $random";
            
          $myemail= "gamify101@gmail.com"; //initializing the FROM mail id
          $toemail= $myusername;

          $message = Swift_Message::newInstance('Query')  //heading of the mail
          ->setFrom(array($myemail=>'Gamify'))  //FROM field in the mail 
          ->setTo(array($toemail))  //TO Field in the mail
          ->setSubject('Dual Authentication for Gamify')  //SUBJECT of the mail
          ->setBody($body); //Actual body of the mail

          $result = $mailer->send($message);  //to check mail sent successfully
  
          header('Location: duo_auth.php'); 
        }
        else{
          $error = "Your Login Name or Password is invalid";
        }
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>


<html>
  <head>
    <title>GAMIFY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">GAMIFY</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Sign In</h6>
			                <div class="social">
	                            
	                        </div>
                            <form action = "" method = "post">
			                <input class="form-control" type="text" name = "username" placeholder="User Name" required>
			                <input class="form-control" type="password" name = "password" placeholder="Password" required>

                      <div class="already">
                        <p><?php if (isset($error)) echo $error ?></p>
                      </div>

			                <div class="action">
                                <input type = "submit" class="btn btn-primary signup"  value = " Sign In "/><br />
			                </div> 
                      
                            </form>        
			            </div>
			        </div>

              <div class="already">
                  <p><a href="fg_pwd.php">Forgot Password?</a></p><br>
                  <!-- <a href="forgot_password_2.php">Recover by answering security questions</a><br>
                  <a href="forgot_password.php">Recover using OTP</a> -->
              </div>

			        <div class="already">
			            <p>Don't have an account yet?</p>
			            <a href="user.php">Register</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>