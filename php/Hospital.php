<?php
   $conn= mysql_connect('localhost','root','');
   if(!$conn)
   die ("failed to connect:".mysql_error());
   $sel = mysql_select_db('kpit',$conn);
   if(!$sel)
   die("failed to select:".mysql_error());
   $v1=$_POST['hosp'];
   if (isset($_POST['hospital']))
      {
        
       $entry = mysql_query("select * from facility where Facility_Name like '%$v1%' ");
       if(!$entry)
       die("failed to select:".mysql_error());
       while ($row = mysql_fetch_array($entry))
       {
        $lat=$row['lat'];
        $lon=$row['lon'];
        }
      }
    ?>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIdreDurlXrqiP61Cu6P4yaZch1pKtAyw &sensor=true"></script>
  <style>
  body{padding-top: 90px;}
  </style>
  <script>
function initialize()
{
   var googlePos=new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lon; ?>);
var mapProp = {
  
  center:googlePos,
  zoom:17,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById("smallmap"),mapProp);
var marker = new google.maps.Marker({
      position: googlePos,
      map: map,
      title : 'Hi , I am here',
            animation : google.maps.Animation.DROP
  });

}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
  </head>
  <body  id="page-top" data-spy="scroll" data-target=".navbar-inverse">
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
<div class="container">
    <div class="well " style="height:500px ;padding-top:40px;">
    <div class='col-lg-6'>
    <p><?php echo $v1; ?></p>
    
    </div>
    <div class='col-lg-6'>
      <p id = "smallmap"></p>
    </div>
  </div>
</div>
</div>
</body>
</html>