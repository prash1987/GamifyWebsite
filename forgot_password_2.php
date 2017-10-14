
<!DOCTYPE html>

<?php
   include("config.php");
   $msg = ".";
   $sec_q1 = "";
   $sec_ans1 = "";
   $sec_q2 = "";
   $sec_ans2 = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $msg = ".";

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
       
      $email_id = mysqli_real_escape_string($db,$_POST['email_id']);
      
      $sql = "SELECT sec_q1,sec_q2 FROM user WHERE email='$email_id'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result has a match, table row must be 1 row
		
      if($count == 1) {
        $_SESSION['login_user'] = $email_id;
        
        $sec_q1 = $row["sec_q1"];
        $sec_q2 = $row["sec_q2"];

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
  			                <input class="form-control" type="text" name = "email_id" placeholder="Email ID" required><br>
                        <label for="sec_ans1"><?php if (isset($sec_q1)) echo $sec_q1 ?></label>
  			                <input class="form-control" type="text" id = "sec_ans1" name = "sec_ans1" placeholder="Answer">
                        <label for="sec_ans2"><?php if (isset($sec_q2)) echo $sec_q2 ?></label>
                        <input class="form-control" type="text" id = "sec_ans2" name = "sec_ans2" placeholder="Answer">

                        <div class="already">
                          <p><?php if (isset($msg)) echo $msg ?></p>
                        </div>

  			                <div class="action">
                                  <input type = "button" class="btn btn-primary signup"  value = " Show security questions " onclick="showQuestions();" />
                                  <input type = "button" class="btn btn-primary signup"  value = " Verify Answers " onclick="verifyAns();" /><br />
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