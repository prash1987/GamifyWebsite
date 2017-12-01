	<?php  
	require 'config.php';
	include("header.php");
	include("classes/UserClass.php");

	if(isset($_SESSION['login_user'])) {
		$userLoggedIn = $_SESSION['login_user'];
		$user_obj = new UserClass($con, $userLoggedIn);
		$data_admin = "";
		$data_member = "";

		$sqlAdmin = mysqli_query($con, "SELECT group_id, group_name FROM groups WHERE admin = '$userLoggedIn';");

		while($row_admin = mysqli_fetch_array($sqlAdmin)) {
			$admin_group_name = $row_admin['group_name'];			
			$div_admin = "<div>" . $admin_group_name . "</div>";
			$data_admin = $data_admin . $div_admin . "<br>";
		}

		$sqlMember = mysqli_query($con, "SELECT group_id, group_name FROM groups WHERE members like '%" . $userLoggedIn . "%';");
		
		while($row_member = mysqli_fetch_array($sqlMember)) {
			$member_group_name = $row_member['group_name'];			
			$div_member = "<div>" . $member_group_name . "</div>";
			$data_member = $data_member . $div_member . "<br>";
		}
		
	}
	else
	{
		header("Location: login.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" and (isset($_POST['groupName']))){
	    $groupname= $_POST["groupName"];
	    $members= $_POST["members"];
	    $members= $members . $userLoggedIn;
	    $user_id = $userLoggedIn;

	    $sql = "INSERT INTO groups(group_name, admin, members) values('$groupname','$user_id','$members');";

		if ($con->query($sql) === TRUE) {
			header('Location: groups.php');			 
			//echo "<b><p>Profile updated successfully</p></b>"; 
		}
		else {
			echo "Something went wrong. Error: " . $sql . "<br>" . $con->error;
		}
	}
	?>

	<head>
		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		
   		<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
   		<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   		<script src = "js/search.js"></script>

   		<script type="text/javascript">
   			function getUsers(value, user){
			  $.post("handlers/ajax_grp_member_search.php", {query:value, userLoggedIn:user}, function (data){
			    $(".results").html(data);
			  });
			  document.getElementById("results").style.display = "block";
			}

			function selectUser(selectedUser){
				selectedUser += ",";
			    document.getElementById('members').value += selectedUser;			    
			    document.getElementById("results").style.display = "none";
			    document.getElementById("search_text_input").value = ".";			    
	            
			}
   		</script>
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
	</div>

	<div class="col-md-6 column col-md-offset-0-5">
		<?php
			echo "<h3>Groups created by you:</h3>";
			echo $data_admin;
			echo "<hr>";
			echo "<h3>Your Group Memberships:</h3>";
			echo $data_member;
			echo "<hr>";
		?>
	</div>

	<div class="col-md-3 column col-md-offset-0-5">
		<h3>Create Group</h3><hr>
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
			    <label  class="col-sm-2 control-label">Group Name</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" name="groupName" placeholder="Group Name" required>
			    </div>
			</div>
            <div class="form-group">
			    <label  class="col-sm-2 control-label">Members</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="members" id="members" placeholder="Members" readonly required>
				</div>
			</div>
			<br>

			<?php			
				{
					echo "Select the friend you would like to add to your group<br>";
					?>
					<input type="search" onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='search_text_input' onsearch="getUsers('','')">
					<?php
						echo "<div class='results' id='results'></div>";
				}
			?>
			<br>
	        <div class="action">
                <input type="submit" class="btn btn-primary signup" value="Create"/><br/>
            </div> 
        </form>
	</div>

</body>
</html>