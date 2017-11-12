<html>
<head>
	<title></title>

	<link href="sn_styles.css" rel="stylesheet" type="text/css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<script language="Javascript">
    <!--
    function likePost()
    {
    	alert('clicked like button');    	    	
        document.Form1.submit(); 
        return true;
    }

    function unlikePost()
    {       
    	alert('clicked unlike button');    	
        document.Form1.submit();
        return true;
    }
    -->
    </script>

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
		header("Location: login.php");
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
		echo '<form name="Form1" action="like.php?post_id=' . $post_id . '" method="POST">
				<br><i class="glyphicon glyphicon-thumbs-down comment_like" onclick="unlikePost();" name="unlike_button" id="unlike_button" ></i>
				<div class="like_value" style="padding-top: 10px;">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}
	else {
		echo '<form name="Form1" action="like.php?post_id=' . $post_id . '" method="POST">
				<br><i class="glyphicon glyphicon-thumbs-up comment_like" onclick="likePost();" name="like_button" id="like_button" ></i>
				<div class="like_value" style="padding-top: 10px;">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}

	?>

</body>
</html>