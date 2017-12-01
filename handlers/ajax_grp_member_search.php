<?php
	
include("../config.php");
include("../classes/UserClass.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

?>

<head>		
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   		<script src = "js/search.js"></script>
</head>

<?php

$names = explode(" ", $query);
	
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
			$profile_pic = "profile_pics/".$row['propic'];
			if($row['user_id'] != $userLoggedIn) {
				echo "	<div class='resultsDisplay'>
							<div onclick= selectUser('" . $row['user_id'] ."')>
								<div class='liveSearchProfilePic' onclick= 'selectUser(" . $row['user_id'] .")'>
				 					<img src='".$profile_pic."'>
				 				</div>
								<div class='liveSearchText' onclick= 'selectUser(" . $row['user_id'] .")'>
									".$row['first_name'] . " " . $row['last_name']."
			 						<p>". $row['user_id'] . "</p>
			 					</div>
							</div>
						</div>";
			}	
		}
	}
?>