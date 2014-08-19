<?php
header('Content-Type: application/json; charset=UTF-8');
	$conn= mysql_connect('localhost','root','');
	if(!$conn)
	die ("failed to connect:".mysql_error());
	$sel = mysql_select_db('kpit',$conn);
	if(!$sel)
	die("failed to select:".mysql_error());
 $email = $_POST['email'];  
	$entry = mysql_query("INSERT INTO notification(email) values ('$email') ");
	    if($entry)
	    {
	    	$reply = "done";
	    }
	echo json_encode($reply);
	mysql_close($conn);
?>