<?php
//connect.php

function connect () {
	$server = 'localhost';
	$username   = 'root';
<<<<<<< HEAD
<<<<<<< HEAD
	$password   = '935zrmfSSA2FcP27';
=======
<<<<<<< HEAD
=======
//<<<<<<< HEAD
>>>>>>> d77e9e9634e16867c9a1ce1d38663a94c5a02c9e
	$password   = '';
//=======
	$password   = 'nW9tZZeN8L9e4FQ2';
<<<<<<< HEAD
>>>>>>> origin/master
>>>>>>> c38d97b6df29c639a8cea3308ec5b223619b0117
=======
//>>>>>>> origin/master
>>>>>>> d77e9e9634e16867c9a1ce1d38663a94c5a02c9e
	//$password   = ''; //for Claudius
	$database   = 'exforum';
	 
	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	return $conn;
}
?>