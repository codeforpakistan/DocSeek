<?php
header('Content-Type: application/json; charset=UTF-8');
// contact Us

$con = mysql_connect("localhost","root","");

if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

mysql_select_db('kpit',$con);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone_no'];
$message = $_POST['message'];

if($name==NULL && $email==NULL)
{
	$response = "Please Fill out the Fields.";
}
else
{
	$entry = mysql_query(" INSERT INTO contact(name,email,phone_no,message) VALUES ('$name','$email','$phone','$message')");
	if (!$entry)
	{
		$response = "Unexpected Problem";
	}
	else
	{
		$response = "Your message has been saved.";
	}
}
echo json_encode($response);
mysql_close($con);
?>