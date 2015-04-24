<?php
//forum.php lists categories
include '../connect.php';
include '../header.php';
 
//generate the db connection
$conn = connect();
 /*
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories";
	*/		
$sql = "SELECT 
			c.cat_id,
			c.cat_name,
			c.cat_description,
			t.topic_date,
			t.topic_subject,
			t.topic_id
		FROM categories AS c
		LEFT JOIN
			topics t
		ON c.cat_id = t.topic_cat
		WHERE t.topic_date IN (SELECT MAX(topic_date)
								FROM topics
								WHERE topic_cat = c.cat_id)";
 
$result = $conn->query($sql);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.' . $conn->error;
}
else
{
    if($result->num_rows == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>';
             
        while($row = $result->fetch_assoc())
        {              
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                echo '<a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a> at <br>'; 
				echo date('m-d-Y g:i A', strtotime($row['topic_date']));
                echo '</td>';
            echo '</tr>';
        }
    }
}
 
include '../footer.php';
?>