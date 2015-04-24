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
	echo '<form action="divelog.php" method="post">
	<table class="form">
          <tr>
		  <td><label>Site name</label></td>
		  <td> <input class="medium" type="text" name="diveSite" /></td>
		  </tr>
		  
		  <tr>
		  <td><label>Sub Site Name</label></td>
		  <td> <input class="medium" type="text" name="subSiteName" /></td>
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
		  <td> <textarea rows="3" columns="40" name="siteInstruction"></textarea></td>
		  </tr>
		  
		   <tr>
		  <td><label>Site Details</label></td>
		  <td> <textarea name="siteDetails" rows="3" columns="40"></textarea></td>
		  </tr>
		  
		   <tr>
             <td colspan="2" align="center"> <input class="btn btn-blue" type="submit" value="Enter" /></td>
	     </tr>
		 </table>

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