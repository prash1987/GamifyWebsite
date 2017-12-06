	<?php  
	
	include("header.php");

	if(isset($_SESSION['login_user'])) {
			if(isset($_GET["group_id"])){
				$userLoggedIn = $_SESSION['login_user'];
				$user_obj = new UserClass($con, $userLoggedIn);
				$group_id=$_GET["group_id"];
				
				$sqlAdmin = mysqli_query($con, "SELECT * FROM groups WHERE group_id = '$group_id';");

				while($row_admin = mysqli_fetch_array($sqlAdmin)) {
					$group_admin = $row_admin['admin'];
					$group_name = $row_admin['group_name'];			
					$group_members = $row_admin['members'];
					$new_members = $group_members . ",";
				}

				if($group_admin !== $userLoggedIn)
				{
					header("Location: homepage.php");
				}
			}
			else{
				header("Location: groups.php");
			}
	}
	else
	{
		header("Location: login.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isset($_POST['btnRemove'])){	    
		    $user_id = $userLoggedIn;	    
		    $member_to_delete = '';

			foreach($_POST['current_members'] as $vals) {
				if($vals!==$user_id){
			    	$member_to_delete = $vals . ',';
			    	$new_members = str_replace($member_to_delete, "", $new_members);
			    }
			}

			if(substr($new_members, -1) === "," ){
				$new_members = substr($new_members, 0, strlen($new_members)-1);
			}

		 	$sql = "UPDATE groups SET members='$new_members' WHERE group_id='$group_id';";

			if ($con->query($sql) === TRUE) {
			 	header('Location: manage_groups.php');
			}
			else {
			 	echo "Something went wrong. Error: " . $sql . "<br>" . $con->error;
			}
		}

		///Below is the code that will be executed if the user is trying to add more members
		if (isset($_POST['btnUpdate'])){
			if(isset($_POST['members'])){
				$members= $_POST["members"];
				$members = substr($members, 0, strlen($members)-1);

				$sql = "UPDATE groups SET members= CONCAT('" . $group_members . "', " . "','"  . " '" . $members . "') WHERE group_id='$group_id';";

				if ($con->query($sql) === TRUE) {
					header('Location: manage_groups.php'); 
				}
				else {
					echo "Something went wrong. Error: " . $sql . "<br>" . $con->error;
				}
			}
			else{
				echo "No members to add.";
			}
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

				var test = "";
				selectedUser += ",";
			    document.getElementById('members').value += selectedUser;			    
			    document.getElementById("results").style.display = "none";
			    document.getElementById('search_text_input').value = test;			    
	            
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
		<h3>Manage Group - <?php echo $group_name; ?> </h3><hr>

		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group">
				<label  class="col-sm-2 control-label">Current Members:</label>
				<div class="col-sm-10">
				    <select multiple class="form-control" id="current_members" name="current_members[]">
			    	<?php				    		
			    		$members_arr = explode(",", $group_members);
			    		for ($i = 0; $i < count($members_arr); $i++) {
			    			$member_obj = new UserClass($con, $members_arr[$i]);
		    				$member_name = $member_obj->getFirstAndLastName();
		    				echo "<option value='" . $members_arr[$i] . "'>" . $member_name . "</option>";
			    		}
			    	?>
				    </select>
				</div>
			</div>

			<div class="form-group">
				<label  class="col-sm-2 control-label">Select the members and click Remove</label>
				<div class="col-sm-10">
                	<input type="submit" name="btnRemove" class="btn btn-primary signup" value="Remove"/><br/>
                </div>
            </div>

            <hr>

			<div class="form-group">
			    <label  class="col-sm-2 control-label">Members to be added</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" name="members" id="members" required readonly>
			    </div>
			</div>
	        <br>
	        
	        Select the friend you would like to add to your group<br>
			<input type="search" onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='search_text_input' onsearch="getUsers('','')">
			<div class='results' id='results'></div>			
			<br>
			<div class="col-sm-10">
	        <div class="action">
                <input type="submit" name="btnUpdate" class="btn btn-primary signup" value="Update"/><br/>
            </div></div>
        </form>
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
		</script>

</body>
</html>