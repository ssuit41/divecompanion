<?php
include_once '../connect.php';
include_once '../header.php';

echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                  Please enter an area locator</h2>
                <div class="block ">';
				
if(!(isset($_SESSION['signed_in']) && $_SESSION['signed_in']))
{
	//user must be signed in
	//possible upgrade to must be admin
	echo 'Sorry, you have to be <a href="/divecompanion/users/signin.php">signed in</a> to create a topic.';
}

else
{
	if($_SERVER['REQUEST_METHOD'] != 'DiveSite')
	{
		
		//echo '<h2>Please enter an area locator.</h2>';
		
		//query user for dive site info
		//only implemented by zip code right now
		//need to add additional locator options, but will cascade changes to results.php
<<<<<<< HEAD
		echo '<p align="center">
			<form action="results.php" method="post">
			Zip Code: <input type="text" name="zip" >
			<input type="submit" value="Enter" />
			</form>
			</p>';
=======
		echo '<form action="results.php" method="get">
			<table class="form">
          <tr>
		  <td><label>Zip Code</label></td>
		  <td> <input class="medium" type="text" name="zip" /></td>
		  </tr>
		  
			<tr>
             <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="Enter" /></td>
	       </tr>
	      </table>
			</form>';
			
>>>>>>> c38d97b6df29c639a8cea3308ec5b223619b0117
		
	}
}
echo '</div></div></div>';
include '../footer.php';
?>