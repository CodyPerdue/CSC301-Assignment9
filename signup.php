<?php

function signup() {
	if (count($_POST) > 0) {	// when fields are filled
		// check if email is valid
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return 'The email you entered is not valid.';
		$_POST['email'] = strtolower($_POST['email']);
		
		// check if password is valid
		$_POST['password'] = trim($_POST['password']);
		
		if (strlen($_POST['password']) < 8) return 'The password must be at least 8 characters.';
		
		// if database does not exist, create it
		if (!file_exists('database.csv')) {
			$h = fopen('database.csv', 'w+');
			fwrite($h, '');
			fclose($h);
		}
		
		// check if email already exists
		$h = fopen('database.csv', 'r');
		while (!feof($h)) {
			$line = fgets($h);
			if (strstr($line, $_POST['email'])) return 'The email is already registered';
		}
		fclose($h);
		
		// encrypt password
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		// append data to database
		$h = fopen('database.csv', 'a+');
		fwrite($h, implode(';', [$_POST['email'], $_POST['password']])."\n");
		fclose($h);
		echo 'You successfully registered your account. Now you can <a href="signin.php">Sign in</a>';
	
	}
	return null;
}

if (count($_POST) > 0) {
	$error = signup();
	if (isset($error)) echo $error;
}
?>

<form action="signup.php" method="POST">
	E-mail: <input type="email" name="email" required /><br />
	Password: <input type="password" name="password" minlength="8" required /><br />
	<button type="submit">Create account</button>
</form>