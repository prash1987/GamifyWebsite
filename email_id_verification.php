<!DOCTYPE html>



<?php
   include("config.php");
   include('swift/lib/swift_required.php');

   $msg = ".";
    $email_valid_flag = False;

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email ID sent from form
      $msg = ".";

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
       
      $email_id = mysqli_real_escape_string($db,$_POST['email_id']);
      //$otp = mysqli_real_escape_string($db,$_POST['otp']); 
      
      //$sql = "SELECT user_id FROM login WHERE email_id='$email_id'";
      //$result = mysqli_query($db,$sql);
      //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      //$count = mysqli_num_rows($result);
      
      // If result has a match, table row must be 1 row
		
      if(filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
        //$_SESSION['login_user'] = $email_id;
        $email_valid_flag = True;
        //require_once("random.php");

        //Send OTP to '$email_id' and also store it in the login table
        $random =  rand(100000,999999);
        /*$sql2 = "UPDATE login SET otp=". $random ." WHERE User_id='". $email_id. "'";
        $querry = mysqli_query($db,$sql2);
        $sql1 = "SELECT * from login WHERE User_id=". $em1;
        $querry1 = mysqli_query($conn,$sql1);
        $result1 = $conn->query($sql1);

        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl") //smtp for mailing
        ->setUsername('gamify101@gmail.com')  //username for account to mail
        ->setPassword('gamify123456789'); //password for the account to mail

        $mailer = Swift_Mailer::newInstance($transport);  //mailer to mail to admin
		
		$first_name = $got_member_name;
        $email_from = "sagar.panchal11@gmail.com";
        $text = "Greetings. Your one time password is";
        $body = "$text $random";
          
        $myemail= "gamify101@gmail.com"; //initializing the FROM mail id
        $toemail= $email_id;

        $message = Swift_Message::newInstance('Query')  //heading of the mail
        ->setFrom(array($myemail=>'Gamify'))  //FROM field in the mail 
        ->setTo(array($toemail))  //TO Field in the mail
        ->setSubject('Password-Recovery for Gamify')  //SUBJECT of the mail
        ->setBody($body); //Actual body of the mail*/
		
		$to = $email_id;
		$subject = 'New Email verification OTP for Gamify';
		$body = 'Greetings. Your one time password is: '.$random;
		$headers = 'From: Gamify <gamify101@gmail.com>' . "\r\n" .
			'Reply-To: Gamify <gamify101@gmail.com>' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

        //$result = $mailer->send($message);  //to check mail sent successfully
		
		$result = mail($to, $subject, $body, $headers);
      

        // $mail_body = "Your temporary password is\np@55w0rdX";
        // $mail_body = wordwrap($mail_body,70);
        // //$retval = mail("prash1987@gmail.com","OTP from Gamify",$mail_body);
        // if( $retval == true ) {
        //     $msg= "Mail sent successfully";
        //  }else {
        //     $msg= "Mail could not be sent";
        //  }

        // $ch = curl_init('https://textbelt.com/text');
        // $data = array(
        //   'phone' => '3096602233',
        //   'message' => 'Hello world',
        //   'key' => '506978c7adf8bc4a48a5cd75a52d97ca66abc1eb5J6FChXcJOCEyIrIw1iPJfGhQ',
        // );
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($ch);
        // curl_close($ch);

        //$msg = "Password sent to your Phone number/Email ID successfully";
        //header('Location: user_home.php');    
      }else {
         $msg = "Email ID is invalid. Please provide a valid email id.";
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

    <script language="Javascript">
    <!--
    function sendOTP()
    {
        document.Form1.action = "email_id_verification.php"
        document.Form1.submit(); 
        return true;
    }

    function verifyOTP()
    {
        document.Form1.action = "verify_email.php"
        document.Form1.submit();
        return true;
    }
    -->
    </script>

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
			                <h6>New Email verification</h6>
			                <div class="social">
	                            
	                        </div>
                      <form name="Form1" action = "" method = "post">
            <?php 
              $form = "";
              if (!isset($email_id)){
                $form .=  "<input class='form-control' type='email' name = 'email_id' placeholder='Email ID' required><br>
                  <div class='already'>";
                  if (isset($msg)){
                    $form .= "<p> $msg </p>";
                  }
                $form .= "
                  </div>
                  <div class='action'>
                    <input type = 'button' class='btn btn-primary signup'  value = 'Send OTP' onclick='sendOTP();' />
                  </div>
                  </form>";
                
                echo $form;
              }
              else{
                if ($email_valid_flag){
                  $form .= "<input class='form-control' type='hidden' name = 'email_id' placeholder='Email ID' value = $email_id readonly><br>
				  <input class='form-control' type='hidden' name = 'server_otp' value = $random readonly><br>
                  <input class='form-control' type='text' name = 'user_otp' placeholder='One-Time Password' required>

                    
                    <div class='already'>";
                    if (isset($msg)){
                      $form .= "<p> $msg </p>";
                    }
                  $form .= "  
                    </div>
                    
                     <div class='action'>
                      <input type = 'button' class='btn btn-primary signup'  value = 'Verify OTP' onclick='verifyOTP();' /><br />
                    </div> 
                    </form>";
                    
                  echo $form;
                }
                else{
                  $form .=  "<input class='form-control' type='email' name = 'email_id' placeholder='Email ID' required><br>
                    <div class='already'>";
                    if (isset($msg)){
                      $form .= "<p> $msg </p>";
                    }
                  $form .= "
                    </div>
                    <div class='action'>
                      <input type = 'button' class='btn btn-primary signup'  value = 'Send OTP' onclick='sendOTP();' />
                    </div>
                    </form>";
                  
                  echo $form;
                  
                }
                
              }
            ?>         


                      <!-- <form name="Form1" action = "" method = "post">
  			                <input class="form-control" type="text" name = "email_id" placeholder="Email ID" required>
  			               

                        <div class="already">
                          <p><?php //if (isset($msg)) echo $msg ?></p>
                        </div>

  			                <div class="action">
                                  <input type = "button" class="btn btn-primary signup"  value = " Send OTP " onclick="sendOTP();" /> -->

                        
                                  
  			                </div> 
                      </form>        
			            </div>
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