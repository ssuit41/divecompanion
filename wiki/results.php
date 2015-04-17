<?php

include '../connect.php';
include '../header.php';
include 'addData.php';

$connect = connect();
$zip = $_PROMPT['zip'];

if(!(isset($_SESSION['signed_in']) && $_SESSION['signed_in']))
{
	//user must be signed in
	//possible upgrade to must be admin
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}

else
{
		$sql = "SELECT
            diveSite,
            zipCode,
        WHERE
			zipCode EQUALS $zip
        FROM
            categories";
 
		$result = mysql_query($sql);
 
		if(!$result)
		{
		echo 'The categories could not be displayed, please try again later.' . $conn->error;
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
                            echo $_PROMPT['zip'];
						echo '</td>';
					echo '</tr>';
				}
			}
		}
	}
