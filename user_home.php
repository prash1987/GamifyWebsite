<?php 
    session_start();
    include("config.php");
    if (! (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
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
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="user_home.php">Gamify</a></h1>
	              </div>
	           </div>
	           <div class="col-md-4">
	              <div class="row">
	              </div>
	           </div>
	           <div class="col-md-3">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
                              
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i><?php echo $_SESSION['login_user']; ?><b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="update_profile.php">Profile</a></li>
	                          <li><a href="logout.php">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="user_home.php"><i class="glyphicon glyphicon-home"></i> All Events</a></li>
                    <li><a href="user_home.php"><i class="glyphicon glyphicon-calendar"></i> My Events</a></li>
                </ul>
                
                    
                
             </div>
              <div class="sidebar content-box" style="display: block; text-align:center;">
                <a href="user_home.php" class="btn btn-success btn-lg" type="button" ><i class="glyphicon glyphicon-plus"></i> Create Event</a>
              
              </div>
              
		  </div>
		  <div class="col-md-10">
               <div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">Available Events</div>
				</div>
  				<div class="panel-body">
  					<div class="table-responsive ">
  						<table class="table table-hover">
			              <thead>
			                <tr>
			                  <th>User ID</th>
                              <th>Location</th>
                              <th>Game</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Players Required</th>
                              <th>Players Joined</th><th></th>
			                </tr>
			              </thead>
			              <tbody>
                            <?php 
                                $logged_user = $_SESSION['login_user'];

                                // Create connection
                                $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                } 
                                $conn->close();
                            ?>
			              </tbody>
			            </table>
  					</div>
  				</div>
                   <div class="panel-heading">
					<div class="panel-title">Joined Events</div>
				</div>
                   <div class="panel-body">
  					<div class="table-responsive ">
  						<table class="table table-hover">
			              <thead>
			                <tr>
			                  <th>User ID</th>
                              <th>Location</th>
                              <th>Game</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Players Required</th>
			                </tr>
			              </thead>
			              <tbody>
                              <?php 
                                $logged_user = $_SESSION['login_user'];

                                // Create connection
                                $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                } 

                                
                                $conn->close();
                            ?>
			              </tbody>
			            </table>
  					</div>
  				</div>
            
  			</div>
          </div>
		</div>
    </div>

    <!--<footer class="container-fluid footer navbar-fixed-bottom">
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>