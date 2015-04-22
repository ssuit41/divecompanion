<?php
//home.php
include 'connect.php';
include 'header.php';
<<<<<<< HEAD
include 'connect.php';
//Insert code to display recent posts
//Possibly as an option allow the user to select the forum category from a drop down box
//generate the db connection
$conn = connect();
if(!(isset($_SESSION['signed_in']) && $_SESSION['signed_in']))
{
    //user must be signed in
    //possible upgrade to must be admin
    echo 'Sorry, you have to be <a href="/users/signin.php">signed in</a> to see posts and sites.';
}
else
{
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

        if(!$result)
        {
            echo 'There are no posts in this topic.';
        }
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
            /*
            <form method="post" action="reply.php?id=5">
                <textarea name="reply-content"></textarea>
                <input type="submit" value="Submit reply" />
            </form>
            */
        }
        echo '</table>';


=======

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
>>>>>>> origin/master
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
        echo "<th>Zipcode</th></tr>";
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
                echo $row['zipCode'];
                echo '</td>';
                echo '</tr>';
            }
        }
        /*
        <form method="post" action="reply.php?id=5">
            <textarea name="reply-content"></textarea>
            <input type="submit" value="Submit reply" />
        </form>
        */
    }
    echo '</table>';
}
include 'footer.php';
?>