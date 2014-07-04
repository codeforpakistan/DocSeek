<!DOCTYPE Html>
<!--<?php
// session_start();
// if ($_SESSION== NULL)
// {
// 	$lat = NULL;
// 	$lon = NULL;
// }
// else
// {
// 	$lat = $_SESSION['lat'];
// 	$lon = $_SESSION['lon'];
// }
?>-->
<html lang="en">
<head>
	<title>DOC SEEK</title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" >
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="css/grayscale.css">-->
	<link rel="stylesheet" href="doc.css">
	<script  src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIdreDurlXrqiP61Cu6P4yaZch1pKtAyw &sensor=true"></script>

	<script>
	$(document).ready(function(){

		$('#getNearby').click(function (e) {
			e.preventDefault();
			var id1 = $('#id1').val();
           $.ajax({
           	type : "POST",
           	datatype : "json",
           	data : id1,
           	url : "try_doc.php",
           	success: function(data){
           		console.log(data);
           	}
           });
			//$.post("try_doc.php", $("#formid").serialize());
			//alert('hello');
		});
	})
	var watchId = null;
    window.onload = geoloc();
	function geoloc() {


		if (navigator.geolocation) {
			var optn = {
				enableHighAccuracy : true,
				timeout : Infinity,
				maximumAge : 0
			};

			watchId = navigator.geolocation.watchPosition(showPosition, showError, optn);


		} else {
			alert('Geolocation is not supported in your browser');
		}
	}

	function showPosition(position) {
		var googlePos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

		var mapOptions = {
			zoom : 14,
			center : googlePos,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		var mapObj = document.getElementById('mapdiv');
		var googleMap = new google.maps.Map(mapObj, mapOptions);
		var markerOpt = {
			map : googleMap,
			position : googlePos,
			title : 'Hi , I am here',
			animation : google.maps.Animation.DROP
		};
		var googleMarker = new google.maps.Marker(markerOpt);
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'latLng' : googlePos
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[1]) {
					var popOpts = {
						content : results[1].formatted_address,
						position : googlePos
					};
					var popup = new google.maps.InfoWindow(popOpts);
					google.maps.event.addListener(googleMarker, 'click', function() {
						popup.open(googleMap);
					});
				} else {
					alert('No results found');
				}
			} else {
				alert('Geocoder failed due to: ' + status);
			}
		});
		document.getElementById("id1").value=googlePos;
		// window.location.href="try_doc.php?latlon=" + googlePos;
	}

	function stopWatch() {
		if (watchId) {
			navigator.geolocation.clearWatch(watchId);
			watchId = null;

		}
	}

	function showError(error) {
		var err = document.getElementById('mapdiv');
		switch(error.code) {
		case error.PERMISSION_DENIED:
			err.innerHTML = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			err.innerHTML = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			err.innerHTML = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			err.innerHTML = "An unknown error occurred."
			break;
		}
	}
	</script>

</head>

<body  id="page-top" data-spy="scroll" data-target=".navbar-default">
	<p id = "mapdiv"></p>

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
			<div class="collapse navbar-collapse" id="navbar-main-collapse">
                <form action="doc_search.php" method="post" class="navbar-form navbar-left" role="search">
                 <div class="form-group">
                 <input type="text" name="alpha" class="form-control" placeholder="search....">
                 </div>
               </form>
               <ul class="nav navbar-nav navbar-right">
	               	<li class="hidden">
					    <a href="#page-top"></a>
				    </li>
					<li class="page-scroll">
						<a href="#about">About</a>
					</li>
					<li class="page-scroll">
						<a href="#download">Download</a>
					</li>
					<li class="page-scroll">
						<a href="#contact">Team..</a>
					</li>
				</ul>		
		</div>
	</div>
	</nav>
	<div class="field">
		<form action='try_doc.php' method='post' id="formid">
		<input type="hidden" name="id1" id="id1">
		</form>
		<!-- <button id="getNearby" name="Nearest" class="btn btn-primary btn-right">Nearest Hopitals</button> -->
		<a href="#" id="getNearby" class="btn btn-inverse btn-inverse-my"><span class='glyphicon glyphicon-map-marker white'></span>Nearest Hospitals</a>
	</div>
</div>
<section id="about" class="container content-section text-center">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h2><b><i><u>About DocSeek</u></i></b></h2>
			<p>Finding the nearest hospital? Or you want to find doctors? DocSeek is the answer. Wanna do rating? DocSeek is the answer. DocSeek is an application to find nearest hospital in no time. To take appointmnets while sitting at home. To find the best rated hospitals, to check reviews as well as rate the doctors yourself.</p>

		</div>
	</div>
