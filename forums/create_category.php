<?php
//create category.php
include '../header.php';
include '../connect.php';

$conn = connect();
echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                  Create Categoery</h2>
                <div class="block ">';
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
		echo '<form method="post" action=""><form method="post" action="">
		<table class="form">
          <tr>
		  <td><label>Category</label></td>
		  <td> <input class="medium" type="text" name="category_name" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Description</label></td>
		  <td><textarea  name="category_desc" /></textarea>
		  </td>
		  </tr>
		  <tr>
		  <td></td>
             <td class="sbtn"> <input class="btn btn-blue" type="submit" value="Create category" /></td>
	     </tr>
	      </table>
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
echo '</div></div></div>';
include '../footer.php';
?>