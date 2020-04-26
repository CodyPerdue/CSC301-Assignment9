<?php

include('functions.php');
$animals=jsonToArray('data.json');

require('header.php');
?>
	<p><a href="signup.php" style="padding-right: 100px">Sign Up</a> <a href="signin.php">Sign In</a></p>
	<hr>
	
    <h1>Adopt a Pet</h1>
	<?php
	for($i=0;$i<count($animals);$i++){
		showItem($i, $animals[$i]['name'], $animals[$i]['picture']);
		echo '<hr>';
	}
	?>
	<a href="create.php">Add a new entry</a>

<?= require('footer.php'); ?>