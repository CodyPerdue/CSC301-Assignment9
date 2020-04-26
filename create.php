<?php
	require_once('DB.php');
 
	// if data fields are filled, write to database
	if (isset($_POST["name"]) && isset($_POST["location"]) && isset($_POST["age"]) && isset($_POST["bio"]) && isset($_POST["picture"])) {
		$pet = new Pet();
		$pet->name = $_POST["name"];
		$pet->location = $_POST["location"];
		$pet->age = $_POST["age"];
		$pet->bio = $_POST["bio"];
		$pet->picture = $_POST["picture"];
		$pet->create();
	}
?>


<html>
	<form action="create.php" method="POST">
		Name: <input type="text" name="name"><br>
		Location: <input type="text" name="location"><br>
		Age: <input type="text" name="age"><br>
		Bio: <textarea name="bio" rows="5" cols="40"></textarea><br>
		Picture: <input type="file" name="picture"><br>
		<button type="submit" value="Submit">Submit</button>
	</form>
</html>