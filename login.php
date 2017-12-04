<!DOCTYPE html>
<?php
	
	include("initial-header.php");
   	include("config.php");
   	include('swift/lib/swift_required.php');

   $error = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

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
			$random =  rand(100000,999999);
			$sql2 = "UPDATE login SET otp=". $random ." WHERE User_id='". $myusername. "'";
			$querry = mysqli_query($db,$sql2);
			
			$to = $myusername;
			$subject = 'Dual Authentication for Gamify';
			$body = 'Greetings. Your one time password is: '.$random;
			$headers = 'From: Gamify <gamify101@gmail.com>' . "\r\n" .
				'Reply-To: Gamify <gamify101@gmail.com>' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			$result = mail($to, $subject, $body, $headers);
			
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

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Sign In</h6>
			                
                            <form action = "" method = "post">
                            <div class="input-group">
      							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>	
			                	<input class="form-control" type="text" name = "username" placeholder="User Name" autofocus required>
			                </div>
			                <br>
			                <div class="input-group">
      							<span class="input-group-addon"><i class="fa fa-key"></i></span>
			                	<input class="form-control" type="password" name = "password" placeholder="Password" required>
			                </div>
			         
		                    <div class="already">
		                    	<span><?php if (isset($error)) echo $error ?></span>
		                    </div>

			                <div class="action">
                                <input type = "submit" class="btn btn-primary btn-block signup"  value = " Login "/>
			                </div>
                            </form>
                            <br><br>
                  			<p><h4><a href="fg_pwd.php">Forgot Password?</a></h4></p><br>
              		        <h4><p>Don't have an account?<a href="email_id_verification.php"> Register now!</a></p></h4>
			            
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