<?php
//header('Content-Type: application/json; charset=UTF-8');
  session_start();
 $conn= mysql_connect('localhost','root','');
 if(!$conn)
  die ("failed to connect:".mysql_error());
$sel = mysql_select_db('kpit',$conn);
if(!$sel)
  die("failed to select:".mysql_error());

  $val=$_POST['id1'];
  $res = array();
  echo $val;
  $entry = mysql_query("select * from facility ");
  if(!$entry)
   die("failed to select:".mysql_error());
  $val = str_replace(',', " ",$val);
  $val = str_replace('(', " ",$val);
    $val = str_replace(')', " ",$val);
    $res = explode(" ", $val);
    $lat = urlencode($res[1]);
    $lon = urlencode($res[3]);
    $latpass=array();
    $lonpass=array();
    while ($row = mysql_fetch_array($entry))
    { 
      $lat2=$row['lat'];
      $lon2=$row['lon'];
      $latlon2="$lat2".","."$lon2";
      $distance=0;
      $distance= calculate_distance($lat,$lon,$lat2,$lon2);
      if ($distance < 30){ 
        $res[]=$row['Facility_Name'];
      }
      else
        continue;
    }

  function calculate_distance($latfrom,$lonfrom,$latTo,$lonTo)
  {
    $R=6372.795477598;;
    $b=pi()/180;
    $o1=deg2rad($latfrom);
    $o2=deg2rad($latTo);
    $o=deg2rad($latfrom-$latTo);
    $lam=deg2rad($lonfrom-$lonTo);
    $angle = 2 * asin(sqrt(pow(sin($o / 2), 2) +
     cos($o1) * cos($o2) * pow(sin($lam / 2), 2)));
    $d = $R*$angle;
    if ($d <4)
    {
      $d = 0.20*$d+$d;
      return $d;
    }
    else if ($d <10)
    {
      $d = 0.60*$d+$d;
      return $d;
    }
    else
    {
      $d=0.30*$d+$d;
      return $d;
    }
  }
//$response=$res;
  //echo json_encode ($response);

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
    $vale = $var[0]." ".$var[1];
  }
  else
  {
    $vale= $var[$i];
  }
}
$type = array("anaesthetist","biotechnologist","cardiologist","chest specialist","children specialist","dental surgeon","dermatologist","e.n.t specialist","epidemiologist","eye specialist","gynaecologist","medical specialist","microbiologist","neuro surgeon","nutritionist","oral & maxillofacial surgeon",
                "orthopaedic specialist","orthopaedic surgeon","paediatrician","pathologist","pharmacist","physician","physiotherapist","psychiatrist","radiologist","skin specialist","specialist","surgeon","surgical specialist","t.b specialist","trauma surgeon");

 for ($x=0;$x<sizeof($type);$x++)
   {
     
      if ($vale==$type[$x])
        { 
          $doc_type = $vale;
        }
   }
 echo $doc_type;
   $result= array();
   $hosp = array();
   $id= array();
  if ($doc_type==NULL)
  {
    $result=NULL;
  }             
  
  elseif ($doc_type!=NULL)
  { 
    for($i=0;$i<sizeof($res);$i++)
    {
    $entry = mysql_query("SELECT * from personnel where Type like '%$doc_type%' AND FacilityName like '$res[$i]' ");
    if(!$entry)
      die("failed to select:".mysql_error());

    while ($row = mysql_fetch_array($entry))
    { 
      if($row['Type'] != NULL)
      {

      $result[]=$row['FullName'];
      $hosp[]=$row['PlaceofCurrentPosting'];
      $id[]=$row['EMP_ID'];
      $nomen[] = $row['Nomenclature'];
      if($row['PlaceofCurrentPosting']== $res[$i])
      {
        $result[]=$row['FullName'];
      $hosp[]=$row['PlaceofCurrentPosting'];
      $id[]=$row['EMP_ID'];
      $nomen[] = $row['Nomenclature'];
      }
    }
  }
}

  }
  
  $_SESSION['res']= $result;
  $_SESSION['hosp']=$hosp;
  $_SESSION['id']=$id;
 $_SESSION['nomen'] = $nomen;
 $_SESSION['username']=$user;
 header('location:doc_search_res.php');
mysql_close($conn);
  ?>