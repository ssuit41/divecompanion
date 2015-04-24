<?php
//create category.php
include '../header.php';
include '../connect.php';

$conn = connect();

if(!(isset($_SESSION['signed_in']) && $_SESSION['signed_in']))
{
	//user must be signed in
	//possible upgrade to must be admin
	echo 'Sorry, you have to be <a href="/divecompanion/users/signin.php">signed in</a> to create a topic.';
}
else
{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//need to create the category form
		echo '<form method="post" action="">
			Category: <input type="text" name="category_name" />
			Description: <input type="textarea" name="category_desc" /></textarea>
			<input type="submit" value="Create category" />
			</form>';
	}
	else
	{
		$query = "BEGIN WORK;";
		$result = $conn->query($query);
		
		if(!$result)
		{
			echo 'An error occured while creating your category. Please try again laster.';
		}
		else
		{
			$catname = mysqli_real_escape_string($conn, $_POST['category_name']);
			$catdesc = mysqli_real_escape_string($conn, $_POST['category_desc']);
			$sql = "INSERT INTO
						categories(cat_name, cat_description)
					VALUES('$catname', '$catdesc')";
			
			$result = $conn->query($sql);
			if(!$result)
			{
				echo 'An error occured while inserting your data. Please try again later.' . $conn->error;
				$sql = "ROLLBACK;";
				$result = $conn->query($sql);
			}
			else
			{
				$sql = "COMMIT;";
				$result = $conn->query($sql);
				
				echo 'You have successfully created <a href="category.php?id=' . mysqli_insert_id($conn) . '">your new category</a>';
			}
		}
	}
}

include '../footer.php';
?>