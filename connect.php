<?php
//connect.php
$server = 'localhost';
$username   = 'root';
$password   = 'nW9tZZeN8L9e4FQ2';
$database   = 'exforum';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database)
{
    exit('Error: could not select the database');
}
?>