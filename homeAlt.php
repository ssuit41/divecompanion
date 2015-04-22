<?php
//homeAlt.php
include 'connect.php';
include 'header.php';

//I removed the part where being logged in was required to view posts and dive sites
//It is in the SRS that unsigned up users should be able to view but not modify them.

$conn = connect();

echo "<h2>Recent Post</h2>";
echo '<table border="1">';

//query for posts
$sql = "SELECT
			posts.post_id,
			posts.post_topic,
			posts.post_content,
			posts.post_date,
			posts.post_by,
			users.user_id,
			users.user_name
		FROM
			posts
		LEFT JOIN
			users
		ON
			posts.post_by = users.user_id ORDER BY  posts.post_date DESC";

$result = $conn->query($sql);

//If !$results is true it mean there was a connection error
//You have to check $conn->num_rows to see if there were none returned
if(!$result)
    echo 'There was an error in the query.' . $conn->error;
else
{
    echo "<tr><th>Post Author and Date</th>";
    echo "<th>Post name</th></tr>";
	while($row = $result->fetch_assoc())
	{
        echo '<tr>';
        echo '<td class="rightpart">';
        echo '<h3>' . $row['user_name'] . '</h3>';
        echo $row['post_date'];
        echo '</td>';
        echo '<td class="leftpart">';
        echo $row['post_content'];
        //echo '<h3><form action="forums/reply.php" method="post"><input type="hidden" name="post_content" value="' . $row['post_content'] . '"><input type="hidden" name="id" value="' . $row['post_id'] . '"><input type="submit" value="Reply"></form></h3>';
        echo '</td>';
        echo '</tr>';
    }
	echo '</table>';
}

//Display 10-15 sites with the most hits/week or month
//Possibly allow for an option to focus by geographical region
//there are a lot of little features here. I'm concerned whether we can get the website done on time
//Is there a core minimum feature set we can create?
  echo "<h2>Popular Sites</h2>";
    echo '<table border="1">';

    //query for posts
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
		LEFT JOIN zipCode as z ON z.zipCode = d.zipCode";

    $result = $conn->query($sql);

    if(!$result)
    {
        echo 'There are no posts in this topic.';
    }
    else
    {
        echo "<tr><th>Dive Site Name</th>";
        echo "<th>Site Details</th>";
        echo "<th>Location</th></tr>";
        while($row = $result->fetch_assoc())
        {
            if($row['diveSite']){
                echo '<tr>';
                echo '<td class="rightpart">';
                echo '<h3>' . $row['diveSite'] . '</h3>';
                echo '</td>';
                echo '<td class="leftpart">';
                echo $row['siteDetails'];
                //echo '<h3><form action="forums/reply.php" method="post"><input type="hidden" name="post_content" value="' . $row['post_content'] . '"><input type="hidden" name="id" value="' . $row['post_id'] . '"><input type="submit" value="Reply"></form></h3>';
                echo '</td>';
                echo '<td class="leftpart">';
                echo '' . $row['city'] . ', ' . $row['state'] . '';
                echo '</td>';
                echo '</tr>';
            }
        }
		 echo '</table>';
	}
	
include 'footer.php';
?>
	

        
    
   

        