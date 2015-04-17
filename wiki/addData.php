<?php

include '../connect.php';
include '../header.php';


if(!(isset($_SESSION['signed_in']) && $_SESSION['signed_in']))
{
	//user must be signed in
	//possible upgrade to must be admin
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}

else
{
	if($_SERVER['REQUEST_METHOD'] != 'DiveSite')
	{
		
		echo '<h2>Please enter an area locator.</h2>';
		
		//need to query user for dive site info
		echo '<form method="prompt" action="results.php">
			Zip Code: <input type="text" name="zip" />
			City: <input type="text" name="city" /></textarea>
			<input type="submit" value="Enter" />
			</form>';
		
	}
}
include '../footer.php';
?>