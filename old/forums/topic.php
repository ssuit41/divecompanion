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
				posts.post_topic = '$escape'
			ORDER BY
				posts.post_date ASC";
				
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
					echo date('m-d-Y g:i A', strtotime($row['post_date']));
				echo '</td>';
				echo '<td class="leftpart">';
					echo $row['post_content'];
					if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
						echo '<a href="reply.php?id=' . $row['post_topic'] . '"> Reply </a>';
				echo '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	}
}
include '../footer.php';
?>
					