<?php  
	include("header.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
		$user_obj = new UserClass($con, $userLoggedIn);
	}
	else
	{
		header("Location: login.php");
	}
	
	if (isset($_GET['group_id'])) {
		$group_id = $_GET['group_id'];
	}
	else {
		header("Location: homepage.php");
	}

?>
	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
		<link href="css/styles.css" rel="stylesheet">
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   		   		
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
	</div>

	<div class="col-md-6 column col-md-offset-0-5">		
		<?php
					echo "<h3>Group Posts - " . $group_id;
					//echo $user_obj->getFirstAndLastName();
					echo "</h3><hr>";
					$post = new PostClass($con, $userLoggedIn);
					$post->loadPostsGroups($group_id);
				?>		
	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		<?php
			$data_member= "";
			$sqlMember = mysqli_query($con, "SELECT group_id, group_name FROM groups WHERE members like '%" . $userLoggedIn . "%';");
		
			while($row_member = mysqli_fetch_array($sqlMember)) {
				$member_group_name = $row_member['group_name'];			
				$div_member = "<div><a href='group_posts.php?group_id=" . $row_member['group_id'] . "'>" . $member_group_name . "</a></div>";				
				$data_member = $data_member . $div_member . "<br>";
			}
			echo $data_member;	
		?>
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
	</body>
</html>