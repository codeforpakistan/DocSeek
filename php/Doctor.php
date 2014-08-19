<?php
 session_start();
$conn= mysql_connect('localhost','root','');
if(!$conn)
die ("failed to connect:".mysql_error());
$sel = mysql_select_db('kpit',$conn);
if(!$sel)
die("failed to select:".mysql_error());
$doc=$_POST['doctor'];
$id =$_POST['empid'];
$u = $_POST['userStatus'];
$uname = $_POST['username'];
echo $doc."--".$id;
$_SESSION['userStatus']=$u;

  $entry = mysql_query("select * from personnel where EMP_ID=$id ");
    if(!$entry)
    die("failed to select:".mysql_error());

    while ($row = mysql_fetch_array($entry))
      {
        $type=$row['Nomenclature'];
        echo $type." ".$row['FullName'];
      }

   $_SESSION['name']=$doc;
   $_SESSION['type']=$type;
   $_SESSION['id']=$id;
   $_SESSION['uname'] = $uname;
   header('location:Doctor_res.php');   
  
mysql_close($conn);
    ?>

   