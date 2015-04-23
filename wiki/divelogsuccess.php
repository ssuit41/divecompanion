<?php

include_once '../connect.php';
include_once '../header.php';

//database connection
$conn = connect();

//get form information and store in variables
$current = $_POST["current"];
$depth = $_POST["depth"];
$temperature = $_POST["temperature"];
$visibility = $_POST["visibility"];
$username = $_SESSION["user_name"];
$subSiteNum = $_POST["subSiteNum"];

$sql = "SELECT * FROM users WHERE user_name = '$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userid = $row['user_id'];

//insert form information into divelog table
$sql = "INSERT INTO divelog( user_id, subSiteNum, date, temperature, maxDepth, current, visibility ) 
	VALUES ( '$userid', '$subSiteNum', NOW(), '$temperature', '$depth', '$current', '$visibility' )";
$conn->query($sql);

//inform user of successful dive log creation
echo '<p align=center>Dive Log entry successfully created!</p>';

include_once '../footer.php';
?>