<?php 
    include("header.php");
    include("config.php");
    include("classes/UserClass.php");
    include("classes/PostClass.php");

    session_start();


	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
	}
	else
	{
		header("Location: user.php");
	}

	$user_obj = new UserClass($con, $userLoggedIn);

	if(isset($_POST['post'])){
		$post = new PostClass($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], $_POST['post_location'], $_POST['post_time'], 'none');
		
	}
?>
	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<script>
		  // $( function() {
		  //   $( "#post_time" ).datepicker({ dateFormat: 'yy-mm-dd' });

		  // } );

			function noGamePrefFunction()
				{
					// Unselecting Gender Preferences
					document.getElementById("gender_pref_men_only").checked = false;
					document.getElementById("gender_pref_women_only").checked = false;
					document.getElementById("gender_pref_all").checked = false;

					//Unselecting Game preferences
					document.getElementById("game_pref_cricket").checked = false;
					document.getElementById("game_pref_badminton").checked = false;
					document.getElementById("game_pref_tennis").checked = false;
					document.getElementById("game_pref_squash").checked = false;
					document.getElementById("game_pref_running").checked = false;
					document.getElementById("game_pref_football").checked = false;
					document.getElementById("game_pref_basketball").checked = false;
					document.getElementById("game_pref_cycling").checked = false;
					document.getElementById("game_pref_gym").checked = false;
					document.getElementById("game_pref_dance").checked = false;
					document.getElementById("game_pref_martialarts").checked = false;
				    document.pref_form.action = "homepage.php";
				    document.pref_form.submit(); 
				    return true;
				}
		</script>
	</head>

	<br><br><br>
	<div class="user_details column">
		<br><br>
		<a href="<?php echo $userLoggedIn; ?>">  <img src="pro_pic.png"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php echo $user_obj->getFirstAndLastName(); ?>
			</a>
			<br>
			<?php echo "Location: " . $user_obj->getUserLocation() . "<br>"; 
			echo "Contact: " . $user_obj->getUserContact() ;
			?>
			<br>
			<br>	
			<form action="homepage.php" name="pref_form" method="POST">
				<fieldset>
         			<legend>Select Pref</legend>
         				<p>Gender Pref</p>
	       				<input type = "radio" id = "gender_pref_men_only" name="gender_pref" value = "men" />
     					<label for = "event_pref_men_only">Men Only</label> 
     					<br>
     					<input type = "radio" id = "gender_pref_women_only" name= "gender_pref" value = "women" />
     					<label for = "event_pref_women_only">Women Only</label> 
     					<br>	
						<input type = "radio" id = "gender_pref_all" name= "gender_pref" value = "all" />
     					<label for = "event_pref_women_only">All Events</label> 
     					<br>
     					<!--input type = "submit" value="Change Preferences" /-->
     					<!--input type = "button" name ="clear_pref_button" id="clear_pref_button" value="Clear Preferences" onclick="noPrefFunction()" /-->
         				<p>Game Pref</p>
	       				<input type = "checkbox" id = "game_pref_cricket" name="game_pref_cricket" value="Cricket"/>
     					<label for = "game_pref_cricket">Cricket</label> 
     					<br>
     					<input type = "checkbox" id = "game_pref_badminton" name= "game_pref_badminton" value="Badminton"/>
     					<label for = "game_pref_badminton">Badminton</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_tennis" name= "game_pref_tennis" value="Tennis"/>
     					<label for = "game_pref_tennis">Tennis</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_squash" name= "game_pref_squash" value="Squash"/>
     					<label for = "game_pref_squash">Squash</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_running" name= "game_pref_running" value="Running"/>
     					<label for = "game_pref_running">Running</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_football" name= "game_pref_football" value="Football"/>
     					<label for = "game_pref_football">Football</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_basketball" name= "game_pref_basketball" value="Basketball"/>
     					<label for = "game_pref_basketball">Basketball</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_cycling" name= "game_pref_cycling" value="Cycling"/>
     					<label for = "game_pref_cycling">Cycling</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_gym" name= "game_pref_gym" value="Gym"/>
     					<label for = "game_pref_gym">Gym</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_dance" name= "game_pref_dance" value="Dance"/>
     					<label for = "game_pref_dance">Dance</label>
     					<br>
     					<input type = "checkbox" id = "game_pref_martialarts" name= "game_pref_martialarts" value="MartialArts" />
     					<label for = "game_pref_martialarts">Martial Arts</label>
     					<br>
     					<input type = "submit" value="Change Preferences" />
     					<input type = "button" name ="no_pref_button" id="no_pref_button" value="Clear Preferences" onclick="noGamePrefFunction()" />
     			</fieldset>

    		</form>

		</div>

	</div>

	<div class="main_column column">
		<form class="post_form" action="homepage.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Post here"></textarea>
			<input type="submit" name="post" id="post_button" value="Post"><br>
			<input type="text" name="post_location" id = "post_location" placeholder="Location">
			<input type="datetime-local" name="post_time" id = "post_time" placeholder="Date and Time">		
			<hr>
		</form>

		<?php 
		$gender_pref = "";
		$game_pref = "";
		$post = new PostClass($con, $userLoggedIn);
		//$user_location = $_POST['post_location'];
		if(isset($_POST['gender_pref'])){
			if ($_POST['gender_pref'] == "men")
				$gender_pref = 'M';
			elseif ($_POST['gender_pref'] == "women")
				$gender_pref = 'F';
			elseif ($_POST['gender_pref'] == "all")
				$gender_pref = 'A';
		}

		if(isset($_POST['game_pref_cricket'])){
			$game_pref .= "'Cricket',";
		}
		if(isset($_POST['game_pref_badminton'])){
			$game_pref .= "'Badminton',";
		}
		if(isset($_POST['game_pref_tennis'])){
			$game_pref .= "'Tennis',";
		}
		if(isset($_POST['game_pref_squash'])){
			$game_pref .= "'Squash',";
		}
		if(isset($_POST['game_pref_running'])){
			$game_pref .= "'Running',";
		}
		if(isset($_POST['game_pref_football'])){
			$game_pref .= "'Football',";
		}
		if(isset($_POST['game_pref_basketball'])){
			$game_pref .= "'Basketball',";
		}
		if(isset($_POST['game_pref_cycling'])){
			$game_pref .= "'Cycling',";
		}
		if(isset($_POST['game_pref_gym'])){
			$game_pref .= "'Gym',";
		}
		if(isset($_POST['game_pref_dance'])){
			$game_pref .= "'Dance',";
		}
		if(isset($_POST['game_pref_martialarts'])){
			$game_pref .= "'MartialArts',";
		}
		$game_pref = rtrim($game_pref,',');
		//echo $game_pref; 									//Just for testing whether its working correctly or not
		$post->loadPostsFriends($gender_pref, $game_pref);
		?>


	</div>

</body>
</html>