<?php

function signin() {
	if (count($_POST) > 0) {	// when fields are filled
		// check if email is valid
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return 'The email you entered is not valid.';
		$_POST['email'] = strtolower($_POST['email']);
		
		// check if password is valid
		$_POST['password'] = trim($_POST['password']);
		if (strlen($_POST['password']) < 8) return 'The password must be at least 8 characters.';
		
		// check if email is in database
		$h = fopen('database.csv', 'r');
		$emailExists = false;
		while (!feof($h)) {
			$line = fgets($h);
			if (strstr($line, $_POST['email'])) $emailExists = true;
		}
		fclose($h);
		if (!$emailExists) return 'This email has not yet been registered';
		
		// check if password matches password entered by user
		$h = fopen('database.csv', 'r');
		$password = null;
		while (!feof($h)) {
			$line = fgets($h);
			if (strstr($line, $_POST['email'])){
				$line = explode(";", $line);
				$password = $line[1];
			}
		}
		fclose($h);
		if (!password_verify($_POST['password'], $password)) return 'Password is incorrect.';
		
		// if match, show success screen
		echo 'You successfully logged in. You can return to the <a href="index.php">Home Page</a>';
	}
	return null;
}

if (count($_POST) > 0) {
	$error = signin();
	if (isset($error)) echo $error;
}
?>

<form action="signin.php" method="POST">
	E-mail: <input type="email" name="email" required /><br />
	Password: <input type="password" name="password" minlength="8" required /><br />
	<button type="submit">Sign In</button>
</form>