<?php

include('functions.php');
$animals=jsonToArray('data.json');

if(!isset($_GET['id'])){
	echo 'Please enter the id of an animal or visit the <a href="index.php">Index Page</a>.';
	die();
}
if($_GET['id']<0 || $_GET['id']>count($animals)-1){
	echo 'Please enter the id of an animal or visit the <a href="index.php">Index Page</a>.';
	die();
}

require('header.php');

	
		showDetail($animals[$_GET['id']]['name'], $animals[$_GET['id']]['location'], $animals[$_GET['id']]['age'], $animals[$_GET['id']]['picture'], $animals[$_GET['id']]['bio']);

		echo '<br>';
		echo '<a href="edit.php?id='.$_GET['id'].'">Edit entry</a>';
		echo ' '.'<a href="delete.php?id='.$_GET['id'].'">Delete entry</a>';

require('footer.php');
?>