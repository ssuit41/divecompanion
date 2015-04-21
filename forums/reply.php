<?php
//create_cat.php
include '../connect.php';
include '../header.php';
 
//generate the db connection
$conn = connect();
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo 'Reply To:';
	echo $_GET['content'];
	echo '<br>';		
	echo '<form method="post" action="">
		<textarea name="reply-content"></textarea>
		<input type="submit" value="Submit reply" />
		</form>';
}
else
{
    //check for sign in status
    if(!$_SESSION['signed_in'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
        //a real user posted a real reply
        $sql = "INSERT INTO
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by)
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . $conn->real_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = $conn->query($sql);
		
		$sql = 'UPDATE topics
				SET topic_date=NOW()
				WHERE topic_id=' . $conn->real_escape_string($_GET['id']) . '';
				
		$result2 = $conn->query($sql);
                         
        if(!$result && !$result2)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
			header('Location: /divecompanion/forums/topic.php?id=' . $_GET['id'] . '');
        }
    }
}
 
include '../footer.php';
?>