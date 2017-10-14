<html>
<head>
	<title></title>
	<link href="sn_styles.css" rel="stylesheet" type="text/css">

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
		header("Location: user.php");
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
		$insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$date_time_now', '$post_id'");
		echo "<p>Comment Posted! </p>";
	}
	?>
	<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
		<textarea name="post_body"></textarea>
		<input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
	</form>

	<!-- Load comments -->






</body>
</html>