<?php
session_start();
if(isset($_SESSION['res'])&&isset($_SESSION['user']) && isset($_SESSION['hosp']))
{
	$result = $_SESSION['res'];
	$user = $_SESSION['user'];
	$hosp = $_SESSION['hosp'];
	$id = $_SESSION['id'];
	$username = $_SESSION['username'];
} 
else
{
$result=NULL;
$user = NULL;
$hosp = NULL;
$id= NULL;
$username= NULL;
}
session_destroy();
?>
<html lang="en-US">
<head>
<!-- META TAGS -->
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Title -->
<title>Doc Seek</title>
<!-- Font CSS Link -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<!-- Font CSS Link -->
<!-- Start CSS Link -->
<link type="text/css" rel="stylesheet" href="..\assets/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="..\assets/css/bootstrap-responsive.css">
<link type="text/css" rel="stylesheet" href="..\assets/css/graha-pink.css">
<link type="text/css" id="main-style" rel="stylesheet" href="#">
<link type="text/css" rel="stylesheet" href="..\assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="..\assets/css/flexslider.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="..\assets/css/jquery-ui.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="..\assets/css/palette_switcher.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="..\assets/css/toggles.css" type="text/css" media="screen"/>
<!-- End CSS Link -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53604114-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>

<!--Menu wrapper Start-->
<div id="menu-wrapper">
		<div class="container">
			<div class="menu-container">
				<div class="top-menu navbar">
					<div class="navbar-inner">
						<div class="moblogo visible-phone visible-tablet">
							<a href="#"><img src="..\assets/img/docseek_logo.png" alt="logo"></a>
						</div>
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</a>
						<ul class="nav nav-collapse collapse">
							<li><a href="..\index.html" id="aindexp">Doc Seek</a>
                            </li>
                            <li><a href="..\features.html" id="afeatp">features</a>
							</li>
							<li>
							<div class="home-logo">
								<div>
									<a href="..\index.html" id="alogop"><img src="..\assets/img/docseek_logo.png" alt="logo"></a>
								</div>
							</div>
							</li>
							<li><a href="..\contact.html" id="acontactp">contact</a></li>
							<li><a href="..\sign_in.html" id="asignp">sing in</a></li>
							<li><a href="#" id="auser"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--Menu wrapper End-->
<section>
	<br><br><br><br>
</section>

<div id="content-wrapper">
	<!--Home content start-->
	<div class="container">
		<div id="home-content">
			<div class="row">
				<div class="span8">
					<div class="heading-area">
						<h2>Search Results</h2>
					</div>
					<div class="listing-rows">
						<div class="row">
						<div class='property-display clearfix span8'>
								<?php
								if ($result==NULL)
								{
								echo"<div class='span5'>";
								echo"<h3>No Results found</h3>";
								echo "</div>";
								}
                              else{
								for ($i=0;$i<sizeof($result);$i=$i+1)
								{
                                
								echo"<div class='span5'>";
								echo"<form action='Doctor.php' method='post' style='padding-top:20px'>";
								echo"<button class='btn btn-large ' type='submit' style='font-size:20px;text-align:left'>".$result[$i]."
								<p style='font-size:14px'>".$hosp[$i]."</p></button>";
								echo"<input type='hidden' name='doctor' value='$result[$i]'>";
								echo"<input type='hidden' name='empid' value='$id[$i]'>";
								echo"<input type='hidden' name='userStatus' value='$user'>";
								echo"<input type='hidden' name='username' value='$username'>";
								echo"</form>";
								echo "</div>";
								}
							}
						   ?>
					        
					     </div>
                        </div>
					</div>
				</div>
				<div class="span4">
                 
				</div>
			</div>
		</div>
	</div>
	<!--Home content end-->
</div>
<section>
	<br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	<br>
</section>
<!--Footer   area   start-->
<div class="footer-wrapper clearfix">
	<div class="container">
		<div class="row">
			<div class="span10">
				<div class="footer">
					 &copy; 2014 DocSeekapp.com | All rights reserved.
				</div>
			</div>
		</div>
	</div>
</div>
<!--Footer   area   End-->

<!-- Start JS Link -->
<script src="..\assets/js/modernizr.js"></script>
<script type="text/javascript" src="..\assets/js/jquery.js"></script>
<script type="text/javascript" src="..\assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="..\assets/js/bootstrap.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC_aOgBOH5a6C5rWkb9Sb2Q3IpVJD7DUiQ&amp;sensor=false"></script>
<script type="text/javascript" src="..\assets/js/gmap3.infobox.min.js"></script>
<script type="text/javascript" src="..\assets/js/gmap3.min.js"></script>
<script type="text/javascript" src="..\assets/js/gmap3.clusterer.js"></script>
<script src="..\assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="..\assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="..\assets/js/switcher.js"></script>
<script defer src="..\assets/js/jquery.prettyPhoto.js"></script>
<script defer src="..\assets/js/jquery.flexslider.js"></script>
<script defer src="..\assets/js/custom.js"></script>
<script defer src="..\assets/js/toggles.js"></script>
<script src="..\assets/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="..\assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="..\assets/js/jquery.panorama.js"></script>
<script type="text/javascript" src="..\assets/js/url_parser.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var user = "<?php echo $username;?>";
	
    
	if(user)
	{
		$('#asignp').text("sign out");
		var index= "../index.html?user="+user;
		var features= "../features.html?user="+user;
		var contact= "../contact.html?user="+user;
		var indexchange = "../index.html";
		var featchange = "../features.html";
		var contchange ="../contact.html";
		$('#auser').text(user);
		$('#aindexp').attr("href",index);
		$('#afeatp').attr("href",features);
		$('#acontactp').attr("href",contact);
		$('#alogop').attr("href",index);
		$('#asignp').click(function (e){
		  e.preventDefault();
         $('#asignp').text("sign in");
         $('#asignp').attr("href","#");
         $('#auser').html(null);
         $('#aindexp').attr("href",indexchange);
		$('#afeatp').attr("href",featchange);
		$('#acontactp').attr("href",contchange);
		$('#alogop').attr("href",indexchange);
		});
    }
})

</script>
<script>$('#widget').draggable();</script>

<!-- End JS Link -->
</body>
</html>