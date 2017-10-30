<?php
	
include("../config.php");
include("../classes/UserClass.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

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
		while ($row = mysqli_fetch_array($usersReturned)){
			//$user = new UserClass($con, $userLoggedIn);
			// $user_id = str_replace("'", "", $row['user_id']);
			// $user_id = mysqli_escape_string($con, $row['user_id']);
			$profile_pic = "profile_pics/".$row['propic'];
			if($row['user_id'] != $userLoggedIn) {
				echo "<div class='resultsDisplay'>
							<a href = message.php?u=" . $row['user_id'] ." style='color:#000'>

							<div class='liveSearchProfilePic'>
			 					<img src='".$profile_pic."'>
			 				</div>
							<div class='liveSearchText'>
								".$row['first_name'] . " " . $row['last_name']."
		 						<p>". $row['user_id'] . "</p>
		 					</div>
						</a>
					</div>";
			}

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
	}
?>