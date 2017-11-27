<?php  
	include("header.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
		header("Location: login.php");
	}

	$message_obj = new MessageClass($con, $userLoggedIn);

	if (isset($_GET['profile_username'])) {
		$username = $_GET['profile_username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$username'");
		$user_info = mysqli_fetch_array($user_details_query);
		$user_obj = new UserClass($con, $username);
	}
	else {
		header("Location: login.php");
	}

	if(isset($_POST['post_message'])) {
		if(isset($_POST['message_body'])) {
			$body = mysqli_real_escape_string($con, $_POST['message_body']);
			$date = date("Y-m-d H:i:s");
			$message_obj->sendMessage($username, $body, $date);
		}
		$link ='#profileTabs a[href="#messages_div"]';
		echo "<script>
				$(function() {
					$('". $link ."').tab('show');
				});
			</script>";
	}

?>



	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
		<link href="css/styles.css" rel="stylesheet">
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   		<script src = "js/search.js"></script>
   	</head>

	<br><br><br><br>
	<div class="col-md-2 column col-md-offset-0-5">
		<img class="img-circle" height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>">
		<br><br>

		<div class="user_details_left_right">				
				<b><?php echo $user_obj->getFirstAndLastName(); ?></b>
				<br>
				<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
				echo "Contact: " . $user_obj->getUserContact() ; ?>
		</div>
		<br><br>
		<?php if($username==$userLoggedIn){
			echo "<button name='update_profile' class='btn btn-primary btn-sm'>Update Profile</button>";
		}
		?>

	</div>

	<div class="col-md-6 column col-md-offset-0-5">

		<ul class="nav nav-tabs" role="tablist" id="profileTabs">
  			<li class="active"><a href="#newsfeed_div" aria-controls="newsfeed_div" role="tab" data-toggle="tab">Posts</a></li>
  			<!--li><a href="#about_div" aria-controls="about_div" role="tab" data-toggle="tab">About</a></li-->
  			<?php 
  				if($username != $userLoggedIn) {
  					echo "<li><a href='#messages_div' aria-controls='messages_div' role='tab' data-toggle='tab'>Messages</a></li>";
  				}
  			?>

		</ul>

		<div class="tab-content">
			<div role ="tabpanel" class="tab-pane fade in active" id="newsfeed_div">
				<?php
					echo "<h3>Posts by ";
					echo $user_obj->getFirstAndLastName();
					echo "</h3><hr>";
					$post = new PostClass($con, $username);
					$post->loadPostsOwn($username);
				?>
			</div>

			<!--div role ="tabpanel" class="tab-pane fade in active" id="about_div">
				
			</div-->

			<div role ="tabpanel" class="tab-pane fade" id="messages_div">
				<?php  
					
					echo "<h4><a href='profile.php?profile_username='".$username."'><img src='".$user_obj->getProPic()."' style='border-radius:5px; margin-right:5px;height: 35px;float: left;'>" . $user_obj->getFirstAndLastName() . "</a> and You</h4><hr><br>";
					echo "<div class='loaded_messages' id='scroll_messages'>";
						echo $message_obj->getMessages($username);
					echo "</div>";
				?>
				<br>
				<div class="message_post">
					<form action="" method="POST">
						<hr><textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>
						<input type='submit' name='post_message' class='btn btn-primary' value='Send'>
					</form>
				</div>
				<script type="text/javascript">
					function ready(){
		   				var div = document.getElementById("scroll_messages");
		   				div.scrollTop = div.scrollHeight;
		   			}
		   		</script>
			</div>
		</div>
	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		<?php echo "Ads appear here" ?>
	</div>

</body>
</html>