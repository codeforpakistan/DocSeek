<html>
<head>
  <title>DOC SEEK</title>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" >
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/grayscal.css">
    <link rel="stylesheet" href="doc.css">
  <script  src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
  body{padding-top: 90px;}
  </style>
  </head>
  <body id="page-top" data-spy="scroll" data-target=".navbar-inverse">
    <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
        <div class="container">
           <div class="navbar-header page-scroll">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <div class=" col-xs-3 col-sm-1 col-md-1 col-lg-1">
                   <img src="DocSeek.jpg" class="img-thumbnail"></div>
                   <div class="col-sm-3">
                     <a class="navbar-brand" href="#page-top">
                     <h1><b><i>DOC SEEK</i></b></h1></a>
                  </div>
             <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="page-scroll">
                        <a href="home.php"><h3>Back</h3></a>
                    </li>
                    </ul>
          </div>
    </div>
  </div>
    
      </nav>
    <?php
     $conn= mysql_connect('localhost','root','');
      if(!$conn)
      die ("failed to connect:".mysql_error());
      $sel = mysql_select_db('kpit',$conn);
      if(!$sel)
      die("failed to select:".mysql_error());
       $var1=explode(" ",$_POST['alpha']);
        $var=arraycase($var1);
        $out =NULL;
        function arraycase(array $var1) 
        {
        $newarray = unserialize(strtolower(serialize($var1)));
        return $newarray;
          }
          $res_spec=NULL;
          $spec=array("doctors","doctor","hospital","hospitals");
          for ($i=0;$i<sizeof($spec);$i++)
          {
            for ($j=0;$j<sizeof($var);$j++)
            {
              if ($var[$j]==$spec[$i])
              {
                $res_spec = $var[$j];
              }
            }
          }
               
     
     $val=$_POST['id1'];

     if ($val == NULL)
        {
          if ($res_spec!=="doctor" && $res_spec!=="doctors" &&$res_spec!=="hospital" && $res_spec!=="hospitals")
          {
            echo "<p><h2>User have to specify in the searchbar either hospital or doctors</h2></p>";
          }
          elseif ($res_spec=="doctors" || $res_spec=="doctor")
          {
            echo "<p>nothing to display</p>";
          }
          else
            {
            $keyword=array("abbottabad","akora khattak","bannu","charsadda","chitral","dera ismail khan","dir","haripur","kohat","lakki marwat","mansehra","mardan","mingora","nowshera","pabbi","peshawar","saidu sharif","swabi","swat","risalpur","dhq","divisional");
          // print_r($keyword);
               for ($x=0;$x<sizeof($keyword);$x++)
                 {
                  for($y=0;$y<sizeof($var);$y++)
                    {
                       if ($var[$y]==$keyword[$x])
                        {
                          $out = $var[$y];
                        }
                        
                    }
                 }

               if ($out == NULL)
               {
                      $entry = mysql_query("select Facility_Name from Facility where Facility_Name Like '%Hospital%' ");
                    if(!$entry)
                       die("failed to select:".mysql_error());
                     
                     while ($row = mysql_fetch_array($entry))
                     { 
                             echo "<br><br><br><br><br><br>";
                             echo "<div class='container'>";
                               echo "<div class='col-sm-2'></div>";
                               echo "<div class='col-sm-1'><img src='DocSeek.jpg' class='img-thumbnail'></div>";
                               echo "<div class='col-sm-6 lg-link'>";
                                echo "<form action='Doctor.php' method='post'>";
                                echo "<button tyep='submit' name='hospital' class='btn btn-lg btn-lg-my'>$row[0]</button>"."<br><br>";
                                echo "<input type='hidden' name='hosp' value='$row[0]'>";
                                echo "</form>";
                                echo "</div>";
                              echo "<div class='col-sm-3'></div>";
                              echo "</div>";
                         }
               }
               else 
                      {
                   $entry = mysql_query("select Facility_Name from Facility where Facility_Name like '%$out%' AND Facility_Name Like '%Hospital%' OR Facility_Name Like '%dentistry $out%' ");
                    if(!$entry)
                       die("failed to select:".mysql_error());
                     
                     while ($row = mysql_fetch_array($entry))
                     { 
                             echo "<br><br><br><br><br><br>";
                             echo "<div class='container'>";
                               echo "<div class='col-sm-2'></div>";
                               echo "<div class='col-sm-1'><img src='DocSeek.jpg' class='img-thumbnail'></div>";
                               echo "<div class='col-sm-6 lg-link'>";
                                echo "<form action='Doctor.php' method='post'>";
                                echo "<button tyep='submit' name='hospital' class='btn btn-lg btn-lg-my'>$row[0]</button>"."<br><br>";
                                echo "<input type='hidden' name='hosp' value='$row[0]'>";
                                echo "</form>";
                                echo "</div>";
                              echo "<div class='col-sm-3'></div>";
                              echo "</div>";
                         }
                     }
                 }
      
          
        }
        else
        {    
          if ($res_spec!=="doctor" && $res_spec!=="doctors" &&$res_spec!=="hospital" && $res_spec!=="hospitals")
          {
            echo "<p>Invalid String Enter</p>";
          }
          elseif ($res_spec=="doctors" || $res_spec=="doctor")
          {
            echo "<p>nothing to display</p>";
          }
          else
          {
             $entry = mysql_query("select * from Facility ");
           if(!$entry)
                 die("failed to select:".mysql_error());
              $val = str_replace(',', " ",$val);
              $val = str_replace('(', " ",$val);
              $val = str_replace(')', " ",$val);
              $res = explode(" ", $val);
              //echo $res[1]."<br>".$res[3];
              
              $lat = urlencode($res[1]);
              $lon = urlencode($res[3]);
              $res =array();

                while ($row = mysql_fetch_array($entry))
                 { 
                  $lat2=$row['lat'];
                  $lon2=$row['lon'];
                  $latlon2="$lat2".","."$lon2";
                  //$from=urlencode($latlon2);
                  //echo $from;
                  $distance=0;

                  $distance= calculate_distance($lat,$lon,$lat2,$lon2);
                  if ($distance <=5)
                  {
                    
                     $F_Name=array($row['Facility_Name']);
                     $latpass=array($row['lat']);
                     $lonpass=array($row['lon']);
                  }
                  else
                    continue;
                }
              
                 // echo "<br><br><br><br><br><br>";
                 // asort($res);
                 // foreach ($res as $key => $value) {
                 //   # code...
                 //   echo "<div class='container'>";
                 //   echo "<div class='col-sm-2'></div>";
                 //   echo "<div class='col-sm-1'><img src='DocSeek.jpg' class='img-thumbnail'></div>";
                 //   echo "<div class='col-sm-6 lg-link'>";
                 //   echo "<form action='Doctor.php' method='post'>";
                 //  echo "<button tyep='submit' name='hospital' class='btn btn-lg btn-lg-my'>$value[1]</button>"."<br><br>";
                 //  echo "<input type='hidden' name='hosp' value='$value[1]'>";
                 //  echo "</form>";
                 //  echo "</div>";
                 //  echo "<div class='col-sm-3'></div>";
                 //  echo "</div>";
                 // }
                session_start();
                $_SESSION['latpass']=$latpass;
              }   
         }
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
</body>
</html>