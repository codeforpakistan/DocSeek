<?php

$hostName = "mysql.serversfree.com";
$userName = "u274841067_kpit";
$password = "omer123456";
$dbName = "u274841067_kpit";

$lat= $_REQUEST['lat'];
$lon= $_REQUEST['long'];

$con = mysqli_connect($hostName, $userName, $password, $dbName);


if(mysqli_connect_errno())
{	
	echo 'error';
	die(mysqli_connect_errno());
}


$result = mysqli_query($con,"SELECT * FROM facility");


$jsonArray = array(); // creating array

$i = 0;

while($row = mysqli_fetch_array($result) )
{
	$jsonArray[] = $row;
	//echo json_encode($row); // returning json ecoded data

}

echo json_encode($jsonArray);
?>