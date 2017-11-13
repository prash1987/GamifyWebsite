<?php
class PostClass {
	private $user_obj;
	private $con;

	public function __construct($con, $user) {
		$this->con = $con;
		$this->user_obj = new UserClass($con, $user);
	}

	public function submitPost($body, $location, $play_time, $game, $gender, $image_name) {
		$body = strip_tags($body); 
		$body = mysqli_real_escape_string($this->con, $body);
		$play_time = strip_tags($play_time); 
		$play_time = mysqli_real_escape_string($this->con, $play_time);
		$location = strip_tags($location); 
		$location = mysqli_real_escape_string($this->con, $location);
		
		if (!isset($image_name) || trim($image_name) == '') {
    		$image_name="default_post.jpg";
		}
		$game = strip_tags($game); 
		$game = strtoupper(mysqli_real_escape_string($this->con, $game));
		$gender = strip_tags($gender); 
		$gender = mysqli_real_escape_string($this->con, $gender);
		
		$time_stamp = date("Y-m-d H:i:s");
		$posted_by = $this->user_obj->getUsername();

		$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$insert_stmnt = "INSERT INTO posts(body, posted_by, time_stamp, location, play_time, image_path, likes,game,gender,deleted) VALUES('$body','$posted_by','$time_stamp', '$location', '$play_time', '$image_name',0,'$game', '$gender', 0)";
		$query = mysqli_query($con, $insert_stmnt);
		$returned_id = mysqli_insert_id($con);
	}

