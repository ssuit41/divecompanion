<?php
//Start session
if(!isset($_SESSION))
{
session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A website to assist divers with gathering predive information and
	discussing various aspects of diving." />
    <meta name="keywords" content="dive, dive help, dive site, dive information, dive assistant" />
    <title>Dive Companion</title>
    <link rel="stylesheet" href="/divecompanion/style.css" type="text/css">
</head>
<body>
<h1>Dive Companion</h1>
 <div id="menu">
    <a class="item" href="/divecompanion/home.php">Home</a> -
	<a class="item" href="/divecompanion/forums/forum.php">Forum</a> -
	<a class="item" href="/divecompanion/account.php">Account</a> -
	<a class="item" href="/divecompanion/wiki/addData.php">Add Data</a> -
	<a class="item" href="/divecompanion/forums/create_category.php">Create Category</a>
</div>
<div id="searchbar">
	<form method="post" action="/divecompanion/wiki/diveSearch.php" id="searchform">
	<input type="number" name="lat">
	<input type="number" name="long">
	<input type="number" name="distance">
	<input type="submit" name="submit" value="Search">
	</form>
</div>
<div id="aside">
	<?php
	if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
	{
	echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="/divecompanion/users/signout.php">Sign out</a>';
	}
	else
	{
	echo '<a href="/divecompanion/users/signin.php">Sign in</a> or <a href="/divecompanion/users/signup.php">create an account</a>.';
	}?>
</div>

<div id="section">