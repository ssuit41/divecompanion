<?php

include_once '../connect.php';
include_once '../header.php';

//database connection
$conn = connect();

//get form information for variables
$zip = $_GET["zip"];
$city = $_GET["city"];
$state = $_GET["state"];
$lat = $_GET["lat"];
$long = $_GET["long"];
$divesite = $_GET["divesite"];
$addressnum = $_GET["addressnum"];
$address = $_GET["address"];
$instructions = $_GET["instructions"];
$details = $_GET["details"];
$username = $_SESSION["user_name"];

//insert information into zipcode table
$sql = "INSERT INTO zipcode( zipcode, city, state, latitude, longitude ) VALUES ('$zip', '$city', '$state', '$lat', '$long')";
$conn->query($sql);

//insert information into divesite table
$sql = "INSERT INTO divesite( diveSiteNum, diveSite, addressNumber, zipCode ) VALUES ('0', '$divesite', '$addressnum', '$zip' )";
$conn->query($sql);

//insert information into site location table
//***NOTICED THAT THE USE OF AN APOSTROPHE IN AN ADDRESS NAME MAY BREAK ADDRESS INPUT***
$sql = "INSERT INTO sitelocation( zipCode, addressNumber, address ) VALUES ( '$zip', '$addressnum', '$address' )";
$conn->query($sql);

//insert information into divesitedetails table
//***NOTE*** UNSURE OF CERTAIN ASPECTS OF DIVE SITE SCHEMA HENCE USE OF ZEROS FOR FOR DATA INPUT
$sql = "INSERT INTO divesitedetails( diveSiteNum, subSiteNum, subSiteName, siteInstruction, siteDetails ) VALUES ( '0', '0', '0', '$instructions', '$details' )";
$conn->query($sql);

//query to obtain user_id
//***NOT WORKING*** RETURNS ZERO? ALL DIVE LOGS ARE CREATED UNDER USER_ID 0
$sql = "SELECT user_id FROM users WHERE user_name = '$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userid = $row['user_id'];

//prompt user for input of dive log information
//***NOTE*** PASSING OF USER_NAME AND USER_ID AS HIDDEN OBJECTS
echo '<form action="divelogsuccess.php" method="get">
<p align="left">
Current:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="current">
<br>
Date:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="date">
<br>
Max Depth:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="depth">
<br>
Temperature:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="temperature">
<br>
Visibility:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="visibility">
<br>
<input type="hidden" id="username" name="username" value=$username>
<input type="hidden" id="userid" name="userid" value=$userid>
<br>
<input type="submit" value="Enter">
</p>
</form>';

include_once '../footer.php';
?>