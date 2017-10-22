<?php
   include("config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
       
    $userid = $_POST["userEmail"];
    $firstname=$_POST["firstName"];
    $lastname=$_POST["lastName"];
    $password=$_POST["password"];
    $confirmpasswd=$_POST["confirm_password"];
    $email=$_POST["userEmail"];
    $contact=$_POST["userContact"];
    $address=$_POST["userAddress"];
    $date = $_POST["userDOB"];
    $BIO=$_POST["userBIO"];
    $sec_q1=$_POST["secQ1"];
    $sec_ans1=$_POST["secAns1"];
    $sec_q2=$_POST["secQ2"];
    $sec_ans2=$_POST["secAns2"];
    $otp = "";
    $new_file_name="";
      
    
     if(isset($_FILES['userPic'])){
       $errors= array();
       $file_name = $_FILES['userPic']['name'];
       $file_size =$_FILES['userPic']['size'];
       $file_tmp =$_FILES['userPic']['tmp_name'];
       $file_type=$_FILES['userPic']['type'];
       $file_ext=strtolower(end(explode('.',$_FILES['userPic']['name'])));
      
       $expensions= array("jpeg","jpg","png","JPEG","JPG","PNG");
      
       if(in_array($file_ext,$expensions)=== false){
          $errors[]="extension not allowed, please choose a JPEG or PNG file.";
       }
  
       if(empty($errors)==true){
            $new_file_name=$_FILES['userPic']['name'];
	   		$folder="profile_pics/";
	   		move_uploaded_file($_FILES['userPic']['tmp_name'], $folder . $_FILES['userPic']['name']);
       }else{
         echo $errors;
       }
    }
    
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
      echo "The password does not meet the requirements. Password must contain at least 8 characters made of alphabets, at least one number and at least one special character.";
    }
    else {        

    if ($password === $confirmpasswd)
    {
        if ((string)$sec_q1==="default") { //@Author- Harsha: to check Security questions are selected
        echo 'Please select both security questions 1 and 2';
      }

      else
      {
        if ((string)$sec_q2==="default") {
        echo 'Please select both security questions 1 and 2';
        }
        else
        {

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
            header('Location: login.php');    
        } else {
            //echo " --Something went wrong Error: " . $sql . "<br>" . $conn->error;
            echo "User ID already exists";
        }
      }

    }
    }
    else {
        echo "<h3>Confirm password should match the password</h3>";
    }
  }
}
?>

<?php
    $details = json_decode(file_get_contents("http://ipinfo.io/"));
    $city_name= $details->city;
 ?>


<html>
    <head>
    <title>Gamify</title>
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
  $( function() {
    $( "#userDOB" ).datepicker({ dateFormat: 'yy-mm-dd' });

  } );
  </script>

  </head>
   <body >
	  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="login.php">Gamify</a></h1>
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

      <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  
            
              
		  </div>
       <div class="row">
           <div class="col-md-6">
               <div class="content-box-large">
                   <div class="panel-heading">
					            <div class="panel-title">Register</div>
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
								      <input type="password" class="form-control" name="password" placeholder="Password" required>
								    </div>
								  </div>
                              <div class="form-group">
								    <label  class="col-sm-2 control-label">Confirm Password</label>
								    <div class="col-sm-10">
								      <input type="password" class="form-control" name="confirm_password" placeholder="Password" required>
								    </div>
								  </div>
                             <div class="form-group">
								    <label  class="col-sm-2 control-label">Email/User Name</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="userEmail" placeholder="Email" required>
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
								      <input type="text" class="form-control" name="userContact" placeholder="Phone Number" required>
								    </div>
								  </div>
                    
                              <div class="form-group">
								    <label  class="col-sm-2 control-label">Date of Birth</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" id = "userDOB" name="userDOB" placeholder="Date of Birth" required>
								    </div>
								  </div>
                                               
                             <div class="form-group">
								    <label  class="col-sm-2 control-label">Interests</label>
								    <div class="col-sm-10">
								    <textarea class="form-control" placeholder="Interests (Sports, Dance, Gym, etc.)" rows="3"  name="userBIO" required="required"></textarea>
									</div>
							 </div>

							   <div class="form-group">
							    <label class="col-sm-2 control-label" for="userBIO2">Interests</label>
							    <div class="col-sm-10">
							    <select multiple class="form-control" id="userBIO2">
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
							  	<label class="col-sm-2 control-label">Profile Picture</label>
							  	<div class="col-sm-10"><input type="file" name="userPic" id="userPic"></div>
							  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Question-1</label>
                    <div class="col-sm-10"> <!--@Author Harsha: Security questions-->
                    <!--input type="text" class="form-control" id = "secQ1" placeholder="Security Question goes here" name="secQ1" required-->

                    <select class="form-control" name="secQ1" required>
                            <option value='default'>Select one from below</option>
                            <option value="born">Where were you born?</option>
                            <option value="club">What is your favorite sports club?</option>
                            <option value="hero">Who is your childhood sports hero?</option>
                            <option value="job">How old were you when you got your first job?</option>
                        </select>
                </div>
                  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Answer-1</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id = "secAns1" placeholder="Your Answer" name="secAns1" required>
                </div>
                  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Question-2</label>
                    <div class="col-sm-10">
                    <!--input type="text" class="form-control" id = "secQ2" placeholder="Security Question goes here" name="secQ2" required-->
                    <select class="form-control" name="secQ2" required>
                            <option value="default">Select one from below</option>
                            <option value="father">In what year was your father born?</option>
                            <option value="pet">What is your pet’s name?</option>
                            <option value="school">What was the name of your elementary school?</option>
                         
                        </select>
                </div>
                  </div>

                             <div class="form-group">
                    <label  class="col-sm-2 control-label">Security Answer-2</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id = "secAns2" placeholder="Your Answer" name="secAns2" required>
                </div>
                  </div>                 
                             <br><div class="action">
                                <input type = "submit" class="btn btn-primary signup"  value = "Register"/><br />
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