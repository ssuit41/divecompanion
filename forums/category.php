<?php
//category.php Lists topics
include '../header.php';
include '../connect.php';

 
 //generate the db connection
$conn = connect();
 
//first select the category based on $_GET['cat_id']
$escape = $conn->real_escape_string($_GET['id']);
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories
        WHERE
            cat_id = '$escape'";
 
$result = $conn->query($sql);
 
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . $conn->error;
}
else
{
    if($result->num_rows == 0)
    {
        echo 'This category does not exist.';
		echo "$escape";
    }
    else
    {
        //display category data
        while($row = $result->fetch_assoc())
        {
            echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2>';
        }
     
        //do a query for the topics
		$escape = $conn->real_escape_string($_GET['id']);
        $sql = "SELECT 
                    topic_id,
                    topic_subject,
                    topic_date,
                    topic_cat
                FROM
                    topics
                WHERE
                    topic_cat = '$escape'";
         
        $result = $conn->query($sql);
         
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.' . $conn->error;
        }
        else
        {
            if($result->num_rows == 0)
            {
                echo 'There are no topics in this category yet. Would you like to <a href="create_topic.php?id=' . $escape . '"> create one</a>';
            }
            else
            {
                //prepare the table
                echo '<table border="1">
                      <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                      </tr>';
                     
                while($row = $result->fetch_assoc())
                {              
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
							echo date('m-d-Y g:i A', strtotime($row['topic_date']));
                        echo '</td>';
                    echo '</tr>';
                }
				echo '</table>';
				echo '<a href="create_topic.php?id=' . $escape . '">New Topic</a>';
            }
        }
    }
}
 
include '../footer.php';
?>