</section>
<section id="download" class="content-section text-center">
	<div class="download-section">
		<div class="container">
			<div class="col-lg-8 col-lg-offset-2">
				<h2><b><i><u>Download DocSeek</u></i></b></h2>
				<p>You can download DocSeek app for free on Google play. You can also get the source code directly from GitHub if you prefer. </p>
				<a href="https://play.google.com/store" class="btn btn-danger btn-lg">Visit Download Page</a>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<section id="contact" class="container content-section text-center">
		<h2><b><i><u>Team DocSeek</u></i></b></h2>

		<div><div class="wsite-multicol"><div class='wsite-multicol-table-wrap' style='margin:0 -15px'>
			<table class='wsite-multicol-table'>
				<tbody class='wsite-multicol-tbody'>
					<tr class='wsite-multicol-tr'>
						<td class='wsite-multicol-col' style='width:33.333333333333%;padding:0 15px'>

							<span class='imgPusher' style='float:left;height:0px'></span><span style='z-index:10;position:relative;float:left;max-width:100%;;clear:left;margin-top:0px;*margin-top:0px'><a><img src="hira.jpg" style="margin-top: 5px; margin-bottom: 10px; margin-left: 0px; margin-right: 10px; border-width:0;" alt="Picture" class="galleryImageBorder wsite-image" /></a><span style="display: block; font-size: 90%; margin-top: -10px; margin-bottom: 10px; text-align: center;" class="wsite-caption"></span></span>

							<div style="text-align:center;display:block; margin-top:170px"><br /><br /><br /><br /><br /><br /><br /><strong><font color="#D64541">Hira Shakeel</font></strong><br /><strong><font color="#3a96b8">Team DocSeek</font></strong><br />Hira Shakeel, a native of the city of Peshawar, is a final year student of &nbsp;Computer Systems Engineering. She believes that it&rsquo;s an empowering field that will allow her to make a difference to society and change it in a positive way. Her main areas of interest are web development (back end, front end), video codecs, C/C++, and Python.<br />Inspired by civic hacking, she and her Fellowship team is creating DocSeek, an application to help people find their nearest medical care providers.</div>
							<hr style="width:100%;clear:both;visibility:hidden;"></hr>

						</td>
						<td class='wsite-multicol-col' style='width:33.333333333333%;padding:0 15px'>

							<span class='imgPusher' style='float:left;height:0px'></span><span style='z-index:10;position:relative;float:left;max-width:100%;;clear:left;margin-top:0px;*margin-top:0px'><a><img src="hina.jpg" style="margin-top: 5px; margin-bottom: 10px; margin-left: 0px; margin-right: 10px; border-width:0;" alt="Picture" class="galleryImageBorder wsite-image" /></a><span style="display: block; font-size: 90%; margin-top: -10px; margin-bottom: 10px; text-align: center;" class="wsite-caption"></span></span>
							<div style="text-align:center;display:block;margin-top:170px"><br /><br /><br /><br /><br /><br /><br /><strong><font color="#D64541">Hina Mahmud</font></strong><br /><span style="line-height: 0; display: none;">&#65279;</span><strong><font color="#3a96b8">Team DocSeek</font></strong><br />Hina is &nbsp;a final year student of Computer Systems Engineering at UET Peshawar. &nbsp;During her engineering education, she has earned vast knowledge in software development and hardware designing. She is an expert web developer, with an amazing esthetic for design.&nbsp; <br /><span style=""></span><br /><span style=""></span><br /></div>
							<hr style="width:100%;clear:both;visibility:hidden;"></hr>

						</td>
						<td class='wsite-multicol-col' style='width:33.333333333333%;padding:0 15px'>

							<span class='imgPusher' style='float:right;height:0px'></span><span style='z-index:10;position:relative;float:right;max-width:100%;;clear:right;margin-top:0px;*margin-top:0px'><a><img src="umer.png" style="margin-top: 5px; margin-bottom: 10px; margin-left: 10px; margin-right: 0px; border-width:0;" alt="Picture" class="galleryImageBorder wsite-image" /></a><span style="display: block; font-size: 90%; margin-top: -10px; margin-bottom: 10px; text-align: center;" class="wsite-caption"></span></span>
							<div style="text-align:center;display:block;margin-top:130px"><br /><br /><br /><br /><br /><br /><br /><strong><font color="#D64541">Umer Farooq</font></strong><br /><strong style=""><font color="#3a96b8">Team DocSeek</font></strong><br />Umer is an Android, C/C++, Java, and Games Developer. He holds a Bachelor's degree in Computer Systems Engineering. He has built web and mobile applications for healthcare in his career. As &nbsp;founder of WinGoku &amp; an Android enthusiast, he has worked on several Android apps, as well as a few OS apps. He loves to help developers on StackOverflow and blog about technology. He is interested in Computer Vision &amp; Machine Learning.<br /><br /></div>
							<hr style="width:100%;clear:both;visibility:hidden;"></hr>

						</td>
					</tr>
				</tbody>
			</table>
		</div></div></div>


		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<ul class="list-inline banner-social-buttons">
					<li><a href="https://www.facebook.com/docseek?ref=br_tf" class="btn btn-primary btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
					</li>
					<li><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
					</li>
					<li><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
					</li>
				</ul>
			</div>
		</div>
	</section>
</div>

<div id="map"></div>

<!-- Core JavaScript Files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


<!-- Custom Theme JavaScript -->
<script src="js/grayscale.js"></script>
</body>
</html>
