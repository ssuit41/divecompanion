<?php
ob_start();
//signup.php
include '../header.php';
include '../connect.php';
 
$conn = connect();
//<<<<<<< HEAD
	echo '<div class="grid_12">
            <div class="box round first fullpage">';
if(isset($_GET['editid'])) echo '<h2>Edit Profile</h2>';
else   echo '<h2>Sign up</h2>';
//=======



  echo '<div class="block ">';
  if(isset($_GET['editid']))
  {
	 $editid =  $_GET['editid'] ;
	 $sql = "SELECT * from users where user_id=$editid";
	 $result = $conn->query($sql);
         
		if(!$result)
			echo 'The profile information  could not be displayed, please try again later.' . $conn->error;
		else
		{ 
		    while($row = $result->fetch_assoc())
           {              
            
              $fname = $row['fname'];
		      $lname = $row['lname'];
			  $user  = $row['user_name'];
			  $email = $row['user_email'];
              $phone = $row['phno']; 
			  $level = $row['user_level'];
          
           }
		
		}
  }
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{  ?>


<form method="post" action="">
<input type="hidden" name="id" value="<?php if(isset($_GET['editid'])){ echo $editid ;}?>" >
  <table class="form">
  <tr>
    <td><label> First Name</label></td>
    <td> <input class="medium" type="text" name="fname" value="<?php if(isset($_GET['editid'])){ echo  $fname;}?>"/></td>
  </tr>
   
   <tr>
    <td><label> Last Name</label></td>
    <td><input class="medium" type="text" name="lname" value="<?php if(isset($_GET['editid'])){ echo  $lname;}?>" /></td>
  </tr>
   
   <tr>
    <td><label> Username</label></td>
    <td> <input  class="medium" type="text" name="user_name" value="<?php if(isset($_GET['editid'])){ echo  $user;}?>" /></td>
  </tr>
   <?php if(!isset($_GET['editid'])){ ?>
   <tr>
    <td><label>Password</label></td>
    <td><input class="medium" type="password" name="user_pass"></td>
  </tr>
  
   <tr>
    <td><label>Password again </label></td>
    <td><input class="medium" type="password" name="user_pass_check"></td>
  </tr>
  <?php } ?>
  
   <tr>
    <td><label>E-mail</label></td>
    <td> <input class="medium" type="email" name="user_email" value="<?php if(isset($_GET['editid'])){ echo  $email;}?>"></td>
  </tr>
  
  <tr>
    <td><label>Phone Number</label></td>
    <td> <input class="medium" type="tel" name="phone" value="<?php if(isset($_GET['editid'])){ echo  $phone;}?>"></td>
  </tr>
  
     <?php if(isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1){ ?>
   <tr>
    <td><label>User Rank (0 for Member or 1 for Admin)</label></td>
    <td><input class="medium" type="integer" name="user_level" value="<?php if(isset($_GET['editid'])){ echo  $level;}?>"></td>
  </tr>
  <?php } ?>
  
  <tr>
    <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="<?php if(isset($_GET['editid'])){ echo "Update"; }else { echo "Sign Up!";}?>" /></td>
  </tr>
  

  </table>
</form>

<?php }
else
{
    /* so, the form has been posted, we'll process the data in three steps:
        1.  Check the data
        2.  Let the user refill the wrong fields (if necessary)
        3.  Save the data
    */
    $errors = array(); /* declare the array for later use */
	
	 	
		  if(isset($_POST['phone']))
          {
			  $phone =  $_POST['phone'];
			   
			  if(is_numeric(trim($phone)) == false){
			  $errors[] = "Please enter numeric value.";
			  
			  }
			
			if(strlen($phone)<10){
			   $errors[] = "Number should be ten digits.";
			 
			}
			  
		  }

    if(isset($_POST['user_name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
           if(!isset($_GET['editid'])){ 
              //disable in update
				if(isset($_POST['user_pass']))
				{
					if($_POST['user_pass'] != $_POST['user_pass_check'])
					{
						$errors[] = 'The two passwords did not match.';
					}
				}
				else
				{
					$errors[] = 'The password field cannot be empty.';
				}
		   }
		   
	 if(isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1){ 
			if(isset($_POST['user_level']))
				{
					if(!($_POST['user_level'] == 0 || $_POST['user_level'] == 1))
					{
						$errors[] = 'The users level must be equal to 0 or 1.';
					}
				}
				else
				{
					$errors[] = 'The user level field cannot be empty.';
				}
		   }
     
    if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
    {

        echo '<div class="error">Uh-oh.. a couple of fields are not filled in correctly..';
        echo 'The following must be fixed';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul></div>';
    }
    else
    {
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
		
		if(!empty($_POST['id'])){
			 $id = $_POST['id'];
			 $fname =  mysqli_real_escape_string($conn, $_POST['fname']);
			 $lname =  mysqli_real_escape_string($conn, $_POST['lname']);
			 $user  =  mysqli_real_escape_string($conn, $_POST['user_name']);
			 $email =  mysqli_real_escape_string($conn, $_POST['user_email']);
			 $phone =  mysqli_real_escape_string($conn, $_POST['phone']);
			 $level =  mysqli_real_escape_string($conn, $_POST['user_level']);
			 
			     $sql = "UPDATE
                    users set fname = '$fname',
					lname = '$lname',
					user_name = '$user',
					user_email = '$email',
					phno = '$phone',
					user_level = '$level'	where user_id=$id";
					$result = $conn->query($sql);
					header('Location:http://localhost/divecompanion/account.php?msg=update');
					exit(); 
               
			
		}else { 
		
         $sql = "INSERT INTO
                    users(fname,lname,user_name, user_pass, user_email, phno,user_date, user_level)
                VALUES( '" . mysqli_real_escape_string($conn, $_POST['fname']) . "',
					   '" . mysqli_real_escape_string($conn, $_POST['lname']) . "',
				       '" . mysqli_real_escape_string($conn, $_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysqli_real_escape_string($conn, $_POST['user_email']) . "',
					    '" . mysqli_real_escape_string($conn, $_POST['phone']) . "',
                        NOW(),
                        0)";
		}
        $result = $conn->query($sql);
        if(!$result)
        {
            //something went wrong, display the error
            echo 'Something went wrong while registering. Please try again later.';
        }
        else
        {
            echo 'Successfully registered. You can now <a href="/divecompanion/users/signin.php">sign in</a> and start posting! :-)';
        }
    }
}
echo '</div></div></div>'; 
include '../footer.php';
?>
