<?php

include_once '../connect.php';
include_once '../header.php';

//open database connection
$conn = connect();

echo '<div class="grid_12">
            <div class="box round first fullpage">
                <h2>
                  Results</h2>
                <div class="block ">';
//get zip code information from addData.php
$zip = $_POST["zip"];

//perform query of database based on zip code
	$sql = "SELECT
				divesitedetails.subSiteName,
				divesitedetails.subSiteNum,
				divesitedetails.diveSiteNum,
				divesite.diveSite,
				divesite.diveSiteNum,
				divesite.zipCode
			FROM
				divesitedetails
			LEFT JOIN
				divesite
			ON
				divesitedetails.diveSiteNum = divesite.diveSiteNum
			WHERE
				divesite.zipCode = '$zip'";
$result = $conn->query($sql);

//database connection error
if(!$result)
{
	echo 'The dive sites could not be displayed, please try again later.' . $conn->error;
}

else
{
//if zero rows are returned, then there are no dive sites in that zip code
	if($result->num_rows == 0)
	{
		//propmt user to add a new dive site
		echo 'A NEW SITE!
			<br>
			Do you want to add this site?';
			
		echo '<form action="newsite.php" method="post">
			 <input type="submit" name="confirm" value="Yes">
			 <input type="submit" name="confirm" value="No">
			 </form>';

	}
	
//if rows are returned, then there are existing dive sites in that zip code
	else
	{
		//output sites as a table
		echo '<table border="1">
			<tr>
				<th>Dive Site</th>
				<th>Zip Code</th>
			</tr>';
	 
		while($row = $result->fetch_assoc())
		{              
			echo '<tr>';
				echo '<td class="leftpart">';
				//this should link the user to existingsite.php where the information will be queried from the database
				//and the user will have the option to add a new dive log to an existing site
				//***NOTE*** existingsite.php has problems
					echo '<h3><a href="existingsite.php?id=' . $row['subSiteNum'] . '">' . $row['subSiteName'] . '</a></h3>' . $row['diveSite'];
				echo '</td>';
				echo '<td class="rightpart">';
					echo $row['zipCode'];
				echo '</td>';
			echo '</tr>';
		}
		
		//give the user the option to add a new dive site if the one they are looking for is not listed in this zip code
		echo '<form action="newsite.php" method="post"><table class="form">
          <tr>
		  <td><label>Not the site you wanted? Would you like to add a new site?</label></td>
		  <td> <input class="btn btn-blue" type="submit" name="confirm" value="Yes">
		       <input class="btn btn-blue" type="submit" name="confirm" value="No"></td>
		  </tr>
		
		</form>';
	}
}
echo '</table></div></div></div>';
include_once '../footer.php';
?>