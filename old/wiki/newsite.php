<?php

include_once '../connect.php';
include_once '../header.php';

//if user selects to enter new site, then prompt get form data
if( $_POST['confirm'] == "Yes")
{
	echo '<form action="divelog.php" method="get">
	<p align="left">
	Site name:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="divesite">
	<br>
	Address Number:
	&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="addressnum">
	<br>
	Address:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp
	<input type="text" name="address">
	<br>
	City:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="city">
	<br>
	State:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="state">
	<br>
	Zip Code:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="zip">
	<br>
	Latitude:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp
	<input type="text" name="lat">
	<br>
	Longitude:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="long">
	<br>
	Site Instructions:
	&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="instructions">
	<br>
	Site Details:<textarea name="details" rows="3" columns="40"></textarea>
	<br>
	<input type="submit" value="Enter">
	</p>
	</form>';
}

//if user does not want to add new site, then return home
else
{
	header('Location: ../home.php');
}
		
include_once '../footer.php';
?>