<html>
<head>
	<title></title>
	<link href="sn_styles.css" rel="stylesheet" type="text/css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<?php  
	include("config.php");
	include("classes/UserClass.php");
	include("classes/PostClass.php");

	if (isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
		$user_details_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$userLoggedIn'");
		$user = mysqli_fetch_array($user_details_query);
	}
	else {
		header("Location: login.php");
	}

	?>
	<script>
		function toggle() {
			var element = document.getElementById("comment_section");

			if(element.style.display == "block") 
				element.style.display = "none";
			else 
				element.style.display = "block";
		}
	</script>

	<?php  
	//Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}
	
	$user_query = mysqli_query($con, "SELECT posted_by FROM posts WHERE id='$post_id'");
	$row = mysqli_fetch_array($user_query);

	$posted_to = $row['posted_by'];

	if(isset($_POST['postComment' . $post_id])) {
		$post_body = $_POST['post_body'];
		$post_body = mysqli_escape_string($con, $post_body);
		$date_time_now = date("Y-m-d H:i:s");

		$insert_post = mysqli_query($con, "INSERT INTO comments VALUES (DEFAULT,'$post_body', '$userLoggedIn', '$date_time_now', '$post_id')");
		if($insert_post){	
			echo "<p>Comment Posted! </p>";		
		}
		else{
			echo "Error";
		}
	}
	?>
	<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
		<textarea name="post_body"></textarea>
		<input type="submit" name="postComment<?php echo $post_id; ?>" class="btn btn-primary btn-sm" value="Post">
	</form>

	<!-- Load comments -->

	<?php

		$get_comments = mysqli_query($con, "SELECT * from comments WHERE post_id = '$post_id' ORDER BY id ASC");
		$count = mysqli_num_rows($get_comments);
		if($count != 0){
			while($comment = mysqli_fetch_array($get_comments)){
				$comment_body = $comment['post_body'];
				$posted_by = $comment['posted_by'];
				$date_added = $comment['time_stamp'];

			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($date_added); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates 
			if($interval->y >= 1) {
				if($interval == 1)
					$time_message = $interval->y . " year ago"; //1 year ago
				else 
					$time_message = $interval->y . " years ago"; //1+ year ago
			}
			else if ($interval->m >= 1) {
				if($interval->d == 0) {
					$days = " ago";
				}
				else if($interval->d == 1) {
					$days = $interval->d . " day ago";
				}
				else {
					$days = $interval->d . " days ago";
				}


				if($interval->m == 1) {
					$time_message = $interval->m . " month". $days;
				}
				else {
					$time_message = $interval->m . " months". $days;
				}

			}
			else if($interval->d >= 1) {
				if($interval->d == 1) {
					$time_message = "Yesterday";
				}
				else {
					$time_message = $interval->d . " days ago";
				}
			}
			else if($interval->h >= 1) {
				if($interval->h == 1) {
					$time_message = $interval->h . " hour ago";
				}
				else {
					$time_message = $interval->h . " hours ago";
				}
			}
			else if($interval->i >= 1) {
				if($interval->i == 1) {
					$time_message = $interval->i . " minute ago";
				}
				else {
					$time_message = $interval->i . " minutes ago";
				}
			}
			else {
				if($interval->s < 30) {
					$time_message = "Just now";
				}
				else {
					$time_message = $interval->s . " seconds ago";
				}
			}

			$user_obj = new UserClass($con, $posted_by);

?>
			<div class="comment_section">
				<b> <?php echo $user_obj->getFirstAndLastName();
				 ?> </b>
				&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message . "<br>" . $comment_body; ?> 
				<hr>
			</div>
			<?php

		}
	}
	else {
		echo "<center><br><br>No Comments to Show!</center>";
	}

	?>

</body>
</html>