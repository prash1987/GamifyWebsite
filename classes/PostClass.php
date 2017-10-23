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
		$insert_stmnt = "INSERT INTO posts(body, posted_by, time_stamp, location, play_time, image_path, likes,game,gender) VALUES('$body','$posted_by','$time_stamp', '$location', '$play_time', '$image_name',0,'$game', '$gender')";
		$query = mysqli_query($con, $insert_stmnt);
		$returned_id = mysqli_insert_id($con);
	}

	//Load posts
	public function loadPostsFriends($gender_pref,$game_pref)
	{
		/*$get_loc = strip_tags($pl);
		$get_loc = mysqli_real_escape_string($this->con, $pl);*/


		// $get_loc = getUserLocation();
		// echo $get_loc;
		// $con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		// $data_query1 = mysqli_query($con, "SELECT * FROM user");
		// $row = mysqli_fetch_array($data_query1);
		// $get_loc = $row['address'];

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

		$query = "SELECT * FROM posts WHERE location='$userLocation'";


		if (!empty($sql)) {
    		$query .= ' and ' . implode(' and ', $sql);
		}

		$query .= " ORDER BY time_stamp DESC";

		//echo $query;  //Just for testing whether its working correctly or not

		$str = ""; //String to return 
		$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$data_query = mysqli_query($con, $query);  
		

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
					$gender = "open for All";
				}
				elseif ($gender == 'M') {
					$gender = "open to Males only";
				}
				elseif ($gender == 'F') {
					$gender = "open to Females only";
				}

				//Prepare user_to string so it can be included even if not posted to a user
				/*if($row['user_to'] == "none") {
					$user_to = "";
				}
				else {
					$user_to_obj = new User($con, $row['user_to']);
					$user_to_name = $user_to_obj->getFirstAndLastName();
					$user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
				}*/

				//Check if user who posted, has their account closed
				/*$added_by_obj = new User($this->con, $added_by);
				if($added_by_obj->isClosed()) {
					continue;
				}*/

				

					/*if($num_iterations++ < $start)
						continue; 


					//Once 10 posts have been loaded, break
					if($count > $limit) {
						break;
					}
					else {
						$count++;
					}*/





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

					$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
							

								<div class='posted_by' style='color:#ACACAC;'>
									<a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_message
								</div>
								<div id='post_body'>
									$body
									<br>
								</div>
								<div id='post_loc_and_play_time'>
									$location
									&nbsp;&nbsp;&nbsp;&nbsp;$play_time
									&nbsp;&nbsp;&nbsp;&nbsp;
									<br>
									<span>Game of Event: $game</span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<br>
									<span> The event is $gender </span>
									<br>
								</div>
								<img src='$image_path' height='20%' width='20%'></img>
								<div class='newsfeedPostOptions'>
									<iframe allowtransparency='true' src='like.php?post_id=$id' style='height: 70px; width: 70px;' frameBorder='0'  scrolling='no'></iframe>
								</div>

							</div>

								<div class='post_comment' id='toggleComment$id' style='display:none;'>
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							
							<hr>";
				

			} //End while loop

			/*if($count > $limit) 
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else 
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>";*/
		}

		echo $str;
	}
}
?>