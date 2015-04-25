<?php
//<<<<<<< HEAD
ob_start();
//=======
//signup.php
//>>>>>>> origin/master
include 'header.php';
include 'connect.php';
$conn = connect();


if(isset($_GET['id']))
	$userid = $_GET['id'];
else if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	
	$userid = $_SESSION['user_id'];
	if(isset($_GET['msg'] ))
	      echo "Record Sucessfully Updated..";
}
else
	header('Location: /divecompanion/users/signup.php');	 

   echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                  Profile Information</h2>
                <div class="block ">';

$sql = "SELECT * from users where user_id=$userid";

$result = $conn->query($sql);
         
if(!$result)
    echo 'The profile information  could not be displayed, please try again later.' . $conn->error;
else
{
	if($result->num_rows == 0)
		echo 'This user does not exist';
	else
	{
		echo '<table border="1">
				<tr>
                <th>First Name</th>
                <th>Last  Name </th>
				<th>Username</th>
                <th>Email </th>
				<th>Phone Number</th>
				<th>Edit</th>
                </tr>';
                     
        while($row = $result->fetch_assoc())
        {              

            echo '<tr class="tdcenter">';
            echo '<td>'. $row['fname'].  '</td>';
			echo '<td>'. $row['lname'].  '</td>';
			echo '<td>'. $row['user_name'].  '</td>';
			echo '<td>'. $row['user_email'].  '</td>';
            echo '<td>'. $row['phno'].  '</td>'; 
			if((isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1) || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']))
				echo '<td><a href="users/signup.php?editid=' . $row['user_id'] . '">Edit</a></td>';
			echo '</tr>';
        }
		echo '</table>';
		echo '</div></div></div></div>';
	}    
}


include('footer.php')
?>