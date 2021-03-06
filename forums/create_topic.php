<?php
//create_topic.php
include '../connect.php';
include '../header.php';
 
//generate the db connection
$conn = connect();
 echo '<div class="grid_12">
            <div class="box round first fullpage"><h2>Create a topic</h2><div class="block ">'; 

if(!(isset($_SESSION['signed_in']) && $_SESSION['signed_in']))
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="/divecompanion/users/signin.php">signed in</a> to create a topic.';
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {  
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = $conn->query($sql);
         
        if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if($result->num_rows == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
				      <table class="form">
						  <tr>
						  <td><label>Subject</label></td>
						  <td> <input class="medium" type="text" name="topic_subject" /></td>
						  </tr>
				
                           <tr>
                            <td>
                                <label>
                                    Category</label>
                            </td> ';
                echo '<td><select   name="topic_cat">';
                    while($row = $result->fetch_assoc())
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select></td></tr>';
                     
                echo '<tr>
                              <td>
                                  <label> Message</label>
                             </td>
							 <td><textarea name="post_content" /></textarea></td>
				      </tr>
					  <tr>
                           <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="Create topic" /></td>
	                    </tr>
				  </table>
                 </form>';
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = $conn->query($query);
         
        if(!$result)
        {
            //Damn! the query failed, quit
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
     
            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll save the post into the posts table
            $sql = "INSERT INTO
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . $conn->real_escape_string($_POST['topic_subject']) . "',
                               NOW(),
                               " . $conn->real_escape_string($_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               )";
                      
            $result = $conn->query($sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . $conn->error;
                $sql = "ROLLBACK;";
                $result = $conn->query($sql);
            }
            else
            {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created topic for usage in the posts query
                $topicid = $conn->insert_id;
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . $conn->real_escape_string($_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = $conn->query($sql);
                 
                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . $conn->error;
                    $sql = "ROLLBACK;";
                    $result = $conn->query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = $conn->query($sql);
                     
                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    }
}
echo '</div></div></div>';
include '../footer.php';
?>