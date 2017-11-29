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
		
	}
?>