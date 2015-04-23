<?php
//topic.php displays the posts within a topic
include '../connect.php';
include '../header.php';

//generate the db connection
$conn = connect();
 echo '<div class="grid_12">
            <div class="box round first fullpage">';
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
		echo '
				<h2> ' . $row['topic_subject'] . ' </h2>';
			
		echo '<div class="block ">';	
		
		echo '<table class="data display datatable" id="example">
					<thead>
						<tr>
							 <th>Topic</th>
							  <th>Last Post Time</th>
						</tr>
					</thead>
					<tbody>';
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
				echo '<td>';
					echo '' . $row['user_name'] . '</br>';
					echo date('m-d-Y g:i A', strtotime($row['post_date']));
				echo '</td>';
				echo '<td>';
					echo $row['post_content'];
					if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
						echo '<a href="reply.php?id=' . $row['post_topic'] . '&content=' . $row['post_content'] . '"></br> Reply </a>';
				echo '</td>';
			echo '</tr>';
		}
	}
	echo '</tbody></table>';
	}
}
echo '</div></div></div> <div class="clear">
        </div>';
include '../footer.php';
?>
					