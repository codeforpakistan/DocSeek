<html>
<head>
<title></title>

</head>
<body >

<?php



$con = mysql_connect("localhost","root","");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }
    
    
    echo "</br>";

    mysql_select_db('kpithrd',$con);


//////Displaying Data/////////////
// $id=$_GET['id']; // Collecting data from query string
// if(!is_numeric($id)){ // Checking data it is a number or not
// echo "Data Error"; 
// exit;
// }

$q=mysql_query("select * from personnel");
$row=mysql_fetch_object($q);
echo mysql_error();
echo "<table>";
echo "
<tr bgcolor='#f1f1f1'><td><b>Name</b></td><td>$row->FullName</td></tr>
<tr><td><b>Hospital</b></td><td>$row->PlaceofCurrentPosting</td></tr>
<tr bgcolor='#f1f1f1'><td><b>Contact no</b></td><td>115</td></tr>
<tr><td><b>Address</b></td><td>address</td></tr>
";
echo "</table>";

//////////////////// 
?>
</body>
</html>