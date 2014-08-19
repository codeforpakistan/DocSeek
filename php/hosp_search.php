<?php
session_start();;

 $conn= mysql_connect('localhost','root','');
 if(!$conn)
   die ("failed to connect:".mysql_error());

 $sel = mysql_select_db('kpit',$conn);
 if(!$sel)
   die("failed to select:".mysql_error());
 
    $username = $_POST['getuser'];
	$var1=explode(" ",$_POST['alpha']);
	$var=arraycase($var1);
	$hosp =NULL;

	function arraycase(array $var1) 
	 {
	    $newarray = unserialize(strtolower(serialize($var1)));
	    return $newarray;
	 }

	$keyword=array("abbottabad","akora khattak","bannu","charsadda","chitral","dera ismail khan","dir","haripur","kohat","lakki marwat","mansehra","mardan","mingora","nowshera","pabbi","peshawar","saidu sharif","swabi","swat","risalpur","dhq","divisional");

	for ($x=0;$x<sizeof($keyword);$x++)
	   {
	      for($y=0;$y<sizeof($var);$y++)
	       {
	         if ($var[$y]==$keyword[$x])
	           {
	              $hosp = $var[$y];
	           }
	       }
	   }
	  
     $res = array();
	if ($hosp == NULL)
	{
      $res=NULL;
	}

	else if($hosp!=NULL )
	{ 
	  $entry = mysql_query("select Facility_Name from facility where Facility_Name like '%$hosp%' AND Facility_Name Like '%Hospital%' OR Facility_Name Like '%dentistry $hosp%' ");
	    if(!$entry)
	      die("failed to select:".mysql_error());

	    while ($row = mysql_fetch_array($entry))
	    { 
	       $res[] = $row['Facility_Name'];
	       $_SESSION['result'] = $res;
	    }
	    
	}

$_SESSION['username']= $username;
echo $username;
//header('location:hosp_search_res.php');
mysql_close($conn);
?>