	//Load my posts
	public function loadPostsOwn($username) {

		$folder="images/";

		if(isset($_SESSION['login_user'])) {
				$userLoggedIn = $_SESSION['login_user'];
		}
		else
		{
			header("Location: login.php");
		}

		$query = "SELECT * FROM posts WHERE posted_by='$username' AND deleted = 0 ORDER BY time_stamp DESC";
		$str = ""; //String to return 
		$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$data_query = mysqli_query($con, $query);  
		$delete_button = "";

			//chaos start from here
			if(mysqli_num_rows($data_query) > 0) {

			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['id'];
				$body = $row['body'];
				$location = $row['location'];
				$play_time = $row['play_time'];
				$added_by = $row['posted_by'];
				$date_time = $row['time_stamp'];
				$image_path = $folder . $row['image_path'];
				$game = $row['game'];
				$gender = $row['gender'];
				if ($gender == 'A'){
					$gender = "This event is open for <b>All</b>";
				}
				elseif ($gender == 'M') {
					$gender = "This event is open to <b>Males</b> only";
				}
				elseif ($gender == 'F') {
					$gender = "This event is open to <b>Females</b> only";
				}

				if(isset($_SESSION['login_user'])) {
					$userLoggedIn = $_SESSION['login_user'];
				}
				else
				{
					header("Location: login.php");
				}

				/*This is the delete button logic*/
				if($userLoggedIn == $added_by){
					$delete_id = "post_".$id;
					$delete_button = "<i class='delete_button glyphicon glyphicon-remove' id='$delete_id' onClick='delete_function(\"$delete_id\");'></i>";
				}
				else {
					$delete_button = "";
				}

				$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
				// Here we have to use user name I HAVE USED EMAIL ID
				// WE NEED TO STORE USING USERNAME IN POSTS TABLE.
				$user_details_query = mysqli_query($con, "SELECT first_name, last_name FROM user WHERE email='$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
				// $profile_pic = $user_row['profile_pic'];

				?>
				<script> 
					function toggle<?php echo $id; ?>() {

						var target = $(event.target);
						if (!target.is("a")) {
							var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if(element.style.display == "block") 
								element.style.display = "none";
							else 
								element.style.display = "block";
						}
					}

				</script>
				<?php
				$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
				$comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
				$comments_check_num = mysqli_num_rows($comments_check);


				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_time); //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates 
				if($interval->y >= 1) {
					if($interval == 1)
						$time_message = $interval->y . " year ago"; //1 year ago
					else 
						$time_message = $interval->y . " years ago"; //1+ year ago
				}
				else if ($interval-> m >= 1) {
					if($interval->d == 0) {
						$days = " ago";
					}
					else if($interval->d == 1) {
						$days = $interval->d . " day ago";
					}
					else {
						$days = $interval->d . " days ago";
					}


					if($interval->m == 1) {
						$time_message = $interval->m . " month". $days;
					}
					else {
						$time_message = $interval->m . " months". $days;
					}

				}
				else if($interval->d >= 1) {
					if($interval->d == 1) {
						$time_message = "Yesterday";
					}
					else {
						$time_message = $interval->d . " days ago";
					}
				}
				else if($interval->h >= 1) {
					if($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					}
					else {
						$time_message = $interval->h . " hours ago";
					}
				}
				else if($interval->i >= 1) {
					if($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					}
					else {
						$time_message = $interval->i . " minutes ago";
					}
				}
				else {
					if($interval->s < 30) {
						$time_message = "Just now";
					}
					else {
						$time_message = $interval->s . " seconds ago";
					}
				}

				$str .= "<div class='status_post'>

							<div class='posted_by' style='color:#ACACAC;'>
								<a href='profile.php?profile_username=$added_by'>
								<b> $first_name $last_name </b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_message
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$delete_button

							</div>

							<div id='post_body'>
								$body
								<br>
							</div>
							<div id='post_loc_and_play_time'>
								$location
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								$play_time								
								<br>
								<span>Game: $game</span>
								&nbsp;&nbsp;&nbsp;&nbsp;
								
								<span> $gender </span>								
							</div>
							<br>
							<img src='$image_path' height='40%' width='40%'></img>
							<div class='newsfeedPostOptions'>	
								<button id='comment_anchor' class='btn btn-primary btn-xs' onClick='javascript:toggle$id();'>Comments($comments_check_num)</button>&nbsp;&nbsp;&nbsp;	
								<span style='margin-top:10px;'><iframe allowtransparency='true' src='like.php?post_id=$id' style='height: 47px; width: 130px;' frameBorder='0'  scrolling='no'></iframe>
								</span>
							</div>

						</div>

							<div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						
						<hr>";
			} 
			echo $str;
		}
	}

	//chaos end here

	//Load firends posts
	public function loadPostsFriends($gender_pref,$game_pref) {

		$folder="images/";

		$userLocation = $this->user_obj->getUserLocation();
		
		if($gender_pref!="" || $game_pref!=""){
			if ($gender_pref == 'M' || $gender_pref == 'F' || $gender_pref == 'A') {
				$sql[] = " gender = '$gender_pref' ";
			}

			if ($game_pref != ""){
				if($game_pref != "ALL") {
					$sql[] = "game IN ($game_pref)";
				}	
			}
		}
		else
		{
			$userbio = $this->user_obj->getUserBio();
			$userbio = "'" . $userbio . "'";
			$userbio = str_replace(",", "','", $userbio);
			$sql[] = "game IN ($userbio)";
		}

		$query = "SELECT * FROM posts WHERE location='$userLocation' AND deleted = 0";


		if (!empty($sql)) {
    		$query .= ' and ' . implode(' and ', $sql);
		}

		$query .= " ORDER BY time_stamp DESC";

		$str = ""; //String to return 
		$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$data_query = mysqli_query($con, $query);  
		$delete_button = "";

		if(mysqli_num_rows($data_query) > 0) {


			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['id'];
				$body = $row['body'];
				$location = $row['location'];
				$play_time = $row['play_time'];
				$added_by = $row['posted_by'];
				$date_time = $row['time_stamp'];
				$image_path = $folder . $row['image_path'];
				$game = $row['game'];
				$gender = $row['gender'];
				if ($gender == 'A'){
					$gender = "This event is open for <b>All</b>";
				}
				elseif ($gender == 'M') {
					$gender = "This event is open to <b>Males</b> only";
				}
				elseif ($gender == 'F') {
					$gender = "This event is open to <b>Females</b> only";
				}

				if(isset($_SESSION['login_user'])) {
					$userLoggedIn = $_SESSION['login_user'];
				}
				else
				{
					header("Location: login.php");
				}

				/*This is the delete button logic*/
				if($userLoggedIn == $added_by){
					$delete_id = "post_".$id;
					$delete_button = "<i class='delete_button glyphicon glyphicon-remove' id='$delete_id' onClick='delete_function(\"$delete_id\");'></i>";
				}
				else {
					$delete_button = "";
				}



				$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
				// Here we have to use user name I HAVE USED EMAIL ID
				// WE NEED TO STORE USING USERNAME IN POSTS TABLE.
				$user_details_query = mysqli_query($con, "SELECT first_name, last_name FROM user WHERE email='$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
				// $profile_pic = $user_row['profile_pic'];

				?>
				<script> 
					function toggle<?php echo $id; ?>() {

						var target = $(event.target);
						if (!target.is("a")) {
							var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if(element.style.display == "block") 
								element.style.display = "none";
							else 
								element.style.display = "block";
						}
					}

				</script>
				<?php
				$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
				$comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
				$comments_check_num = mysqli_num_rows($comments_check);


				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_time); //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates 
				if($interval->y >= 1) {
					if($interval == 1)
						$time_message = $interval->y . " year ago"; //1 year ago
					else 
						$time_message = $interval->y . " years ago"; //1+ year ago
				}
				else if ($interval-> m >= 1) {
					if($interval->d == 0) {
						$days = " ago";
					}
					else if($interval->d == 1) {
						$days = $interval->d . " day ago";
					}
					else {
						$days = $interval->d . " days ago";
					}


					if($interval->m == 1) {
						$time_message = $interval->m . " month". $days;
					}
					else {
						$time_message = $interval->m . " months". $days;
					}

				}
				else if($interval->d >= 1) {
					if($interval->d == 1) {
						$time_message = "Yesterday";
					}
					else {
						$time_message = $interval->d . " days ago";
					}
				}
				else if($interval->h >= 1) {
					if($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					}
					else {
						$time_message = $interval->h . " hours ago";
					}
				}
				else if($interval->i >= 1) {
					if($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					}
					else {
						$time_message = $interval->i . " minutes ago";
					}
				}
				else {
					if($interval->s < 30) {
						$time_message = "Just now";
					}
					else {
						$time_message = $interval->s . " seconds ago";
					}
				}

				$str .= "<div class='status_post'>

							<div class='posted_by' style='color:#ACACAC;'>
								<a href='profile.php?profile_username=$added_by'>
								<b> $first_name $last_name </b></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_message
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$delete_button

							</div>

							<div id='post_body'>
								$body
								<br>
							</div>
							<div id='post_loc_and_play_time'>
								$location
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								$play_time								
								<br>
								<span>Game: $game</span>
								&nbsp;&nbsp;&nbsp;&nbsp;
								
								<span> $gender </span>								
							</div>
							<br>
							<img src='$image_path' height='40%' width='40%'></img>
							<div class='newsfeedPostOptions'>	
								<button id='comment_anchor' class='btn btn-primary btn-xs' onClick='javascript:toggle$id();'>Comments($comments_check_num)</button>&nbsp;&nbsp;&nbsp;	
								<span style='margin-top:10px;'><iframe allowtransparency='true' src='like.php?post_id=$id' style='height: 47px; width: 130px;' frameBorder='0'  scrolling='no'></iframe>
								</span>
							</div>

						</div>

							<div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						
						<hr>";
			} 
			echo $str;
		}
	}
}
?>