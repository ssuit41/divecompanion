<?php

include_once '../connect.php';
include_once '../header.php';

//database connection
$conn = connect();

//get form information and store in variables
$current = $_GET["current"];
$date = $_GET["date"];
$depth = $_GET["depth"];
$temperature = $_GET["temperature"];
$visibility = $_GET["visibility"];
$username = $_GET["username"];
$userid = $_GET["userid"];

//insert form information into divelog table
//***NOTE*** AGAIN USING ZEROS TO MAKE UP FOR UNCERTAINTY WITH DATABASE SCHEMA/WORKINGS
$sql = "INSERT INTO divelog( user_id, subSiteNum, lognumber, date, temperature, maxDepth, current, visibility ) 
	VALUES ( '$userid', '0', '0', '$date', '$temperature', '$depth', '$current', '$visibility' )";
$conn->query($sql);

//inform user of successful dive log creation
echo '<p align=center>Dive Log entry successfully created!</p>';

include_once '../footer.php';
?>