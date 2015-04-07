<?php
//connect.php

function connect () {
	$server = 'localhost';
	$username   = 'root';
	$password   = 'nW9tZZeN8L9e4FQ2';
	$database   = 'exforum';
 
	$conn = new mysqli($server, $username, $password);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	return $conn;
}
?>