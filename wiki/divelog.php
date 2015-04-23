<?php

include_once '../connect.php';
include_once '../header.php';

//database connection
$conn = connect();
echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                 </h2>
                <div class="block ">';
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
<table class="form">
          <tr>
		  <td><label>Current</label></td>
		  <td> <input class="medium" type="text" name="current" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Date</label></td>
		  <td> <input class="medium" type="text" name="date" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Max Depth</label></td>
		  <td> <input class="medium" type="text" name="depth" /></td>
		  </tr>
		  
		   <tr>
		  <td><label>Temperature</label></td>
		  <td> <input class="medium" type="text" name="temperature" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Visibility</label></td>
		  <td> <input class="medium" type="text" name="visibility" /></td>
		  </tr>
		  <input type="hidden" id="username" name="username" value=$username>
          <input type="hidden" id="userid" name="userid" value=$userid>
     
	      <tr>
             <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="Enter" /></td>
	     </tr>
	      </table>
        </form>';


echo '</div></div></div>';
include_once '../footer.php';
?>