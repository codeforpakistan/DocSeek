<?php

$hostName = "mysql.serversfree.com";
$userName = "u274841067_kpit";
$password = "omer123456";
$dbName = "u274841067_kpit";

$con = mysqli_connect($hostName, $userName, $password, $dbName);

if(!$con)
   echo 'failed </br>';

if(mysqli_connect_errno())
{	
	echo 'error';
	die(mysqli_connect_errno());
}

mysql_select_db($dbName);
$newTable = "CREATE TABLE  IF NOT EXISTS hospLocation (hospName VARCHAR(100) NOT NULL,
											  hospLat VARCHAR(20) NOT NULL,
											  hospLong VARCHAR(20) NOT NULL,
											  PRIMARY KEY(hospName)
)";


$result = mysql_query($newTable);


?>