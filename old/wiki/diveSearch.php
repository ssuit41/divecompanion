<?php
include '../connect.php';
include '../header.php';

$conn = connect();

if($_SERVER['REQUEST_METHOD'] != 'POST')
	echo 'This file cannot be called directly.';
else
{
	$lat = $_POST['lat'];
	$long = $_POST['long'];
	$dist = $_POST['distance'];
	
	$sql = "SELECT  a.subSiteName,
					a.subSiteNum,
					d.diveSite,
					p.distance_unit
						* DEGREES(ACOS(COS(RADIANS(p.latpoint))
						* COS(RADIANS(z.latitude))
						* COS(RADIANS(p.longpoint) - RADIANS(z.longitude))
						+ SIN(RADIANS(p.latpoint))
						* SIN(RADIANS(z.latitude)))) AS distance
			FROM zipcode AS z
			JOIN (  
				SELECT '$lat' AS latpoint,
				'$long' AS longpoint,
                '$dist' AS radius, 
				69.0 AS distance_unit
				) AS p
			JOIN divesite AS d ON d.zipCode = z.zipCode
			JOIN sitelocation AS s ON d.addressNumber = s.addressNumber
			JOIN diveSiteDetails AS a ON d.diveSiteNum = a.diveSiteNum
			WHERE z.latitude
			BETWEEN p.latpoint  - (p.radius / p.distance_unit)
				AND p.latpoint  + (p.radius / p.distance_unit)
				AND z.longitude
			BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
				AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
			ORDER BY distance";
	$result = $conn->query($sql);
	if(!$result)
		echo 'There was an error in the query' . $conn->error;
	else
	{
		if($result->num_rows == 0)
			echo 'There are no results in range.';
		else
		{
			echo '<table border="1">
					<tr>
						<th>Site Name </th>
						<th>Distance </th>
					</tr>';
					
			while($row = $result->fetch_assoc())
			{
				echo '<tr>
						<td><a href="/divecompanion/wiki/diveSite.php?id=' . $row['subSiteNum'] . '">
						' . $row['diveSite'] . ' - ' . $row['subSiteName'] . '</td>
						<td>' . $row['distance'] . '</td>
					  </tr>';
			}
			echo '</table>';
		}
	}
}

include '../footer.php';
?>