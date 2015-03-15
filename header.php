<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A website to assist divers with gathering predive information and
	discussing various aspects of diving." />
    <meta name="keywords" content="dive, dive help, dive site, dive information, dive assistant" />
    <title>Dive Companion</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1>Dive Companion</h1>
 <div id="nav">
    <a class="item" href="home.php">Home</a> -
	<a class="item" href="forum/forum.php">Forum</a> -
	<a class="item" href="account.php">Account</a>
	<a class="item" href="wiki/addData.php">Add Data</a>
</div>
<div id="searchbar">
	<form method="post" action="divesearch.php" id="searchform">
	<input type="text" name="location">
	<input type="number" name="distance">
	<input type="submit" name="submit" value="Search">
	</form>
</div>
<div id="aside">
	<?php
	if($_SESSION['signed_in'])
	{
	echo 'Hello' . $_SESSION['user_name'] . '. Not you? <a href="signout.php">Sign out</a>';
	}
	else
	{
	echo '<a href="signin.php">Sign in</a> or <a href="Sign up">create an account</a>.';
	}?>
</div>

<div id="section">