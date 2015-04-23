<?php

include_once '../connect.php';
include_once '../header.php';

//database connection
$conn = connect();

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

include_once '../footer.php';
?>