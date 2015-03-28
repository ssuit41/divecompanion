<?php
//topic.php displays the posts within a topic
include 'connect.php';
include 'header.php';

//select the topic based on $_GET['id']
$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic does not exist.';
	}
	else
	{
		//Display subject
		echo '<table border="1">
			<tr>
				<th> ''. $0['topic_subject'] . '' </th>
			</tr>';
			
	//query for posts
	$sql = "SELECT
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
				posts.post_by = users.user_id
			WHERE
				posts.post_topic = " . mysql_real_escape_string($_GET['id']);
				
	$result = mysql_query($sql);
	
	if(!$result)
	{
		echo 'There are no posts in this topic.';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<tr>' . $row['users.user_name'] . ' </tr>';
					echo '<tr>' . $row['posts.post_date'] . ' </tr>';
				echo '</td>';
				echo '<td class="rightpart">';
					echo '<tr>' . $row['posts.post_content'] . ' </tr>';
					echo '</tr>';
		}
		/*
		<form method="post" action="reply.php?id=5">
			<textarea name="reply-content"></textarea>
			<input type="submit" value="Submit reply" />
		</form>
		*/
	}
	}
}
include 'footer.php';
?>
					