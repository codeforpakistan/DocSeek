<?php

$hostName = "mysql.serversfree.com";
$emailAccount = "u274841067_kpit";
$passwordAccount = "omer123456";
$dbName = "u274841067_kpit";


$con = mysqli_connect($hostName, $emailAccount, $passwordAccount, $dbName);


if(mysqli_connect_errno())
{	
	echo "[{'Status':'Error in Connection'}]";
	die(mysqli_connect_errno());
}



if (!empty($_REQUEST)) {


	$email= $_REQUEST['em'];
	$pass= $_REQUEST['pass'];

		$result = mysqli_query($con,"SELECT DISTINCT * FROM Users WHERE email = '$email' AND password = '$pass'");


	if($result)
	{
		$num_results = mysqli_num_rows($result);

		if($num_results > 0)
		{
			$row = mysqli_fetch_array($result);
			
			if($row['accountConfirmed'] == "false")
				// means userName & password found in DB. Means the user can login
				echo '[{"Status":"Success"}]';// creating array
			else
				echo '[{"Status":"Account Not Confirmed"}]';
			/*
			while($row = mysqli_fetch_array($result) )
			{
				$jsonArray[] = $row;
				//echo json_encode($row); // returning json ecoded data

			}
			*/

		}
		else
			echo "[{'Status':'Fail'}]"; // means user's email & password not found in database

	}
	else
		echo "[{'Status':'Fail'}]"; // means user's email & password not found in database


}

?>