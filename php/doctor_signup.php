<?php
//header('Content-Type: application/json; charset=UTF-8');

// doctor registration

$con = mysql_connect("localhost","root","");

if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

mysql_select_db('kpit',$con);

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
	
    if($name==NULL || $pmdc==NULL || $email==NULL || $pass==NULL || $hospitalname==NULL||$specialist==NULL || $contactNum==NULL ||$workingHours_from==NULL || $workingHours_to==NULL || $contactHours_time==NULL || $contactHours_day==NULL || $gender==NULL)
    {
       $confirm = "Please Fill out the Fields.";
	}
   else
   {
   	
	$result = mysql_query("INSERT INTO doctorDetails(name,PMDC_No,email,password,hospitalname,specialist,contact_no,working_hours,contact_hours,gender) VALUES( '$name','$pmdc', '$email' , '$pass' , '$hospitalname','$specialist', '$contactNum', '$workingHours','$contactHours','$gender')");
    $confirm= "Your Account has been active within 48 hours. ";
    }

echo json_encode($confirm);

  mysql_close($con);
?>