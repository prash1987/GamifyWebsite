<?php  
	// require 'config.php';
	include("header.php");
	// include("classes/UserClass.php");
	// include("classes/PostClass.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
		//echo $userLoggedIn;
		$user_details_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$userLoggedIn'");
		$user_info = mysqli_fetch_array($user_details_query);
		$user_obj = new UserClass($con, $userLoggedIn);
		
	}
	else
	{
		header("Location: login.php");
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
		<a href="<?php echo 'profile.php?profile_username=' . $userLoggedIn;?>"><img height='126' width='126' src="<?php echo $user_obj->getProPic(); ?>"> </a>

		<br><br>

		<div class="user_details_left_right">				
				<a href="<?php echo 'profile.php?profile_username=' . $userLoggedIn;?>">
				<b><?php echo $user_obj->getFirstAndLastName(); ?></b>
				</a>
				<br>
				<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
				echo "Contact: " . $user_obj->getUserContact() ; ?>
					
		</div>
	</div>

	<div class="col-md-6 column col-md-offset-0-5">
		<?php
			echo "<h3>People Blocked By You ";
			//echo $user_obj->getFirstAndLastName();
			echo "</h3><hr>";
			$post = new PostClass($con, $userLoggedIn);
			$post->display_blocked($userLoggedIn);
			
		?>
	</div>

	<!-- <div class="col-md-3 column col-md-offset-0-5">
	</div> -->
	<div class="col-md-3" style="margin-left: 13px; margin-top: 10px;">
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
