<?php
	require_once('json.php');

	// if data fields are filled, modify data.json, else read data into boxes
	if (isset($_POST["name"]) && isset($_POST["location"]) && isset($_POST["age"]) && isset($_POST["bio"]) && isset($_POST["picture"]))
		modifyJSON('data.json', $_POST, $_GET['id']);
	else
		$request=readJSON('data.json',$_GET['id']);
?>


<html>
	<form action="edit.php" method="POST">
		Name: <input type="text" name="name" value="<?= $request['name'] ?>"><br>
		Location: <input type="text" name="location" value="<?= $request['location'] ?>"><br>
		Age: <input type="text" name="age" value="<?= $request['age'] ?>"><br>
		Bio: <textarea name="bio" rows="5" cols="40"><?= $request['bio'] ?></textarea><br>
		Picture: <input type="file" name="picture" value="<?= $request['picture'] ?>"><br>
		<button type="submit" value="Submit">Submit</button>
	</form>
</html>