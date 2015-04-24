<?php

include_once '../connect.php';
include_once '../header.php';

echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                New Site</h2>
                <div class="block ">';

//if user selects to enter new site, then prompt get form data
if( $_POST['confirm'] == "Yes")
{
<<<<<<< HEAD
	echo '<form action="divelog.php" method="post">
	<p align="left">
	Main site name:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="diveSite">
	<br>
	Sub site name:
	&nbsp&nbsp&nbsp&nbsp
	<input type="text" name="subSiteName">
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
	<input type="text" name="siteInstruction">
	<br>
	Site Details:<textarea name="siteDetails" rows="3" columns="40"></textarea>
	<br>
	<input type="submit" value="Enter">
	</p>
=======
	echo '<form action="divelog.php" method="get">
	<table class="form">
          <tr>
		  <td><label>Site name</label></td>
		  <td> <input class="medium" type="text" name="divesite" /></td>
		  </tr>
		  
		   <tr>
		  <td><label>Address Number</label></td>
		  <td> <input class="medium" type="text" name="addressnum" /></td>
		  </tr>
		  
		   <tr>
		  <td><label>Address</label></td>
		  <td> <input class="medium" type="text" name="address" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>City</label></td>
		  <td> <input class="medium" type="text" name="city" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>State</label></td>
		  <td> <input class="medium" type="text" name="state" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Zip Code</label></td>
		  <td> <input class="medium" type="text" name="zip" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Latitude</label></td>
		  <td> <input class="medium" type="text" name="lat" /></td>
		  </tr>
		  
		   <tr>
		  <td><label>Longitude</label></td>
		  <td> <input class="medium" type="text" name="long" /></td>
		  </tr>
		  
		   <tr>
		  <td><label>Site Instructions</label></td>
		  <td> <input class="medium" type="text" name="instructions" /></td>
		  </tr>
		  
		   <tr>
		  <td><label>Site Details</label></td>
		  <td> <textarea name="details" rows="3" columns="40"></textarea></td>
		  </tr>
		  
		   <tr>
             <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="Enter" /></td>
	     </tr>
		 </table>
>>>>>>> c38d97b6df29c639a8cea3308ec5b223619b0117
	</form>';
}

//if user does not want to add new site, then return home
else
{
	header('Location: ../home.php');
}
echo "</div></div></div>";		
include_once '../footer.php';
?>