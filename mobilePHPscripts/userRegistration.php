<?php

// user registration

$hostName = "mysql.serversfree.com";
$emailAccount = "u274841067_kpit";
$passwordAccount = "omer123456";
$dbName = "u274841067_kpit";



$con = mysqli_connect($hostName, $emailAccount, $passwordAccount, $dbName);


if(mysqli_connect_error())
{
	echo '[{"Status":"Error in Connection"}]';

	die("Error in connection");
}


if(!empty($_REQUEST))
{

	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$pass = $_REQUEST['pass'];



	$result = mysqli_query($con, "INSERT INTO Users(name, email, password, accountConfirmed) VALUES( '$name', '$email' , '$pass' , 'false'  )");


	if(!$result)
	{
		echo '[{"Status":"Unexpected Problem"}]';

		die("unable to insert data" . mysqli_error($con));
	}
	else
	{
		// send confirmation email to $email
	}



	echo '[{"Status":"Account Created"}]';

}


?>