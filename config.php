<?php
	define('DB_SERVER', 'localhost');
   	define('DB_USERNAME', 'root');
   	define('DB_PASSWORD', '1234567');
   	define('DB_DATABASE', 'gamify');

   	ob_start(); //Turns on output buffering 
	session_start();

	$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  
?>