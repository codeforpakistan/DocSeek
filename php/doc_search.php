<?php
session_start();

$conn= mysql_connect('localhost','root','');
if(!$conn)
 die ("failed to connect:".mysql_error());

$sel = mysql_select_db('kpit',$conn);
if(!$sel)
 die("failed to select:".mysql_error());


  $user=$_POST['getuser'];
  echo $user;
  if($user==NULL)
  {
    $_SESSION['user']="false";
  }
  else
  {
  $userchecking= mysql_query("SELECT * FROM userdetails");
  while ($row = mysql_fetch_array($userchecking))
  {
    if($user==$row['name'])
    {
      $_SESSION['user']="true";
    }
  }
}


$var1=explode(" ",$_POST['alpha']);
$var=arraycase($var1);             
$doc_type=NULL;
function arraycase(array $var1) 
{
  $newarray = unserialize(strtolower(serialize($var1)));
  return $newarray;
}
for($i=0;$i<sizeof($var);$i=$i+1)
{
  if($i>0)
  {
    $val = $var[0]." ".$var[1];
  }
  else
  {
    $val= $var[$i];
  }
}
$type = array("anaesthetist","biotechnologist","cardiologist","chest specialist","children specialist","dental surgeon","dermatologist","e.n.t specialist","epidemiologist","eye specialist","gynaecologist","medical specialist","microbiologist","neuro surgeon","nutritionist","oral & maxillofacial surgeon",
                "orthopaedic specialist","orthopaedic surgeon","paediatrician","pathologist","pharmacist","physician","physiotherapist","psychiatrist","radiologist","skin specialist","specialist","surgeon","surgical specialist","t.b specialist","trauma surgeon");

 for ($x=0;$x<sizeof($type);$x++)
   {
     
      if ($val==$type[$x])
        { 
          $doc_type = $val;
        }
   }
 echo $doc_type;
   $res= array();
   $hosp = array();
   $id= array();
  if ($doc_type==NULL)
  {
    $res=NULL;
  }             
  
  elseif ($doc_type!=NULL)
  {
    $entry = mysql_query("SELECT * from personnel where Type like '%$doc_type%'");
    if(!$entry)
      die("failed to select:".mysql_error());

    while ($row = mysql_fetch_array($entry))
    { 
      if($row['Type'] != NULL)
      {
      $res[]=$row['FullName'];
      $hosp[]=$row['PlaceofCurrentPosting'];
      $id[]=$row['EMP_ID'];
      $nomen[] = $row['Nomenclature'];
    }
  }
  }
  
  $_SESSION['res']= $res;
  $_SESSION['hosp']=$hosp;
  $_SESSION['id']=$id;
  $_SESSION['nomen'] = $nomen;
  $_SESSION['username']=$user;
 header('location:doc_search_res.php');
mysql_close($conn);
?>
