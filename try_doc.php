 <?php
  session_start();
     $conn= mysql_connect('localhost','root','');
      if(!$conn)
      die ("failed to connect:".mysql_error());
      $sel = mysql_select_db('kpit',$conn);
      if(!$sel)
      die("failed to select:".mysql_error());
  $val=$_POST['id1'];
  $entry = mysql_query("select * from Facility ");
           if(!$entry)
                 die("failed to select:".mysql_error());
              $val = str_replace(',', " ",$val);
              $val = str_replace('(', " ",$val);
              $val = str_replace(')', " ",$val);
              $res = explode(" ", $val);
               $lat = urlencode($res[1]);
              $lon = urlencode($res[3]);
              $res =array();
               $latpass=array();
               $lonpass=array();
                while ($row = mysql_fetch_array($entry))
                 { 
                  $lat2=$row['lat'];
                  $lon2=$row['lon'];
                  $latlon2="$lat2".","."$lon2";
                  $distance=0;
                  $distance= calculate_distance($lat,$lon,$lat2,$lon2);
                  if ($distance <=10)
                  {
                    
                     $F_Name=array($row['Facility_Name']);
                     $latpass[]=$row['lat'];
                     $lonpass[]=$row['lon'];
                      
                  }
                  else
                    continue;
                }
              
               // print_r($latlon);
                // $try=json_encode($latpass);
                // header('location:home.php?lat='.urlencode($try));
                 $_SESSION['lat']=$latpass;
                 $_SESSION['lon']=$lonpass;
                 header('location:home.php');
                function calculate_distance($latfrom,$lonfrom,$latTo,$lonTo)
           {
            $R=6372.795477598;;
            $b=pi()/180;
            $o1=deg2rad($latfrom);
            $o2=deg2rad($latTo);
            $o=deg2rad($latfrom-$latTo);
            $lam=deg2rad($lonfrom-$lonTo);
            //$a = ( (sin (($o*$b)/2) )*(sin (($o*$b)/2))) + (cos($o1*$b)*cos($o2*$b)*sin($lam*$b)*sin($lam*$b));
            //$c = 2* atan2(sqrt($a), sqrt(1-$a));
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
       mysql_close($conn);
      ?>