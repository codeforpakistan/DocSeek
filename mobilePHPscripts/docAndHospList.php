<?php

$hostName = "mysql.serversfree.com";
$userName = "u274841067_kpit";
$password = "omer123456";
$dbName = "u274841067_kpit";

$con = mysqli_connect($hostName, $userName, $password, $dbName);


if(mysqli_connect_errno())
{	
	echo 'error';
	die(mysqli_connect_errno());
}

$user= $_REQUEST['userSelection'];

//echo $suggest;

$result = mysqli_query($con,"SELECT DISTINCT FullName, PlaceOfCurrentPosting FROM personnel WHERE Cadre LIKE '".$user."%'");


$jsonArray = array(); // creating array


while($row = mysqli_fetch_array($result) )
{
	$jsonArray[] = $row;
}

echo json_encode($jsonArray);
?>