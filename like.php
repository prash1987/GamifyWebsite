<html>
<head>
	<title></title>
	<link href="sn_styles.css" rel="stylesheet" type="text/css">

	</head>
<body>
	<?php  
	require 'config.php';
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


	//Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}

	$get_likes = mysqli_query($con, "SELECT likes, posted_by FROM posts WHERE id='$post_id'");
	$row = mysqli_fetch_array($get_likes);
	$total_likes = $row['likes']; 
	$user_liked = $row['posted_by'];

	$user_details_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$user_liked'");
	$row = mysqli_fetch_array($user_details_query);
	//$total_user_likes = $row['num_likes'];

	//Like button
	if(isset($_POST['like_button'])) {
		$total_likes++;
		$query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
		//$total_user_likes++;
		//$user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
		$insert_user = mysqli_query($con, "INSERT INTO likes(username,post_id) VALUES('$userLoggedIn', '$post_id')");

		//Insert Notification
	}
	//Unlike button
	if(isset($_POST['unlike_button'])) {
		$total_likes--;
		$query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
		//$total_user_likes--;
		//$user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
		$insert_user = mysqli_query($con, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
	}

	//Check for previous likes
	$check_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
	$num_rows = mysqli_num_rows($check_query);

	if($num_rows > 0) {
		echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
				<input type="submit" class="comment_like" name="unlike_button" value="Unlike">
				<div class="like_value" style="padding-top: 10px;">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}
	else {
		echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
				<input type="submit" class="comment_like" name="like_button" value="Like">
				<div class="like_value" style="padding-top: 10px;">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}

	?>

</body>
</html>