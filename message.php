<?php 
    include("header.php");  

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
		header("Location: login.php");
	}

$date = date("Y-m-d H:i:s");
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

//echo $user_to;

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
         <link href = "css/styles.css" rel ="stylesheet">
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

			function getMessagesForLiveChat(){
				var user_to = "<?php if(isset($user_to) and ($user_to != 'new') and $user_obj->isFriend($user_to)) echo $user_to; ?>";
				//alert("This is the get function");
				//alert(user_to);
				var func = "getMessages";
				$.post("handlers/ajax_live_chat.php", {user_to:user_to, func:func}, function (data){
			    	$(".loaded_messages").html(data);
			  });	
			}

			$('#message_textarea').keyup(function() {
				var data = document.getElementById('message_textarea').value;
    			alert(data)
			});

			getMessagesForLiveChat();

			var myVar = setInterval(getMessagesForLiveChat, 1000);

			/*function sendMessagesForLiveChat(){
				var user_to = "<?php //if(isset($user_to) and ($user_to != 'new')) echo ($user_to); ?>";
				alert("This is the send function");
				alert(user_to);
				var date = "<?php //echo $date; ?>";
				//var date = document.getElementById('message_date').value;
				//var body = "<?php //echo $body; ?>";
				var body = document.getElementById('message_textarea').value;
				alert(date);
				alert(body);
				document.getElementById('message_textarea').value = "";
				var func = "sendMessages";
				$.post("handlers/ajax_live_chat.php", {user_to:user_to, date:date, body:body, func:func});
			}*/

			// When the user scrolls down 20px from the top of the document, show the button
			// Implemented by Sagar
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			        document.getElementById("myBtn").style.display = "block";
			    } else {
			        document.getElementById("myBtn").style.display = "none";
			    }
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
			    document.body.scrollTop = 0;
			    document.documentElement.scrollTop = 0;
			}
   		</script>
   		<style>
			#myBtn {
			  display: none;
			  position: fixed;
			  bottom: 20px;
			  right: 30px;
			  z-index: 99;
			}
		</style>

   	</head>
   	
   	<br><br><br>
	<div class="col-md-2 column col-md-offset-0-5">
		
		<a href="<?php echo 'profile.php?profile_username=' . $userLoggedIn;?>"><img height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>"> </a>
		
		<br><br>
		<div class="user_details_left_right">
			<a href="<?php echo 'profile.php?profile_username=' . $userLoggedIn;?>">
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
		if($user_to != "new" and $user_obj->isFriend($user_to)){
			echo "<h4><a href='profile.php?profile_username=$user_to'><img src='".$user_to_obj->getProPic()."' style='border-radius:5px; margin-right:5px;height: 35px;float: left;'>" . $user_to_obj->getFirstAndLastName() . "</a> and You</h4><p class='user_typing'></p><hr><br>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				//echo $message_obj->getMessages($user_to);
			echo "</div>";
		}
		else {
			echo "<h4>New Message</h4>";
		}
		?>
		<br>
		<?php
		if($user_obj->isFriend($user_to))
		{
		?>

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
						//echo "<input type='button' name='post_message' class='btn btn-primary' onclick='sendMessagesForLiveChat()' value='Send'>";
					}
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

		<!--@Author- Harsha: Ads-->
	<div class="col-md-3 column col-md-offset-0-5">
		<a href="message.php">Testing</a>
	</div>
	<div class="col-md-3 ads">
		<div style="max-width: 500px;">	
	  
	  		<a target="_blank" href="https://www.ebay.com/b/Mens-Fitness-Running-Shoes/158952/bn_1965202">
	  		<img class="mySlides" src="images/ads/ad_ebay.jpg" style="width:100%"></a>
	  
	  		<a target="_blank" href="http://www.indianavolleyballcamps.com/index.html">
	  		<img class="mySlides" src="images/ads/ad_volleyball.jpg" style="width:100%"></a>

	  		<a target="_blank" href="http://northamericasports.blogspot.ca/2012/09/new-nike-epl-match-ball-maxim-for.html">
	  		<img class="mySlides" src="images/ads/ad_nike.jpg" style="width:100%"></a>
	  
	  		<a target="_blank" href="https://www.anytimefitness.com/gyms/2822/bloomington-in-47401/">
	  		<img class="mySlides" src="images/ads/ad_gym.jpg" style="width:100%"></a>

	  		<a target="_blank" href="https://www.pinterest.com/pin/316659417526781056/">
	  		<img class="mySlides" src="images/ads/ad_adidas.jpg" style="width:100%"></a>

	  		<a target="_blank" href="https://www.amazon.com/Best-Sellers-Health-Personal-Care-Sports-Nutrition-Protein/zgbs/hpc/6973704011/ref=zg_bs_unv_hpc_3_6973717011_2">
	  		<img class="mySlides" src="images/ads/ad_protein.jpg" style="width:100%"></a>
		</div>
		<button onclick="topFunction()" id="myBtn" class="btn btn-primary btn-lg" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
	</div>
		
	<script>
			var myIndex = 0;
			carousel();

			function carousel() {
	    	var i;
	    	var x = document.getElementsByClassName("mySlides");
	    	for (i = 0; i < x.length; i++) {
	       		x[i].style.display = "none";  
	    	}
	    	myIndex++;
	    	if (myIndex > x.length) {myIndex = 1}    
	    	x[myIndex-1].style.display = "block";  
	    	setTimeout(carousel, 3000); // Change image every 3 seconds
			}
	</script>
	</body>
</html>