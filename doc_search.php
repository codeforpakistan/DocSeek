<html>
<head>
  <title>DOC SEEK</title>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" >
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/grayscale.css">
    <link rel="stylesheet" href="doc.css">
  <script  src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
  body{padding-top: 90px;}
  </style>
  </head>
  <body id="page-top" data-spy="scroll" data-target=".navbar-inverse">
    <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-main-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#page-top">DOC SEEK</a>
      </div>
        <div class="collapse navbar-collapse navbar-right" id="navbar-main-collapse">
          <ul class="nav navbar-nav">
            <li class="page-scroll">
            <a href="home.php">Back</a>
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
    
          if($res_spec!=="doctor" && $res_spec!=="doctors" &&$res_spec!=="hospital" && $res_spec!=="hospitals")
          {
            echo "<p><h2>No result found</h2></p>";
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
        
       mysql_close($conn);
      ?>
</body>
</html>