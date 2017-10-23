<?php
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {


    $str = '';
	foreach($_POST['userBIO2'] as $vals) {
	    $str .= $vals . ',';
	}	
	echo rtrim($str, ' '); //strips out last space
}
?>

<form action="self.php" method="POST">
<div class="form-group">
							    <label class="col-sm-2 control-label" for="userBIO2">Interests</label>
							    <div class="col-sm-10">
							    <select multiple id="userBIO2" name="userBIO2[]">
							      <option value="Cricket">Cricket</option>
							      <option value="Badminton">Badminton</option>
							      <option value="Tennis">Tennis</option>
							      <option value="Squash">Squash</option>
								  <option value="Running">Running</option>
								  <option value="Football">Football</option>
								  <option value="Basketball">Basketball</option>
								  <option value="Cycling">Cycling</option>
								  <option value="Gym">Gym</option>
								  <option value="Dance">Dance</option>
								  <option value="MartialArts">Martial Arts</option>
							    </select>
								</div>
	<input type = "submit" value = "send"/><br />
</form>