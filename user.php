<?php
   include("config.php");


	$verified_email = $_POST['email_id'];
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST" and (isset($_POST['userEmail']))){
       
       
    $userid = $_POST["userEmail"];
    $firstname=$_POST["firstName"];
    $lastname=$_POST["lastName"];
    $password=$_POST["password"];
    $confirmpasswd=$_POST["confirm_password"];
    $email=$_POST["userEmail"];
    $contact=$_POST["userContact"];
    $address=$_POST["userAddress"];
    $date = $_POST["userDOB"];
    $sec_q1=$_POST["secQ1"];
    $sec_ans1=$_POST["secAns1"];
    $sec_q2=$_POST["secQ2"];
    $sec_ans2=$_POST["secAns2"];

    $BIO = '';
	foreach($_POST['userBIO2'] as $vals) {
	    $BIO .= $vals . ',';
	}
	$BIO= rtrim($BIO, ' ') . $_POST["userBIO"];
	$BIO= strtoupper($BIO);

    $otp = "";
    $new_file_name= "pro_pic.png";
      
    
     if(isset($_FILES['userPic'])){
       $errors= "";
       $file_name = $_FILES['userPic']['name'];
       $file_size =$_FILES['userPic']['size'];
       $file_tmp =$_FILES['userPic']['tmp_name'];
       $file_type=$_FILES['userPic']['type'];
       $file_ext=strtolower(end(explode('.',$_FILES['userPic']['name'])));
      
       $expensions= array("jpeg","jpg","png","JPEG","JPG","PNG");
      
       if(in_array($file_ext,$expensions)=== false){
          $errors="extension not allowed, please choose a JPEG or PNG file. It is " . $file_ext;
       }
  
       if(empty($errors)==true){
            $new_file_name=$_FILES['userPic']['name'];
	   		$folder="profile_pics/";
	   		move_uploaded_file($_FILES['userPic']['tmp_name'], $folder . $_FILES['userPic']['name']);
       }else{
         echo $errors;
       }
    }
    
    //if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
    //  echo "The password does not meet the requirements. Password must contain at least 8 characters made of alphabets, at least one number and at least one special character.";
    //}
    //else {        

		if ($password === $confirmpasswd){
			// Create connection
			$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO user (user_id, first_name,last_name ,address,email,contact,dob,userbio,sec_q1,sec_ans1,sec_q2,sec_ans2,propic) 
			VALUES ('$userid', '$firstname',  '$lastname', '$address','$email','$contact', '$date','$BIO','$sec_q1','$sec_ans1','$sec_q2','$sec_ans2','$new_file_name')";

			$salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
			$password_hash = hash('sha512', $password . $salt);

			$sql2 = "INSERT INTO login (user_id, email_id, Password, salt, otp) 
			VALUES ('$userid', '$email','$password_hash', '$salt', '$otp')";


			if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
				header('Location: registration_successful.html');    
			} else {
				//echo " --Something went wrong Error: " . $sql . "<br>" . $conn->error;
				echo "User ID already exists";
			}
		}
		else {
			echo "<h3>Confirm password should match the password</h3>";
		}
  //}
}
?>

