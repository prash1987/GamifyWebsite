<?php
	class UserClass {
		private $user;
		private $con;

		public function __construct($con, $logged_user) {
			$this->con = $con;
			//$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
			
			$user_details_query = mysqli_query($this->con, "SELECT * FROM user WHERE user_id='$logged_user'");
			$this->user = mysqli_fetch_array($user_details_query);
		}

		public function getFirstAndLastName() {
			$username = $this->user['user_id'];
			
			//$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
			$query = mysqli_query($this->con,"SELECT first_name, last_name FROM user WHERE user_id='$username'");
			$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
			return $row['first_name'] . " " . $row['last_name'];
		}

		public function getUserName() {
			$username = $this->user['user_id'];
			return $username;
		}

		public function getUserLocation() {
			$address = $this->user['address'];
			return $address;
		}
		
		public function getUserContact() {
			$contact = $this->user['contact'];
			return $contact;
		}

		public function getUserBio() {
			$userbio = $this->user['userbio'];
			return $userbio;
		}

		public function getFirstName() {
			$username = $this->user['first_name'];
			return $username;
		}

		public function getLastName() {
			$address = $this->user['last_name'];
			return $address;
		}
		
		public function getDOB() {
			$contact = $this->user['dob'];
			return $contact;
		}

		public function getProPic() {
			$propic = $this->user['propic'];
			$folder="profile_pics/";
			return $folder . $propic;
		}

		public function getStatus(){
				$user_lastactive = $this->user['status_timestamp'];
				if (time() > $user_lastactive + 300)
					return False;
				else
					return True;
		}

		public function isFriend($username_to_check){
			$usernameComma = "," . $username_to_check . ",";

			if((strstr($this->user['friend_array'], $usernameComma) /*|| $username_to_check == $this->user['user_id']*/)) {
				return false;
			}
			else {
				return true;
			}
		}

		public function isFriend1($username_to_check) {
			// $username = $this->user['user_id'];
			$usernameComma = "," . $username_to_check . ",";

			if((strstr($this->user['my_blocks'], $usernameComma) /*|| $username_to_check == $this->user['user_id']*/)) {
				return true;
			}
			else {
				return false;
			}
		}


		public function unBlock($user_to_remove) {
			$logged_in_user = $this->user['user_id'];
			// echo $logged_in_user;
			// echo $user_to_remove;

			$query1 = mysqli_query($this->con, "SELECT * FROM user WHERE user_id='$user_to_remove'");
			$row1 = mysqli_fetch_array($query1);
			$friend_array_username = $row1['friend_array'];

			$new_friend_array = str_replace($user_to_remove . ",", "", $this->user['friend_array']);
			$remove_friend = mysqli_query($this->con, "UPDATE user SET friend_array='$new_friend_array' WHERE user_id='$logged_in_user'");

			$new_friend_array1 = str_replace($user_to_remove . ",", "", $this->user['my_blocks']);
			$remove_friend1 = mysqli_query($this->con, "UPDATE user SET my_blocks='$new_friend_array' WHERE user_id='$logged_in_user'");

			$new_friend_array = str_replace($this->user['user_id'] . ",", "", $friend_array_username);
			$remove_friend = mysqli_query($this->con, "UPDATE user SET friend_array='$new_friend_array' WHERE user_id='$user_to_remove'");
			echo "done unblocking";

		}

		public function Block($user_to_block) {
			$logged_in_user = $this->user['user_id'];
			// echo $user_to_block;

			$query = mysqli_query($this->con, "UPDATE user SET friend_array=CONCAT(friend_array, '$user_to_block,') WHERE user_id = '$logged_in_user'");

			$query1 = mysqli_query($this->con, "UPDATE user SET my_blocks=CONCAT(my_blocks, '$user_to_block,') WHERE user_id = '$logged_in_user'");

			$query2 = mysqli_query($this->con, "UPDATE user SET friend_array=CONCAT(friend_array, '$logged_in_user,') WHERE user_id = '$user_to_block'");

			echo "done blocking";
		}
	}
?>