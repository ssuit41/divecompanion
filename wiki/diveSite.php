<?php
include '../connect.php';
include '../header.php';

$conn = connect();
//diveSite.php is loaded with diveSite.php?id=? where ? represents the subsitenum.
$escape = $conn->real_escape_string($_GET['id']);

$sql = "UPDATE divelog set logNumber = logNumber+1 WHERE subSiteNum = $escape";
$conn->query($sql);
$sql = "SELECT
			s.subSiteName,
			s.siteInstruction,
			s.siteDetails,
			d.diveSite,
			l.address,
			z.city,
			z.state,
			z.zipCode
		FROM divesitedetails AS s
		LEFT JOIN divesite AS d ON s.diveSiteNum = d.diveSiteNum
		LEFT JOIN sitelocation AS l ON l.addressNumber = d.addressNumber
		LEFT JOIN zipCode as z ON z.zipCode = d.zipCode
		WHERE subSiteNum = '$escape'";
			
$result = $conn->query($sql);

if(!$result)
	echo 'The dive site could not be displayed.' . $conn->error;
else
{
	if($result->num_rows == 0)
		echo 'This subsite does not exist.';
	else
	{
		$subSite = $result->fetch_assoc();
		//Fetch dive log
		$sql = "SELECT
					l.date,
					l.temperature,
					l.maxDepth,
					l.current,
					l.visibility
				FROM
					divesitedetails d
				LEFT JOIN divelog l ON d.subSiteNum = l.subSiteNum
				WHERE d.subSiteNum = '$escape'
				ORDER BY l.date";
		$result = $conn->query($sql);
		if(!$result)
			echo 'There was an error in querying for the dive log' . $conn->error;
		
		echo '<h1>' . $subSite['diveSite'] . ' - ' . $subSite['subSiteName'] . '</h1>';
		echo '<h3>' . $subSite['address'] . ' ' . $subSite['city'] . ' , ' . $subSite['state'] . ' ' . $subSite['zipCode'] . '</h3>';
		echo '<br><br>';
		if($result->num_rows == 0)
			echo 'No logs exist for this site';
		else
		{
			$diveLog = $result->fetch_assoc();
			echo '<table border="1">
					<tr>
						<th>Temperature</th>
						<th>Max Depth</th>
						<th>Current</th>
						<th>Visibility</th>
						<th>Date</th>
					</tr>';
			echo '<tr>
					<td>' . $diveLog['temperature'] . '</td>
					<td>' . $diveLog['maxDepth'] . '</td>
					<td>' . $diveLog['current'] . '</td>
					<td>' . $diveLog['visibility'] . '</td>
					<td>';
					echo date('m-d-Y', strtotime($diveLog['date']));
					echo '</td>
				</tr>
				</table>';
		}			
		echo '<h1>Site Instructions</h1>';
		if(!isset($subSite['siteInstructions']))
			echo 'No site instructions exist. Create new (insert link here)';
		else
			echo $subSite['siteInstructions'];
		echo '<br><br>';
		echo '<h1>Site Details</h1>';
		if(!isset($subSite['siteDetails']))
			echo 'No site details exist. Create new (insert link here)';
		else
			echo $subSite['siteDetails'];
	}
}

include '../footer.php';

?>