<?php
    $details = json_decode(file_get_contents("http://ipinfo.io/"));
    $city_name= $details->city;
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
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
   <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    
  <script>
  /*$( function() {
    $( "#userDOB" ).datepicker({ dateFormat: 'yy-mm-dd' });

  } ); */
  
  	function matchPasswords() {
		var pass = document.getElementById("password");
		var c_pass = document.getElementById("confirm_password");
		var cp_error = document.getElementById("cpass_error");
		if (c_pass.value == ""){
			cp_error.innerHTML = "Confirm Password field cannot be blank";
			c_pass.focus();
			return false;
		}
		else{
			if (pass.value == c_pass.value){
				cp_error.innerHTML = "";
				return true;
			}
			else{				
				cp_error.innerHTML = "*Passwords & Confirm password must be the same. Please re-enter both of them!";
				//alert("*Passwords & Confirm password must be the same. Please re-enter!");
				c_pass.value="";
				pass.value="";
				pass.focus();
				return false;
			}
		}
	}

	function regexCheck(){
		var pass = document.getElementById("password");
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
	
	//@Author- Harsha
	function securityQuestionCheck(){
		var secQues1 = document.getElementById("SecQues1");
		var secQues2 = document.getElementById("SecQues2");
		var secQ1_error = document.getElementById("secQ1_error");
		var secQ2_error = document.getElementById("secQ2_error");

		//var selectedValue1 = secQues1.options[secQues1.selectedIndex].value;
		//var selectedValue2 = secQues2.options[secQues2.selectedIndex].value;
    	//var secQ1_error = document.getElementById("secQ1_error");
		if (secQues1.value == "default"){
			secQ1_error.innerHTML = "Please select a question from the list";
			secQues1.focus();
			return false;
		} else{
		
    	secQ1_error.innerHTML = "";
		if (secQues2.value == "default"){
			secQ2_error.innerHTML = "Please select a question from the list";
			secQues2.focus();
			return false;
		}
		else {
			secQ1_error.innerHTML = "";
			secQ2_error.innerHTML = "";
			return true;
		}
	}
}
  </script>

  </head>
   <body class="login-bg" onload = 'set_max_date_attribute()'>
	  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="login.php">GAMIFY</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                       
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

      <div class="page-content container">
    	<div class="row">
		  <div class="col-md-2">
		  </div>
       		<div class="row">
           	<div class="col-md-8">
               <div class="content-box-large">
                   <div class="panel-heading">
					            <div class="panel-title"><h3>Registration Form</h3></div>
					        </div>
                     <div class="panel-body">
                         <form action=" " method="post" class="form-horizontal"  enctype="multipart/form-data">
                                  
                                   <div class="form-group">
								    <label  class="col-sm-2 control-label">First Name</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
								    </div>
								  </div>
                                     <div class="form-group">
								    <label  class="col-sm-2 control-label">Last Name</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
								    </div>
								  </div>
								<div class="form-group">
									<label  class="col-sm-2 control-label">Password</label>
								    <div class="col-sm-10">
										<input type="password" class="form-control" name="password" id="password" placeholder="Password" onblur= 'return regexCheck();' required>
										<p id="pass_error" style="color:red; font-size:small;"></p>
								    </div>
								</div>
								<div class="form-group">
									<label  class="col-sm-2 control-label">Confirm Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" name="confirm_password" id="confirm_password" onblur='return matchPasswords();' placeholder="Confirm Password" required>
										<p id="cpass_error" style="color:red; font-size:small;"></p>
								    </div>
								</div>
                             <div class="form-group">
								    <label  class="col-sm-2 control-label">Email/User Name</label>
								    <div class="col-sm-10">
								      <input type="email" class="form-control" name="userEmail" placeholder="Email address" value="<?php
											if(isset($verified_email)) {
												echo $verified_email;
											} ?>" readonly>
								    </div>
								  </div>
                               <div class="form-group">
								    <label  class="col-sm-2 control-label">Location</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" id = "userAddress" name="userAddress" value="<?php echo @$city_name;?>"placeholder="Address" required>
								    </div>
								  </div>
                              <div class="form-group">
								    <label  class="col-sm-2 control-label">Phone Number</label>
								    <div class="col-sm-10">
								      <input type="text" pattern="\d*" maxlength="10" class="form-control" name="userContact" title='Invalid phone number' placeholder="Phone Number" required>
								    </div>
								  </div>
                    
                              <div class="form-group">
								    <label  class="col-sm-2 control-label">Date of Birth</label>
								    <div class="col-sm-10">
								      <input type="date" class="form-control" id = "userDOB" name="userDOB" placeholder="Date of Birth" required>
								    </div>
								  </div>

							   <div class="form-group">
							    <label class="col-sm-2 control-label" for="userBIO2">Interests</label>
							    <div class="col-sm-10">
							    <select multiple class="form-control" id="userBIO2" name="userBIO2[]">
							      <option value="Cricket">Cricket</option>
							      <option value="Badminton">Badminton</option>
							      <option value="Tennis">Tennis</option>
							      <option value="Squash">Squash</option>
								  <option value="Running">Running</option>
								  <option value="Football">Football</option>
								  <option value="Basketball">Basketball</option>
								  <option value="Cycling">Cycling</option>
								  <option value="Gym">Gym</option>
								  <option value="Dance">Dance</option>
								  <option value="MartialArts">Martial Arts</option>
							    </select>
								</div>
							  </div>

							  <div class="form-group">
							  	<label class="col-sm-2 control-label">Other Games (if any)</label>
							  	<div class="col-sm-10"><input type="text" class="form-control" name="userBIO" id="userBIO" placeholder="Other Games"></div>
							  
							  <p style="color:red; font-size:small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Separate game names with commas. Do not enter any spaces after or before commas.</p>
							  </div>

							  <div class="form-group">
							  	<label class="col-sm-2 control-label">Profile Picture</label>
							  	<div class="col-sm-10"><input type="file" name="userPic" id="userPic"></div>
							  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Question-1</label>
                    <div class="col-sm-10">
                    <select class="form-control" id= "SecQues1" name="secQ1" onblur="return securityQuestionCheck();">
                            <option value='default'>Select one from below</option>
                            <option value="born">Where were you born?</option>
                            <option value="club">What is your favorite sports club?</option>
                            <option value="hero">Who is your childhood sports hero?</option>
                            <option value="job">How old were you when you got your first job?</option>
                        </select>
                        <p id="secQ1_error" style="color:red; font-size:small;"></p>
                    
                </div>
                  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Question-2</label>
                    <div class="col-sm-10">
                    <!--input type="text" class="form-control" id = "secQ2" placeholder="Security Question goes here" name="secQ2" required-->
                    	<select class="form-control" id ="SecQues2" name="secQ2" onblur="return securityQuestionCheck();">
                            <option value="default">Select one from below</option>
                            <option value="father">In what year was your father born?</option>
                            <option value="pet">What is your pet’s name?</option>
                            <option value="school">What was the name of your elementary school?</option> 
                        </select>
                        <p id="secQ2_error" style="color:red; font-size:small;"></p>
                       
                </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Answer-1</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id = "secAns1" placeholder="Your Answer" name="secAns1" required>
                </div>
                  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Answer-2</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id = "secAns2" placeholder="Your Answer" name="secAns2" required>
                </div>
                  </div>                 
                             <br><div class="action">
                                <input type = "submit" class="btn btn-primary signup"  value = "Register" onclick="return securityQuestionCheck();" /><br />
                            </div> 
                         </form>
                   </div>
                   
               </div>
           </div>
           
       </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <!-- <script src="https://code.jquery.com/jquery.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
   </body>
</html>