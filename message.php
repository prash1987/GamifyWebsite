<?php 
    include("config.php");
    include("header.php");  
	include("classes/UserClass.php");
	include("classes/PostClass.php");
	include("classes/MessageClass.php");


	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
		header("Location: login.php");
	}


$user_obj = new UserClass($con, $userLoggedIn);
$message_obj = new MessageClass($con, $userLoggedIn);

if(isset($_GET['u']))
	$user_to = $_GET['u'];
else {
	$user_to = $message_obj->getMostRecentUser();
	if($user_to == false)
		$user_to = 'new';
	}

if($user_to != "new")
	$user_to_obj = new UserClass($con, $user_to);

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		$body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date);

	}
}

?>
<!DOCTYPE html>
<!-- user details column -->
	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
         <link href = "css/styles.css" rel = "stylesheet">
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   		<script src = "js/custom.js"></script>
   		<script src = "js/search.js"></script>

   		<script type="text/javascript">
   			function getUsers(value, user){
			  $.post("handlers/ajax_friend_search.php", {query:value, userLoggedIn:user}, function (data){
			    $(".results").html(data);
			  });
			}
   		</script>

   	</head>
   	
   	<br><br><br>
	<div class="col-md-2 column col-md-offset-0-5">
		
		<a href="<?php echo $userLoggedIn;?>">  <img height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>"> </a>
		
		<br><br>
		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn;?>">
			<b><?php echo $user_obj->getFirstAndLastName(); ?></b>
			</a>
			<br>
			<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
			echo "Contact: " . $user_obj->getUserContact() ;
			?>
		</div>
		<br><br>

		<h4>Conversations</h4>

		<div class = 'loaded_conversations'>
			<?php echo $message_obj->getConvos(); ?>
		</div>
		<br>
		<a href="message.php?u=new" class='btn btn-primary btn-xs'>New Message</a>
	</div>

	<div class="col-md-6 column col-md-offset-0-5">
		<?php  
		if($user_to != "new"){
			echo "<h4><a href='$user_to'><img src='".$user_to_obj->getProPic()."' style='border-radius:5px; margin-right:5px;height: 35px;float: left;'>" . $user_to_obj->getFirstAndLastName() . "</a> and You</h4><hr><br>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
			echo "</div>";
		}
		else {
			echo "<h4>New Message</h4>";
		}
		?>
		<br>
		<div class="message_post">
			<form action="" method="POST">
				<?php
				if($user_to == "new")
				{
					echo "Select the friend you would like to message <br><br>";
					?>
					To: <input type="search" onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='search_text_input' onsearch="getUsers('','')">

					<?php
						echo "<div class='results'></div>";
				}
				else
				{
					echo "<hr><textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>";
					echo "<input type='submit' name='post_message' class='btn btn-primary' value='Send'>";
				}

				?>
				

			</form>

		</div>

		<script type="text/javascript">
			function ready(){
   				var div = document.getElementById("scroll_messages");
   				div.scrollTop = div.scrollHeight;
   			}
   		</script>
	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		Ads will appear here
	</div>