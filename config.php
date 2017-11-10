<?php
	define('DB_SERVER', 'db.soic.indiana.edu');
   	define('DB_USERNAME', 'p565f17_prbhat');
   	define('DB_PASSWORD', 'my+sql=p565f17_prbhat');
   	define('DB_DATABASE', 'p565f17_prbhat');

   	ob_start(); //Turns on output buffering 
	session_start();

	$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  
?>