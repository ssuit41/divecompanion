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
$zip = $_POST["zip"];
$city = $_POST["city"];
$state = $_POST["state"];
$lat = $_POST["lat"];
$long = $_POST["long"];
$diveSite = $_POST["diveSite"];
$subSiteName = $_POST["subSiteName"];
$address = $_POST["address"];
$siteInstruction = $_POST["siteInstruction"];
$siteDetails = $_POST["siteDetails"];


//insert information into zipcode table
$sql = "INSERT INTO zipcode( zipcode, city, state, latitude, longitude ) VALUES ('$zip', '$city', '$state', '$lat', '$long')";
$conn->query($sql);

//insert information into site location table
//***NOTICED THAT THE USE OF AN APOSTROPHE IN AN ADDRESS NAME MAY BREAK ADDRESS INPUT***
$sql = "INSERT INTO sitelocation( zipCode, address ) VALUES ( '$zip', '$address' )";
$conn->query($sql);
$addressNum = mysqli_insert_id( $conn );

//insert information into divesite table
$sql = "INSERT INTO divesite( diveSite, addressNumber, zipCode ) VALUES ( '$diveSite', '$addressNum', '$zip' )";
$conn->query($sql);
$diveSiteNum = mysqli_insert_id( $conn );

//insert information into divesitedetails table
//***NOTE*** UNSURE OF CERTAIN ASPECTS OF DIVE SITE SCHEMA HENCE USE OF ZEROS FOR FOR DATA INPUT
$sql = "INSERT INTO divesitedetails( diveSiteNum, subSiteName, siteInstruction, siteDetails ) VALUES ( '$diveSiteNum', '$subSiteName', '$siteInstruction', '$siteDetails' )";
$conn->query($sql);
$subSiteNum = mysqli_insert_id( $conn );
?>

<<<<<<< HEAD
<form action="divelogsuccess.php" method="post">
<p align="left">
Current:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="current">
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
<input type="hidden" name="subSiteNum" value="<?php echo $subSiteNum; ?>">
<input type="submit" value="Enter">
</p>
</form>;
<?php
=======
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

>>>>>>> c38d97b6df29c639a8cea3308ec5b223619b0117

echo '</div></div></div>';
include_once '../footer.php';
?>