<?php 
 include("config.php");
	if(isset($_POST['post_id']))
	{
		$post_id = $_POST['post_id'];
		$post_id = trim($post_id, "post_");
		$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$query = mysqli_query($con, "UPDATE posts SET deleted=1 WHERE id=$post_id");
	}
?>