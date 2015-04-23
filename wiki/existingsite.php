<?php

include_once '../connect.php';
include_once '../header.php';

$conn = connect();
echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                Sign in</h2>
                <div class="block ">';

//select the dive site based on $_GET['id']
$escape = $conn->real_escape_string($_GET['id']);
$sql = "SELECT
			addressNumber,
			diveSiteNum,
			zipCode
		FROM
			divesite
		WHERE
			divesite.diveSiteNum = '$escape'";
			
$result = $conn->query($sql);

//database error
if(!$result)
{
	echo 'The topic could not be displayed, please try again later.' . $conn->error;
}

//***SEEMS TO START BREAKING SOMEWHERE IN HERE***
else
{
	if($result->num_rows == 0)
	{
		echo 'This dive site does not exist.';
	}
	else
	{
		$row = $result->fetch_assoc();
		$diveSiteNum = $row['diveSiteNum'];
		$addressnum = $row['addressNumber'];
		$zip = $row['zipCode'];

		$sql = "SELECT
			siteDetails,
			siteInstruction,
			subSiteName,
			subSiteNum
		FROM
			divesitedetails
		WHERE
			divesitedetails.diveSiteNum = $diveSiteNum";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$siteDetails = $row['siteDetails'];
		$siteInstructions = $row['siteInstruction'];
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
		
		echo 'Address Number: ';
		echo $addressnum;
		echo 'Address: ';
		echo $address;
		echo 'Zip Code: ';
		echo $zip;
	}
}
echo "</div></div></div>";
include_once '../footer.php';
?>