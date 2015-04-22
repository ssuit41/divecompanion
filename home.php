<?php
//home.php
include 'header.php';
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