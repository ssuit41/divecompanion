<?php
//forum.php lists categories
include '../connect.php';
include '../header.php';
 
//generate the db connection
$conn = connect();
 
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories";
 
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
                            echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                echo '</td>';
            echo '</tr>';
        }
    }
}
 
include '../footer.php';
?>