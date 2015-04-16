<?php
//topic.php displays the posts within a topic
include '../connect.php';
include '../header.php';

//generate the db connection
$conn = connect();

//select the topic based on $_GET['id']
$escape = $conn->real_escape_string($_GET['id']);
$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = '$escape'";
			
$result = $conn->query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.' . $conn->error;
}
else
{
	if($result->num_rows == 0)
	{
		echo 'This topic does not exist.';
	}
	else
	{
		//Display subject
		$row = $result->fetch_assoc();
		echo '<table border="1">
			<tr>
				<th colspan="2"> ' . $row['topic_subject'] . ' </th>
			</tr>';
			
	//query for posts
	$escape = $conn->real_escape_string($_GET['id']);
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
				posts.post_by = users.user_id
			WHERE
				posts.post_topic = '$escape'";
				
	$result = $conn->query($sql);
	
	if(!$result)
	{
		echo 'There are no posts in this topic.';
	}
	else
	{
		while($row = $result->fetch_assoc())
		{
			echo '<tr>';
				echo '<td class="rightpart">';
					echo '<h3>' . $row['user_name'] . '</h3>';
					echo '<h3>' . $row['post_date'] . '</h3>';
				echo '</td>';
				echo '<td class="leftpart">';
					echo '<h3>' . $row['post_content'] . ' </h3>';
					echo '<h3><a href="reply.php?id=' . $row['post_id'] . '"> Reply </a></h3>';
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
	}
}
include '../footer.php';
?>
					