<?php
//connect.php

function connect () {
	$server = 'localhost';
	$username   = 'root';
<<<<<<< HEAD
	$password   = '935zrmfSSA2FcP27';
=======
<<<<<<< HEAD
	$password   = '';
=======
	$password   = 'nW9tZZeN8L9e4FQ2';
>>>>>>> origin/master
>>>>>>> c38d97b6df29c639a8cea3308ec5b223619b0117
	//$password   = ''; //for Claudius
	$database   = 'exforum';
	 
	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	return $conn;
}
?>