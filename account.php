<?php
ob_start();
include 'header.php';
include 'connect.php';
$conn = connect();
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	
	 $userid = $_SESSION['user_id'];
   if(isset($_GET['msg'] )){
	      echo "Record Sucessfully Updated..";
	 }
   echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                  Profile Information</h2>
                <div class="block ">';
//Shows the 5 most recent posts in the format of Cat Name - Topic w/ link including the time
$sql = "SELECT * from users where user_id=$userid";

$result = $conn->query($sql);
         
if(!$result)
    echo 'The profile information  could not be displayed, please try again later.' . $conn->error;
else
{
    
		//prepare the table
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
            echo '<td>'. $row['phno'].  '</td>';  ?>
		   <td><a href="users/signup.php?editid=<?php echo $row['user_id']; ?>">Edit</a></td>
		
			      
           <?php echo '</tr>';
        }
		echo '</table>';
		echo '</div></div></div></div>';
    
   }
}
else{header('Location:users/signup.php');exit;	}
include('footer.php')
?>