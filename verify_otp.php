<!DOCTYPE html>

<?php
	include("initial-header.php");
	include("config.php");

	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
	$error = "";
	
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
			$error .= "Email ID does not exist.<a href='login.php'> Please try again</a> ";
 		}
 		else 
 		{
 			$row = mysqli_fetch_array($ret_val);
	        $got_member_email = $row["email_id"];
	        $got_otp = $row["otp"];
		}
		
		$success_str = "";
	        $success_str .="
						<div class='page-content container'>
							<div class='row'>
								<div class='col-md-4 col-md-offset-4'>
									<div class='login-wrapper'>
								        <div class='box'>
								            <div class='content-wrap'>
								                <h6>Please enter new password</h6>
								                <div class='social'>
						                            
						                        </div>
					                            <form action = 're_enter_password.php' method = 'post'>
					                            	<div class='input-group'>
                            							<span class='input-group-addon'><i class='fa fa-envelope' aria-hidden='true'></i></span>
														<input class='form-control' type='text' name = 'email_id' value=$u_name readonly>
													</div>
													<br>
													<div class='input-group'>
                            							<span class='input-group-addon'><i class='fa fa-key' aria-hidden='true'></i></span>
														<input class='form-control' type='password' id = 'new_password' name = 'new_password' placeholder='New Password' onblur= 'return regexCheck();' required autofocus>
													</div>
													<p id='pass_error' style='color:red; font-size:small;'></p>
													<br>
													<div class='input-group'>
                            							<span class='input-group-addon'><i class='fa fa-key' aria-hidden='true'></i></span>
														<input class='form-control' type='password' id = 'confirm_password' name = 'confirm_password' onblur='return matchPasswords();' placeholder='Confirm Password' required>
													</div>
													<p id='cpass_error' style='color:red; font-size:small;'></p>

								                    <div class='already'>
								                    	<p><?php if (isset($error)) echo $error ?></p>
								                    </div>

													<div class='action'>
														<input type = 'submit' class='btn btn-primary signup'  value = 'Change Password' /><br/>
													</div>
												</form>
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
			
			$failure_str = "";
			$failure_str = "

					<div class='page-content container'>
						<div class='row'>
							<div class='col-md-4 col-md-offset-4'>
								<div class='login-wrapper'>
									<div class='box'>
										<div class='content-wrap'>
											<span><h4>OTP is incorrect. Please <a href='forgot_password.php'>try again</a> from the beginning</h4></span>
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

		if($u_otp == $got_otp)
		{
			echo $success_str;
		}
		else
		{
			echo $failure_str;
		}
?>

<script type="text/javascript">
	function matchPasswords() {
		var pass = document.getElementById("new_password");
		var c_pass = document.getElementById("confirm_password");
		var cp_error = document.getElementById("cpass_error");
		if (c_pass.value == ""){
			cp_error.innerHTML = "Confirm Password field cannot be blank";
			c_pass.focus();
			return false;
		}
		else{
			if (pass.value != c_pass.value){
				cp_error.innerHTML = "*Passwords & Confirm password must be the same. Please re-enter both of them!";
				//alert("*Passwords & Confirm password must be the same. Please re-enter!");
				c_pass.value="";
				pass.value="";
				pass.focus();
				return false;
			}
			else{
				cp_error.innerHTML = "";
				return true;
			}
		}
	}

	function regexCheck(){
		var pass = document.getElementById("new_password");
		var p_error = document.getElementById("pass_error")
		var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
		if (pass.value == ""){
			p_error.innerHTML = "*Password field cannot be blank";
			pass.focus();
			return false;
		}
		else{
			if(!re.test(pass.value)){
				p_error.innerHTML = "*Password field must contain at least one digit, a lowercase & an uppercase letter and should be at least 6 characters long. Please re-enter it again.";
				pass.value="";
				pass.focus();
				return false;
			}
			else{
				p_error.innerHTML = "";
				return true;
			}
		}
	}
</script>
</head>