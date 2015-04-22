<?php
//signup.php
include '../header.php';
include '../connect.php';
 
$conn = connect();

if(isset($_GET['editid'])) echo '<h3>Edit Profile</h3>';
else   echo '<h3>Sign up</h3>';

 
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
          
           }
		
		}
  }
 
 
  /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
if($_SERVER['REQUEST_METHOD'] != 'POST')
{     ?>
   
    <form method="post" action="">
         <input type="hidden" name="id" value="<?php if(isset($_GET['editid'])){ echo $editid ;}?>" >
	    First Name : <input type="text" name="fname" value="<?php if(isset($_GET['editid'])){ echo  $fname;}?>"/> 
		Last Name : <input type="text" name="lname" value="<?php if(isset($_GET['editid'])){ echo  $lname;}?>" /><br>
        Username: <input type="text" name="user_name" value="<?php if(isset($_GET['editid'])){ echo  $user;}?>" /><br>
        <?php if(!isset($_GET['editid'])){ ?>
        Password: <input type="password" name="user_pass"><br>
        Confirm Password: <input type="password" name="user_pass_check"><?php } ?><br>
        E-mail: <input type="email" name="user_email" value="<?php if(isset($_GET['editid'])){ echo  $email;}?>"><br>
		Phone Number : <input type="tel" name="phone" value="<?php if(isset($_GET['editid'])){ echo  $phone;}?>"><br>
        <input type="submit" value="<?php if(isset($_GET['editid'])){ echo "Update"; }else { echo "Sign Up!";}?>" />
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
     
    if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
    {
        echo 'The following must be fixed';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
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
			 
			     $sql = "UPDATE
                    users set fname = '$fname',
					lname = '$lname',
					user_name = '$user',
					user_email = '$email',
					phno = '$phone'  where user_id=$id";
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
 
include '../footer.php';
?>