<?php

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


	$name = $_POST['name'];
	$pmdc = $_POST['pmdcno'];	
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$hospitalname = $_POST['hospitalname'];
	$specialist = $_POST['specialist'];
	$contactNum = $_POST['contactNum'];
	$workingHours_from = $_POST['workingHours_from'];
	$workingHours_to = $_POST['workingHours_to'];
	$contactHours_day = $_POST['contactHours_day'];
	$contactHours_time= $_POST['contactHours_time'];
	$gender = $_POST['gender'];
	$workingHours = $workingHours_from."-".$workingHours_to;
	$contactHours = $contactHours_day.",".$contactHours_time;
	
   $result = mysql_query("INSERT INTO doctorDetails(name,PMDC_No,email,password,hospitalname,specialist,contact_no,working_hours,contact_hours,gender) VALUES( '$name','$pmdc', '$email' , '$pass' , '$hospitalname','$specialist', '$contactNum', '$workingHours','$contactHours','$gender')");

	
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


  mysql_close($con);
?>