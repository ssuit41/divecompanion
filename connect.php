<?php
//connect.php

function connect () {
	$server = 'localhost';
	$username   = 'root';
	$password   = '935zrmfSSA2FcP27';
	//$password   = ''; //for Claudius
	$database   = 'exforum';
	 
	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	return $conn;
}
?>