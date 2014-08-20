<?php

//OLD CODE

function sort_by_Distance($dist, $res_dit)
{
		/*	
		echo "in here</br>". sizeof($dist);

		echo "</br></br></br> before</br></br></br>". json_encode($res_dit)."</br></br></br>";


	$j=0;
	while($j < sizeof($dist))
		echo $dist[$j++]."</br>";
	*/

	$j=0;
	while($j < sizeof($dist))
	{
		$i=-1;
		 while($i < sizeof($dist)-2)
		 {
		$i++;
		//echo $dist[$i]."</br>";
		   if($dist[$i]> $dist[$i+1])
		   {
			//$temp = $dist[$i+1];
			//echo $temp. ' here </br></br></br>';
			$temp_res = $dist[$i];
			$dist[$i] = $dist[$i+1];
			$dist[$i+1] = $temp_res;

			$temp_res = $res_dit[$i];
			$res_dit[$i] = $res_dit[$i+1];
			$res_dit[$i+1] = $temp_res;


			//$i++;		
			
		   }

		  
		 }
	$j++;

	}

	shortList_nearestHosps($user, $res_dit);

	/*
	echo "</br></br></br> after</br></br></br>". json_encode($res_dit)."</br></br></br>";
	

	$j=0;
	echo "</br></br></br></br></br></br>";
	while($j < sizeof($dist))
		echo $res_dit[$j++]['Facility_Name']. "  ->  ".$res_dit[$j++]['distance']."</br>";

	*/
	//echo json_encode($res_dit); // remove it
	
	return $res_dit;

}


function shortList_nearestHosps($user, $res_dist)
{
	global $con,$user;
	
	//echo $user . "</br>";
	
	$result = mysqli_query($con,"SELECT DISTINCT FullName, PlaceOfCurrentPosting, Nomenclature FROM personnel WHERE Nomenclature LIKE '".$user."%' AND PlaceOfCurrentPosting LIKE '%%' ");

	$output = array();
	
	$x = 0;
	
	/*
	$i=0;
	while($i < sizeof($res_dist))
	{
		echo $res_dist[$i]['Facility_Name']. "</br>";
		$i++;
	}
	*/

	$toBeSorted = array();
	
	while($row = mysqli_fetch_array($result) )
	{
		$i = -1;
		
		
		
		$toBeSorted[] = $row;
			
		$x++;
	}
	
	$sendToAndroid = array();


	$j=0;
	while($j < sizeof($res_dist))
	{
		$i=-1;
		 while($i < sizeof($toBeSorted)-2)
		 {
			$i++;
			//echo $dist[$i]."</br>";
		   if($res_dist[$j]['Facility_Name'] == $toBeSorted[$i]['PlaceOfCurrentPosting'])
		   {
			
				$toBeSorted[$i]['distance'] = $res_dist[$j]['distance'];

				$toBeSorted[$i]['lat_dest'] = $res_dist[$j]['lat'];
				$toBeSorted[$i]['long_dest'] = $res_dist[$j]['lon'];

		  	 	$sendToAndroid[] = $toBeSorted[$i];
				//$i++;		
				
		   }

		  
		 }
		$j++;

	}


	//global $distance;
	//$shortlist = sort_by_Distance($distance, $output);
	
	//echo json_encode($shortlist);

	//return $output;
	
	
	$temp = array_filter($sendToAndroid);

	if (!empty($temp)) {
		echo json_encode($sendToAndroid);
	}
	else
	{
		// if no data found return random data
		$temp = array();
		
		$h=0;
		while($h < 10)
		{
			$toBeSorted[$h]['lat_dest'] = 0;
			$toBeSorted[$h]['long_dest'] = 0;
			
			$temp[] = $toBeSorted[$h];
						
			$h++;
		}
		
		echo json_encode($temp);
	}
	
}



function calc_distance($latFrom, $lonFrom, $latTo, $longTo)
	{
		$r=6372.795477598;

		$latDelta=$latFrom-$latTo;
		$lonDelta=$lonFrom-$longTo;

	    $latDelta = deg2rad($latTo - $latFrom);
	    $lonDelta = deg2rad($longTo - $lonFrom);

	    $latTo = deg2rad($latTo);
	    $latFrom = deg2rad($latFrom);


		$a=sin($latDelta/2)*sin($latDelta/2)+sin($lonDelta/2)*sin($lonDelta/2)*cos($latFrom)*cos($latTo);
		$c=2*atan2(sqrt($a),sqrt(1-$a));
		$d=$c * $r;

		if($d < 10.0)
			return $d+0.60*$d;
		else
			return $d+0.30*$d;
	}




ini_set('display_errors',1);
ini_set('memory_limit', '394217728');

$hostName = "mysql.serversfree.com";
$userName = "u274841067_kpit";
$password = "omer123456";
$dbName = "u274841067_kpit";

$lat= $_REQUEST['lat'];
$lon= $_REQUEST['long'];

$user= $_REQUEST['userSelection'];

$con = mysqli_connect($hostName, $userName, $password, $dbName);

if(mysqli_connect_errno())
{	
	echo 'error';
	die(mysqli_connect_errno());
}
 
 
$latlon1="$lat".","."$lon";


$result = mysqli_query($con,"SELECT * FROM facility WHERE Facility_Name LIKE '%%' ");
    
   if(!$result )
     die("failed to fetch 1:".mysql_error());
      
   $res_dist = array();
	  

$distance = array();

     while($row = mysqli_fetch_array($result))
       { 
			$u++;

			$d =  calc_distance($lat, $lon, $row['lat'], $row['lon']);

			//echo "</br>". sizeof($distance);
			//echo "</br>".$d. "-> ".$row[0]."  " .$row[1]. " ". $row[2]."</br>";

			//if($d< 30)
			{
			   $distance[] = $d;
			   $row['distance'] = $d;
			   $res_dist[] = $row;
			}
				
      }



//$temp = shortList_nearestHosps($user, $res_dist);

sort_by_Distance($distance, $res_dist);


?>