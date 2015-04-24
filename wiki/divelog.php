<?php

include_once '../connect.php';
include_once '../header.php';

//database connection
//Put error check for non posted page
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


if(!(isset($_GET['id']) && $_GET['id'] == 'existing'))
{
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
}
else
	if(isset($_POST["subSiteNum"]))
		$subSiteNum = $_POST["subSiteNum"];

//prompt user for input of dive log information
//***NOTE*** PASSING OF USER_NAME AND USER_ID AS HIDDEN OBJECTS
echo '<form action="divelogsuccess.php" method="post">
<table class="form">
          <tr>
		  <td><label>Current</label></td>
		  <td> <input class="medium" type="text" name="current" /></td>
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

             <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="Enter" /></td>
	     </tr>
	      </table>
		  <input type="hidden" name="subSiteNum" value=" ' . $subSiteNum . '">
        </form>';


echo '</div></div></div>';
include_once '../footer.php';
?>