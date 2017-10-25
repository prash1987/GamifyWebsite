
<!DOCTYPE html>

<?php
   include("config.php");
   $msg = ".";
   $my_sec_q1 = "";
   $sec_ans1 = "";
   $my_sec_q2 = "";
   $sec_ans2 = "";
	 $email_valid_flag = False;
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $msg = "";

      $email_id = mysqli_real_escape_string($con,$_POST['email_id']);
      
      $sql = "SELECT sec_q1,sec_q2 FROM user WHERE email='$email_id'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result has a match, table row must be 1 row
		
      // @Author- Harsha
      if($count == 1) {
        $_SESSION['login_user'] = $email_id;
        $email_valid_flag = True;        

        switch ($row["sec_q1"]) {
          case 'born':
                    $my_sec_q1 = 'Where were you born?';
            break;
          case 'club':
                    $my_sec_q1 = 'What is your favorite sports club?';
            break;
          case 'hero':
                    $my_sec_q1 = 'Who is your childhood sports hero?';
            break;
          case 'job':
                    $my_sec_q1 = 'How old were you when you got your first job?';
            break;
        }

        switch ($row["sec_q2"]) {
          case 'father':
            $my_sec_q2 = 'In what year was your father born?';
            break;
            case 'pet':
            $my_sec_q2 = 'What is your pet’s name?';
            break;
            case 'school':
            $my_sec_q2 = 'What was the name of your elementary school?';
            break;
        }
    }else {
         $msg = "Email ID is blank or invalid";
      }
   }
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

    <script language="Javascript">
    <!--
    function showQuestions()
    {
        document.Form1.action = "forgot_password_2.php"
        document.Form1.submit(); 
        return true;
    }

    function verifyAns()
    {
        document.Form1.action = "verify_answers.php"
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
	                 <h1><a href="index.php">Gamify</a></h1>
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
			                <h6>Forgot Password</h6>
			                <div class="social">
	                            
	                        </div>
                      <form name="Form1" action = "" method = "post">
						<?php 
							$form = "";
							if (!isset($email_id)){
								$form .=  "<input class='form-control' type='text' name = 'email_id' placeholder='Email ID' required><br>
									<div class='already'>";
									if (isset($msg)){
										$form .= "<p> $msg </p>";
									}
								$form .= "
									</div>
									<div class='action'>
										<input type = 'button' class='btn btn-primary signup'  value = 'Show security questions' onclick='showQuestions();' />
									</div>
									</form>";
								
								echo $form;
							}
							else{
								if ($email_valid_flag){
									$form .= "<input class='form-control' type='hidden' name = 'email_id' placeholder='Email ID' value = $email_id readonly><br>
										<input class='form-control' type='text' id = 'sec_ques1' name = 'sec_ques1' value = '$my_sec_q1' readonly>
										<input class='form-control' type='text' id = 'sec_ans1' name = 'sec_ans1' placeholder='Answer for Question 1'>
										<input class='form-control' type='text' id = 'sec_ques2' name = 'sec_ques2' value = '$my_sec_q2' readonly>
										<input class='form-control' type='text' id = 'sec_ans2' name = 'sec_ans2' placeholder='Answer for Question 2'>
										<div class='already'>";
										if (isset($msg)){
											$form .= "<p> $msg </p>";
										}
									$form .= "	
										</div>
										
										 <div class='action'>
											<input type = 'button' class='btn btn-primary signup'  value = 'Verify Answers' onclick='verifyAns();' /><br />
										</div> 
										</form>";
										
									echo $form;
								}
								else{
									$form .=  "<input class='form-control' type='text' name = 'email_id' placeholder='Email ID' required><br>
										<div class='already'>";
										if (isset($msg)){
											$form .= "<p> $msg </p>";
										}
									$form .= "
										</div>
										<div class='action'>
											<input type = 'button' class='btn btn-primary signup'  value = 'Show security questions' onclick='showQuestions();' />
										</div>
										</form>";
									
									echo $form;
									
								}
								
							}
						?>         
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