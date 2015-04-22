<?php
//home.php
include 'connect.php';
include 'header.php';

$conn = connect();
echo '<h3>Recent Posts</h3>';
//Shows the 5 most recent posts in the format of Cat Name - Topic w/ link including the time
$sql = "SELECT 
                    t.topic_id,
                    t.topic_subject,
                    t.topic_date,
                    t.topic_cat,
					c.cat_name
                FROM
                    topics t
				LEFT JOIN
					categories c
				ON 
					c.cat_id = t.topic_cat
				ORDER BY
					topic_date DESC
				LIMIT 5";

$result = $conn->query($sql);
         
if(!$result)
    echo 'The topics could not be displayed, please try again later.' . $conn->error;
else
{
    if($result->num_rows == 0)
		echo 'There are no topics available.';
    else
    {
		//prepare the table
        echo '<table border="1">
				<tr>
                <th>Topic</th>
                <th>Last Post Time</th>
                </tr>';
                     
        while($row = $result->fetch_assoc())
        {              
            echo '<tr>';
            echo '<td class="leftpart">';
                echo '<h3>' . $row['cat_name'] . ' - <a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
            echo '</td>';
            echo '<td class="rightpart">';
				echo date('m-d-Y g:i A', strtotime($row['topic_date']));
            echo '</td>';
            echo '</tr>';
        }
		echo '</table>';
    }
}

echo '<h3>Random Sites</h3>';
//Displays 5 random dive sites from the database
$sql = "SELECT a.subSiteName,
			   a.subSiteNum,
			   d.diveSite,
			   z.city,
			   z.state
		FROM zipcode AS z
		JOIN divesite AS d ON d.zipCode = z.zipCode
		JOIN sitelocation AS s ON d.addressNUmber = s.addressNumber
		JOIN diveSiteDetails AS a on d.diveSiteNum = a.diveSiteNum
		ORDER BY RAND()
		LIMIT 5";
$result = $conn->query($sql);
if(!$result)
	echo 'There was an error in the query' . $conn->error;
else
{
	echo '<table border="1">
					<tr>
						<th>Site Name </th>
						<th>Location </th>
					</tr>';
					
			while($row = $result->fetch_assoc())
			{
				echo '<tr>
						<td><a href="/divecompanion/wiki/diveSite.php?id=' . $row['subSiteNum'] . '">
						' . $row['diveSite'] . ' - ' . $row['subSiteName'] . '</td>
						<td>' . $row['city'] . ', ' . $row['state'] . '</td>
					  </tr>';
			}
			echo '</table>';
}
//>>>>>>> origin/master

include 'footer.php';
?>