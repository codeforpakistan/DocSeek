<?php
header('Content-Type: application/json; charset=UTF-8');
// User registration

$con = mysql_connect("localhost","root","");

if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

mysql_select_db('kpit',$con);

	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];

	if($name==NULL||$email==NULL||$pass==NULL)
	{
		$data="Please Fill out the Fields.";
	}
	else
	{
	$result = mysql_query("INSERT INTO userDetails(name,email,password) VALUES( '$name', '$email' , '$pass')");


	if(!$result)
	{
		echo '[{"Status":"Unexpected Problem"}]';

		die("unable to insert data" . mysql_error($con));
	}
	else
	{
		// send confirmation email to $email
	}

     $data="Account Created";
 }
 echo json_encode($data);
     //header('location:..\user_sign_up.html');
mysql_close($con);
?>