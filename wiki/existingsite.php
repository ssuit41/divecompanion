<?php

include_once '../connect.php';
include_once '../header.php';

$conn = connect();
echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>Update Dive Log</h2>
                <div class="block ">';

//select the dive site based on $_GET['id']
$subSiteNum = $conn->real_escape_string($_GET['id']);
$sql = "SELECT
			*
			FROM
				divesite
			LEFT JOIN
				divesitedetails
			ON
				divesitedetails.diveSiteNum = divesite.diveSiteNum
			WHERE
				divesitedetails.subSiteNum = '$subSiteNum'";

			
$result = $conn->query($sql);

//database error
if(!$result)
{
	echo 'The topic could not be displayed, please try again later.' . $conn->error;
}

else
{
	if($result->num_rows == 0)
	{
		echo 'This dive site does not exist.';
	}
	else
	{
		$row = $result->fetch_assoc();
		$diveSite = $row['diveSite'];
		$diveSiteNum = $row['diveSiteNum'];
		$addressnum = $row['addressNumber'];
		$zip = $row['zipCode'];
		$siteDetails = $row['siteDetails'];
		$siteInstruction = $row['siteInstruction'];
		$subSiteNum = $row['subSiteNum'];
		$subSiteName = $row['subSiteName'];

		$sql = "SELECT
			address
		FROM
			sitelocation
		WHERE
			sitelocation.zipCode = '$zip'
		AND
			sitelocation.addressNumber = '$addressnum'";
			
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$address = $row['address'];
		
		$sql = "SELECT
			*
		FROM
			zipcode
		WHERE
			zipcode.zipCode = '$zip'";
			
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$lat = $row['latitude'];
		$long = $row['longitude'];
		$state = $row['state'];
		$city = $row['city'];	
	}
}
?>

<form action="divelog.php?id=existing" method="post">
 This Data is Read Only and for verification!<br>
 Dive site: <input type="text" name="diveSite" value="<?php echo $diveSite; ?>" readonly><br>
 Sub dive site: <input type="text" name="subSiteName" value="<?php echo $subSiteName ?>" readonly><br>
 Address: <input type="text" name="address" value="<?php echo $address ?>" readonly><br>
 City: <input type="text" name="city" value="<?php echo $city?>" readonly><br>
 State: <input type="text" name="state" value="<?php echo $state ?>" readonly><br>
 Zip code: <input type="text" name="zip" value="<?php echo $zip ?>" readonly><br>
 Latitude: <input type="text" name="lat" value="<?php echo $lat ?>" readonly><br>
 Longitude: <input type="text" name="long" value="<?php echo $long ?>" readonly><br>
 Site instructions: <textarea name="siteInstruction" rows="3" columns="40" readonly>"<?php echo $siteInstruction ?>"</textarea><br>
 Site details: <textarea name="siteDetails" rows="3" columns="40" readonly>"<?php echo $siteDetails ?>"</textarea><br>
 <input type="hidden" name="subSiteNum" value="<?php echo $subSiteNum ?>">
 Use this dive site? <br>
 <input type="submit" name="confirm" value="Yes">
 </form>
 
<form action="../home.php" method="get">
  <input type="submit" name="decline" value="No">
  </form>

<?php

echo "</div></div></div>";

include_once '../footer.php';
?>