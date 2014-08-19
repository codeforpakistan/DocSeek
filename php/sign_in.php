<?php
header('Content-Type: application/json; charset=UTF-8');
// User registration

$con = mysql_connect("localhost","root","");

if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }

mysql_select_db('kpit',$con);

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	if ($email==NULL||$pass==NULL)
    {
        $res = "Please Fill out the Fields.";
    }
	else
    {
	$user = mysql_query("SELECT * FROM userdetails");
    $doctor = mysql_query("SELECT * FROM doctordetails");
    while ($row = mysql_fetch_array($user))
    {
    	if($email==$row['email'] && $pass==$row['password'])
    	{
              //echo "User Account";
            $res=$row['name'];
            
    	}
    	else{
            
            while ($row = mysql_fetch_array($doctor))
        {
    	if($email==$row['email'] && $pass==$row['password'])
    	{
            $res=$row['name'];  
    	}
    	
    }
}
}
}
 
$response=$res;
echo json_encode($response);
mysql_close($con);
?>