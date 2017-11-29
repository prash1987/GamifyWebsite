<?php
	
include("../config.php");
include("../classes/UserClass.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$time = time();
$status_query = mysqli_query($con, "UPDATE user SET status_timestamp = '$time' WHERE User_id = '$userLoggedIn'");

$names = explode(" ", $query);
	
	// The below code is commented because still not added the column to check whether user has deleted the account or not.
	/*if(strpos($query, "_") !== false) {
		$usersReturned = mysqli_query($con, "SELECT * FROM user WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
	}
	else if(count($names) == 2){
		$usersReturned = mysqli_query($con, "SELECT * FROM user WHERE (first_name LIKE '%$names[0]%' AND last_name LIKE '%$names[1]%') AND user_closed = 'no' LIMIT 8");
	}
	else{
		$usersReturned = mysqli_query($con, "SELECT * FROM user WHERE (first_name LIKE '%$names[0]%' OR last_name LIKE '%$names[0]%') AND user_closed = 'no' LIMIT 8");
	}*/

	if(strpos($query, "@") !== false) {
		$usersReturned = mysqli_query($con, "SELECT * FROM user WHERE user_id LIKE '%$query%' LIMIT 8");
	}
	else if(count($names) == 2){
		$usersReturned = mysqli_query($con, "SELECT * FROM user WHERE (first_name LIKE '%$names[0]%' AND last_name LIKE '%$names[1]%' OR user_id LIKE '%$names[0]%' OR user_id LIKE '%names[1]%') LIMIT 8");
	}
	else{
		$usersReturned = mysqli_query($con, "SELECT * FROM user WHERE (first_name LIKE '%$names[0]%' OR last_name LIKE '%$names[0]%' OR user_id LIKE '%$names[0]%') LIMIT 8");
	}

	if($query != ""){

		$searched_users = array();
		while ($row = mysqli_fetch_array($usersReturned)){
			if($row['user_id'] != $userLoggedIn)
				array_push($searched_users, $row['user_id']);
		}

		foreach($searched_users as $username){
			$user_found_obj = new UserClass($con, $username);

			if($user_found_obj->getStatus())
				$status = "<img src='images/icons/online.png' style='float:right; height:16px;' title='".$user_found_obj->getFirstAndLastName()." is online'>";
			else
				$status = "<img src='images/icons/offline.png' style='float:right; height:16px;' title='".$user_found_obj->getFirstAndLastName()." is offline'>";

			echo "<div class='resultsDisplay'>
		 					<a href = message.php?u=" . $user_found_obj->getUserName() ." style='color:#000'>

		 					<div class='liveSearchProfilePic'>
		 	 					<img src='".$user_found_obj->getProPic()."'>
		 	 				</div>
		 					<div class='liveSearchText'>
		 						".$user_found_obj->getFirstAndLastName()."
		  						<p>". $user_found_obj->getUserName() ." ".$status."</p>
		 					</div>
		 				</a>
		 			</div>";
		}

		// Code Commented by Sagar on 11/29/2017 to test the object oriented method to fetch the data-----------------------------------------------------
		// while ($row = mysqli_fetch_array($usersReturned)){
		// 	//$user = new UserClass($con, $userLoggedIn);
		// 	// $user_id = str_replace("'", "", $row['user_id']);
		// 	// $user_id = mysqli_escape_string($con, $row['user_id']);
		// 	$profile_pic = "profile_pics/".$row['propic'];
		// 	if($row['user_id'] != $userLoggedIn) {
		// 		if(time() < $row['status_timestamp'] + 20)
		// 			$status = "<img src='images/icons/online.png' style='float:right; height:16px;' title='".$row['first_name'] . " " . $row['last_name']." is online'>";
		// 		else
		// 			$status = "<img src='images/icons/offline.png' style='float:right; height:16px;' title='".$row['first_name'] . " " . $row['last_name']." is offline'>";

		// 		echo "<div class='resultsDisplay'>
		// 					<a href = profile.php?profile_username=" . $row['user_id'] ." style='color:#000'>

		// 					<div class='liveSearchProfilePic'>
		// 	 					<img src='".$profile_pic."'>
		// 	 				</div>
		// 					<div class='liveSearchText'>
		// 						".$row['first_name'] . " " . $row['last_name']."
		//  						<p>". $row['user_id'] . " ".$status."</p>
		//  					</div>
		// 				</a>
		// 			</div>";
		// 	}
		// Code Commenting ends here------------------------------------------------------------------------------------------------------------		

			// if($row['user_id'] != $userLoggedIn) {
			// 	$mutual_friends = $user->getFirstAndLastName();
			// }
			// else{
			// 	$mutual_friends = "";
			// }

			// if($user->isFriend($row['user_id'])){
			// 	echo "<div class='resultDisplay'>
			// 				<a href = message.php?u='" . $row['user_id'] ."' style='color:#000'>

			// 					<div class='liveSearchProfilePic'>
			// 						<img src='". $row['propic']."'>
			// 					</div>

			// 					<div class='liveSearchText'>
			// 						".$row['first_name'] . " " . $row['last_name']."
			// 						<p>". $row['user_id'] . "</p>
			// 						<p id='grey'>".$mutual_friends . "</p>
			// 					</div>
			// 				</a>
			// 			</div>";
			// }	
	}
?>