<!DOCTYPE html>
<?php

    include("initial-header.php");
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
      
      $sql = "SELECT user_id FROM login WHERE email_id='$email_id'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      	
      if($count == 1) {
        $_SESSION['login_user'] = $email_id;
        $email_valid_flag = True;
        $random =  rand(100000,999999);
        $sql2 = "UPDATE login SET otp=". $random ." WHERE User_id='". $email_id. "'";
        $querry = mysqli_query($db,$sql2);
		
    		$to = $email_id;
    		$subject = 'Password-Recovery for Gamify';
    		$body = 'Greetings. Your one time password is: '.$random;
    		$headers = 'From: Gamify <gamify101@gmail.com>' . "\r\n" .
    			'Reply-To: Gamify <gamify101@gmail.com>' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();

    		$result = mail($to, $subject, $body, $headers);
 
      }else {
         $msg = "Email ID is blank or invalid";
      }
   }
?>

    <script language="Javascript">
    <!--
    function sendOTP()
    {
        document.Form1.action = "forgot_password.php"
        document.Form1.submit(); 
        return true;
    }

    function verifyOTP()
    {
        document.Form1.action = "verify_otp.php"
        document.Form1.submit();
        return true;
    }
    -->
    </script>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Forgot Password</h6>
			                <div class="social">
	                            
	                        </div>
                      <form name="Form1" action = "" method = "post">
            <?php 
              $form = "";
              if (!isset($email_id)){
                $form .=  "<div class='input-group'>
                            <span class='input-group-addon'><i class='fa fa-envelope' aria-hidden='true'></i></span>
                            <input class='form-control' type='text' name = 'email_id' placeholder='Email ID' required autofocus>
                          </div>
                  <div class='already'>";
                  if (isset($msg)){
                    $form .= "<p> $msg </p>";
                  }
                $form .= "
                  </div>
                  <div class='action'>
                    <input type = 'button' class='btn btn-primary btn-block signup'  value = 'Send OTP' onclick='sendOTP();' />
                  </div>
                  </form>";
                
                echo $form;
              }
              else{
                if ($email_valid_flag){
                  $form .= "<input class='form-control' type='hidden' name = 'email_id' placeholder='Email ID' value = $email_id readonly><br>
                            <div class='input-group'>
                              <span class='input-group-addon'><i class='fa fa-key' aria-hidden='true'></i></span>
                              <input class='form-control' type='password' name = 'otp' placeholder='One-Time Password' autofocus required>
                            </div>
                    
                    <div class='already'>";
                    if (isset($msg)){
                      $form .= "<p> $msg </p>";
                    }
                  $form .= "  
                    </div>
                    
                     <div class='action'>
                      <input type = 'button' class='btn btn-primary btn-block signup'  value = 'Verify OTP' onclick='verifyOTP();' /><br />
                    </div> 
                    </form>";
                    
                  echo $form;
                }
                else{
                  $form .=  "<div class='input-group'>
                              <span class='input-group-addon'><i class='fa fa-envelope' aria-hidden='true'></i></span>
                              <input class='form-control' type='text' name = 'email_id' placeholder='Email ID' required autofocus>
                            </div>

                    <div class='already'>";
                    if (isset($msg)){
                      $form .= "<p> $msg </p>";
                    }
                  $form .= "
                    </div>
                    <div class='action'>
                      <input type = 'button' class='btn btn-primary btn-block signup'  value = 'Send OTP' onclick='sendOTP();' />
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
      <?php include('initial-footer.php'); ?>
		</div>
	</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>