<?php

include_once '../connect.php';
include_once '../header.php';

$conn = connect();
$zip = $_GET["zip"];
$city = $_GET["city"];

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

echo $zip;
echo "\n";
echo $city;
echo "\n";



$sql = "SELECT
			diveSite,
			zipCode
		FROM
			divesite
		WHERE
			zipCode = $zip";

$result = $conn->query($sql);

if(!$result)
{
	echo 'The dive sites could not be displayed, please try again later.' . $conn->error;
}
else
{
	if($result->num_rows == 0)
	{
		echo 'A NEW SITE!.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			<tr>
				<th>Dive Site</th>
				<th>Zip Code</th>
			</tr>';
	 
		while($row = $result->fetch_assoc())
		{              
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<a href="category.php?id=' . $row['diveSite'] . '">' . $row['diveSite'] . '</a>' . $row['cat_description'];
				echo '</td>';
				echo '<td class="rightpart">';
					echo $zip;
				echo '</td>';
			echo '</tr>';
		}
	}
}
