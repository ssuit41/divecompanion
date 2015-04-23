<?php

include_once '../connect.php';
include_once '../header.php';


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
		
		//query user for dive site info
		//only implemented by zip code right now
		//need to add additional locator options, but will cascade changes to results.php
		echo '<p align="center">
			<form action="results.php" method="post">
			Zip Code: <input type="text" name="zip" >
			<input type="submit" value="Enter" />
			</form>
			</p>';
		
	}
}
include '../footer.php';
?>