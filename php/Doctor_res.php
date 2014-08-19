<?php
session_start();
if(isset($_SESSION['type'])&& isset($_SESSION['id'] )&& isset($_SESSION['name']) && isset($_SESSION['userStatus']))
{ 
    $name = $_SESSION['name'];
	$type = $_SESSION['type'];
	$id = $_SESSION['id'];
	$status = $_SESSION['userStatus'];
	$username = $_SESSION['uname'];
} 
else
{
$name=NULL;
$type=NULL;
$id=NULL;
$status="false";
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
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="..\assets/css/bootstrap-responsive.css">
<link type="text/css" rel="stylesheet" href="..\assets/css/graha-pink.css">
<link type="text/css" id="main-style" rel="stylesheet" href="#">
<link type="text/css" rel="stylesheet" href="..\assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="..\assets/css/flexslider.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="..\assets/css/jquery-ui.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="..\assets/css/palette_switcher.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="..\assets/css/toggles.css" type="text/css" media="screen"/>
<!--<link type="text/css" rel="stylesheet" href="..\assets/css/css/bootstrap.min.css">-->
<link type="text/css" rel="stylesheet" href="..\assets/css/css/mystyle.css"> 

<!-- End CSS Link -->
<script type="text/javascript" src="..\assets/js/jquery.js"></script>
<!-- <script type="text/javascript" src="..\assets/js/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="..\assets/js/review.js"></script>

 <script>
  $(document).ready(function(){

    $('#submit').click(function (e) {
      e.preventDefault();
      $.post("review.php", $("#formid").serialize(),function(reply){
       alert(reply);
      });
     return false;
    });
    
  })
  </script>
</script>
<style>
  .animated {
    -webkit-transition: height 0.2s;
    -moz-transition: height 0.2s;
    transition: height 0.2s;
}

.stars
{
    margin: 20px 0;
    font-size: 24px;
    color: #d17581;
}
@media(min-width:768px){
	textarea.span3{margin-left: 30px;width:180px;}
}

@media(min-width:990px){
	textarea.span3{margin-left: 30px;width:210px;}
}
@media(min-width:1200px){
	textarea.span3{margin-left: 30px;width:320px;}
}
  </style>
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
							<li><a href="..\index.html" id="aindexpd">Doc Seek</a>
                            </li>
                            <li><a href="..\features.html" id="afeatpd">features</a>
							</li>
							<li>
							<div class="home-logo">
								<div>
									<a href="..\index.html" id="alogopd"><img src="..\assets/img/docseek_logo.png" alt="logo"></a>
								</div>
							</div>
							</li>
							<li><a href="..\contact.html" id="acontactpd">contact</a></li>
							<li><a href="..\sign_in.html" id="asignpd">sing in</a></li>
							<li><a href="#" id="auser"></a></li>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--Menu wrapper End-->
<section>
	<br><br><br><br><br>
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
							
								<?php
								
                                echo "<div class='property-display clearfix span8'>";
								echo"<div class='span4 cont-sp'>";
								echo"<h2>".$name."</h2><br>";
								echo"<h4>".$type."</h4>";
								echo"<div class='well well-small'>";
								echo"<div class='text-right'>";
								echo"<a class='btn btn-main' href='#reviews-anchor' id='open-review-box'>Leave a Review</a>";
								echo"</div>";
								echo"<input type='hidden' id='userchecking' value='$status'>";
								echo"<div class='row' id='post-review-box' style='display:none;'>";
								echo"<form accept-charset='UTF-8' action='review.php' method='post' id='formid'>";
								
	                            echo"<input type='hidden' id='empid' name='empid' value='$id'>";
	                            echo"<input id='ratings-hidden' name='rating' type='hidden'>"; 
	                            echo"<textarea class='span3' cols='50' id='new-review' name='comment' placeholder='Enter your review here...' rows='5'></textarea>";
	                            echo"<div class='text-right'>";
	                            echo"<div class='stars starrr' data-rating='0'></div>";
	                            echo"<a class='btn btn-inverse btn-sm' href='#' id='close-review-box' style='display:none; margin-right: 10px;'>";
	                            echo"<i class='icon-remove'></i>Cancel</a>";
	                            echo"<button class='btn btn-main' name='submit' id='submit' type='submit'>Save</button>";
	                            echo"</div>";
	                            echo"</form>";
	                            echo"</div>";
							    echo"</div>";
								
								echo"</div>";
								echo"</div>"; 

							?>
					        
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
		$('#asignpd').text("sign out");
		var index= "../index.html?user="+user;
		var features= "../features.html?user="+user;
		var contact= "../contact.html?user="+user;
		var indexchange = "../index.html";
		var featchange = "../features.html";
		var contchange ="../contact.html";
		$('#auser').text(user);
		$('#aindexpd').attr("href",index);
		$('#afeatpd').attr("href",features);
		$('#acontactpd').attr("href",contact);
		$('#alogopd').attr("href",index);
		$('#asignpd').click(function (e){
		  e.preventDefault();
         $('#asignpd').text("sign in");
         $('#asignpd').attr("href","#");
         $('#auser').html(null);
         $('#aindexpd').attr("href",indexchange);
		$('#afeatpd').attr("href",featchange);
		$('#acontactpd').attr("href",contchange);
		$('#alogopd').attr("href",indexchange);
		});
    }
})

</script>
<script>$('#widget').draggable();</script>
<!-- End JS Link -->
</body>
</html>