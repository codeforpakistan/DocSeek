$(document).ready(function($) {
	  Toggle();
    Flexslider();
    Priceslider();
    CustomScrollbar();
    Panoramma();
    Menu();
    Map();
    SendEnquiry();
});	
function Menu(){
  // menu 
    var current_width = $(window).width();
    if(current_width > 979){
    	$(window).bind('scroll', function() {
			if ($(window).scrollTop() > 10) {
    			$('#menu-wrapper').addClass('menu-fixed');
        		$('.home-logo').addClass('logo-resized');
  			} else {
    			$('#menu-wrapper').removeClass('menu-fixed');
    			$('.home-logo').removeClass('logo-resized');
  			}
		});
    }

    $(window).resize(function(){
      /*If browser resized, check width again */
    	var current_width = $(window).width();
  	    	if(current_width < 979){
            	$(window).bind('scroll', function() {
  					if ($(window).scrollTop() > 10) {
    					$('#menu-wrapper').removeClass('menu-fixed');
    				} 
				});
            }
      		if(current_width > 979){
       			$(window).bind('scroll', function() {
  					if ($(window).scrollTop() > 10) {
    					$('#menu-wrapper').addClass('menu-fixed');
        				$('.home-logo').addClass('logo-resized');
  					} else {
    					$('#menu-wrapper').removeClass('menu-fixed');
    					$('.home-logo').removeClass('logo-resized');
  					}
				});
    		}
  		});
 } 
function Flexslider(){
 //flex slider carousel options in home page
  $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        itemWidth: 180,
        itemMargin: 0,
        asNavFor: '#slider'
    });
  //flex slider  options in home page
   $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        sync: "#carousel",
        directionNav: false
      });
    //flex slider carousel options in single property page
  $('#single-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 180,
        itemMargin: 0,
        asNavFor: '#single-slider'
      });
      //flex slider options in single property page
      $('#single-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#single-carousel",
     directionNav: false
       
      });  
	    //home slider options in index second page
      $('.home_slider').flexslider({
        animation: "slide",
        controlNav: true,
        animationLoop: true,
        slideshow: true,
        directionNav: false
       
      });  
}


function Priceslider(){
  //price slider in siderbar
  $( "#slider-range" ).slider({
      range: true,
      min: 7500,
      max: 50000,
      values: [ 12000, 46000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
}
 
function CustomScrollbar(){
  // custom scrollbar in home page new listings
  $(".listings_area").mCustomScrollbar({
          scrollInertia:600,
          autoDraggerLength:false
        });
}

function Toggle(){
 // Apply Toggle to change rent or buy option
  $('.toggle').toggles({clicker:$('.clickme')});
}
 
function Panoramma(){
  // Apply PrettyPhoto for video gallery and image gallery
  $("a[rel^='prettyPhoto']").prettyPhoto();
  // Apply Panoramma in single property page
   $(".cycle img").panorama();

}

function HomepageMap() {
  //place the latitude and longitude for your properties
  var locations = new Array(
        [34.0149748,71.5804899], [33.9975025,71.4863849], [34.0112829,71.5689054], [34.0149748,71.5804899], [33.9998219,71.4853261], [33.9995413,71.4838955],
        [34.0149748,71.5804899], [34.0065771,71.5918912], [33.9922963,71.43596679999996] , [33.9941312,71.43576619999999], [34.0028029,71.53864079999994] ,[33.9976827,71.46557009999992] );
  var ptype=new Array('apartment','villa','apartment','land','villa','apartment','land','villa','apartment','villa','land','apartment','villa','land','apartment');//property type values
  var pstatus=new Array('buy','rent','rent','buy','rent','buy','buy','rent','buy','rent','buy','buy','rent','buy','rent');//property status values
  var markers = new Array();
  var mapOptions = {
    center: new google.maps.LatLng(34.0024301,71.52116780000006),
    zoom: 14,
    draggable: true,
    icon:'assets/img/icons/marker-rent.png',
    mapTypeId: google.maps.MapTypeId.ROADMAP,
     };

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var status;
    $.each(locations, function(index, location) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(location[0], location[1]),
            map: map,
            icon: 'assets/img/marker-transparent.png',

             });
        //setting data for information window
      var myOptions = {
          content: '<div class="map-data-details"><div class="map-data-head clearfix"><div class="map-data-loct">Hospital name</div><div class="map-data-price">Peshawar</div></div><div class="map-cont"><div class="map-image"><img src="assets/img/map-imge.png" alt="image" /></div><div class="map-cont-descr"></div></div><div class="map-contact"><a href="single.html" class="btn btn-large btn-main">Read more</a><a  id="contact"  class="btn btn-large btn-main pretty">Send Enquiry</a></div><div class="map-marker"></div></div>',//content for information window
          disableAutoPan: false,
          maxWidth: 0,
          pixelOffset: new google.maps.Size(-250, -400),
          zIndex: null,
          closeBoxURL: "assets/img/close-map.png",
          infoBoxClearance: new google.maps.Size(1, 1),
          position: new google.maps.LatLng(location[0], location[1]),
          isHidden: false,
          pane: "floatPane",
          enableEventPropagation: false
      };
      marker.infobox = new InfoBox(myOptions);
    marker.infobox.isOpen = false;
     google.maps.event.addDomListener(marker.infobox, 'domready', function() {
    $('.pretty').click(function() {
    $('#quick-contact').modal('show');
    });

    });
     //setting marker data
      var myOptions = {
          draggable: true,
      content: '<div class="marker-'+ptype[index]+'-'+pstatus[index]+'"><div class="marker-inner"></div></div>',
      disableAutoPan: true,
      pixelOffset: new google.maps.Size(-21, -58),
      position: new google.maps.LatLng(location[0], location[1]),
      closeBoxURL: "",
      isHidden: false,
      pane: "floatPane",
      enableEventPropagation: false
      };
      marker.marker = new InfoBox(myOptions);
      marker.marker.isHidden = false;
      marker.marker.open(map, marker);
      markers.push(marker);
    
        google.maps.event.addListener(marker, "click", function (e) {
            var curMarker = this;
            $.each(markers, function (index, marker) {
                // if marker is not the clicked marker, close the marker
                if (marker !== curMarker) {
                    marker.infobox.close();
                    marker.infobox.isOpen = false;
                }
            });


            if(curMarker.infobox.isOpen === false) {
                curMarker.infobox.open(map, this);
                curMarker.infobox.isOpen = true;
               map.panTo(this.position);
            } else {
                curMarker.infobox.close();
                curMarker.infobox.isOpen = false;
            }

        });
      
    });
   var markerCluster = new MarkerClusterer(map, markers,{
            styles: [
                {
                    height: 51,
                    url: 'assets/img/icons/cluster-bg.png',
                    width: 49,
                    textColor: '#333',
                   
                }
            ]
        });

                    google.maps.event.addListener(map, 'zoom_changed', function() {
                        $.each(markers, function(index, marker) {
                            marker.infobox.close();
                            marker.infobox.isOpen = false;
                        });
                    });

                    var previousClusters = new Array();
                    google.maps.event.addListener(markerCluster, 'clusteringend', function(clusterer) {
                        $.each(previousClusters, function(index, previousCluster) {
                            previousCluster.cluster.close();
                        });

                        previousClusters = new Array();

                        $.each(clusterer.getClusters(), function(index, currentCluster) {
                            if (this.getMarkers().length > 1) {

                                $.each(this.getMarkers(), (function() {
                                    if (this.marker.isHidden == false) {
                                        this.marker.isHidden = true;
                                        this.marker.close();
                                    }
                                }));

                                var myOptions = {
                                    draggable: true,
                                    content: '<div class="clusterer"><div class="clusterer-inner"></div></div>',
                                    disableAutoPan: true,
                                    pixelOffset: new google.maps.Size(-21, -21),
                                    position: this.getCenter(),
                                    closeBoxURL: "",
                                    isHidden: false,
                                    enableEventPropagation: true
                                };

                                this.cluster = new InfoBox(myOptions);
                                this.cluster.open(map, this.marker);
                                previousClusters.push(this);
                            } else {
                                $.each(this.getMarkers(), (function() {
                                    if (this.marker.isHidden == true) {
                                        this.marker.open(map, this);
                                        this.marker.isHidden = false;
                                    }
                                }));
                            }
                        });
                    });
}

function Tab(){
  //Tabs in single property page
  $(".tab_content").hide();
  $("ul.tabs li:first").addClass("active").show(); 
  $(".tab_content:first").show(); 

  $("ul.tabs li").click(function() {
  $("ul.tabs li").removeClass("active");
  $(this).addClass("active"); 
  $(".tab_content").hide(); 
  var activeTab = $(this).find("a").attr("href"); 
  $(activeTab).fadeIn();
    if(activeTab == '#tab1') {      
      $(window).resize(function(){
      }); 
    } 
    return false;
  });

  initializePlace();//initialize map with nearest places

  $("#placemap").click(function() {
  $("#tab3").css({'display':'block'});
  $("#map_canvas-n").css({'height':'385px'});
  initializePlace();
   });

  initializeRoadmap();//initialize road map 

  $("#roadmap").click(function() {
  $("#tab1").css({'display':'block'});
  $("#map_canvas").css({'width':'100%', 'height':'400px'});
        initializeRoadmap();
  });

  initializePanorama();//initialize 360 degree panorama

  $("#panoramamap").click(function() {
  $("#tab2").css({'display':'block'});
  $("#map_canvas1").css({'width':'100%', 'height':'400px'});
        initializePanorama();
  });
 
}

function initializePanorama() {
  var fenway = new google.maps.LatLng(53.190916,-2.8916);//place latitude and longitude for 360 degree panorama
  var mapOptions = {
    center: fenway,
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(
      document.getElementById('map-canvas1'), mapOptions);
  var panoramaOptions = {
    position: fenway,
    pov: {
      heading: 34,
      pitch: 10
    }
  };
  var panorama = new  google.maps.StreetViewPanorama(document.getElementById('pano'),panoramaOptions);
  map.setStreetView(panorama);
}

function initializeRoadmap() {
        var myLatlng = new google.maps.LatLng(53.190916,-2.8916);//place latitude and longitude for road map
        var myOptions = {
          zoom: 14,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
      var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        
        var contentString = '<div id="content">'+
            '<h3>7 East 53rd Street</h3>'+
            '<div>'+
            '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an </p>'+
            '<p> <a href="#">'+
            'London</a></p>'+
            '</div>'+
            '</div>';
    
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 300
        });
    
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Victoria Crescent, Queens Park, Chester'
        });
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map,marker);
        });
    
      }

  var map, places, iw;
  var markers = [];
  var searchTimeout;
  var centerMarker;
  var autocomplete;
  var hostnameRegexp = new RegExp('^https?://.+?/');

  function initializePlace() {
    var myLatlng = new google.maps.LatLng(53.190916,-2.8916);//place latitude and longitude for finding nearest places
    var myOptions = {
      zoom: 14,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map_canvas-n'), myOptions);
    places = new google.maps.places.PlacesService(map);
    google.maps.event.addListener(map, 'tilesloaded', tilesLoaded);
    var typeSelect = document.getElementById('type');
    typeSelect.onchange = function() {
      search();
    };
  }

  function tilesLoaded() {
    search();
    google.maps.event.clearListeners(map, 'tilesloaded');
   
  }

  function search() {
    clearResults();
    clearMarkers();

    if (searchTimeout) {
      window.clearTimeout(searchTimeout);
    }
    searchTimeout = window.setTimeout(reallyDoSearch, 500);
  }

  function reallyDoSearch() {      
    var type = document.getElementById('type').value;
    var rankBy ='distance';
    var search = {};
    
    if (type != 'establishment') {
      search.types = [type];
    }
    
    if (rankBy == 'distance' && (search.types)) {
      search.rankBy = google.maps.places.RankBy.DISTANCE;
      search.location = new google.maps.LatLng(53.190916,-2.8916);//place latitude and longitude for finding nearest places
       centerMarker = new google.maps.Marker({
        position: search.location,
        animation: google.maps.Animation.DROP,
        map: map
      });
    } else {
      search.bounds = map.getBounds();
    }
    
    places.search(search, function(results, status) {
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
          var icon = 'assets/img/icons/number_' + (i+1) + '.png';
          markers.push(new google.maps.Marker({
            position: results[i].geometry.location,
            animation: google.maps.Animation.DROP,
            icon: icon
          }));
          google.maps.event.addListener(markers[i], 'click', getDetails(results[i], i));
          window.setTimeout(dropMarker(i), i * 100);
          addResult(results[i], i);
        }
      }
    });
  }

  function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
    markers = [];
    if (centerMarker) {
      centerMarker.setMap(null);
    }
  }

  function dropMarker(i) {
    return function() {
      if (markers[i]) {
        markers[i].setMap(map);
      }
    }
  }

  function addResult(result, i) {
    var results = document.getElementById('results');
    var tr = document.createElement('tr');
    tr.style.backgroundColor = (i% 2 == 0 ? '#F0F0F0' : '#FFFFFF');
    tr.onclick = function() {
      google.maps.event.trigger(markers[i], 'click');
    };

    var iconTd = document.createElement('td');
    var nameTd = document.createElement('td');
    var icon = document.createElement('img');
    icon.src = 'assets/img/icons/number_' + (i+1) + '.png';
    icon.setAttribute('class', 'placeIcon');
    icon.setAttribute('className', 'placeIcon');
    var name = document.createTextNode(result.name);
    iconTd.appendChild(icon);
    nameTd.appendChild(name);
    tr.appendChild(iconTd);
    tr.appendChild(nameTd);
    results.appendChild(tr);
  }

  function clearResults() {
    var results = document.getElementById('results');
    while (results.childNodes[0]) {
      results.removeChild(results.childNodes[0]);
    }
  }

  function getDetails(result, i) {
    return function() {
      places.getDetails({
          reference: result.reference
      }, showInfoWindow(i));
    }
  }

  function showInfoWindow(i) {
    return function(place, status) {
      if (iw) {
        iw.close();
        iw = null;
      }
      
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        iw = new google.maps.InfoWindow({
          content: getIWContent(place)
        });
        iw.open(map, markers[i]);        
      }
    }
  }
  
  function getIWContent(place) {
    var content = '';
    content += '<table>';
    content += '<tr class="iw_table_row">';
    content += '<td style="text-align: right"><img class="hotelIcon" src="' + place.icon + '"/></td>';
    content += '<td><b><a href="' + place.url + '">' + place.name + '</a></b></td></tr>';
    content += '<tr class="iw_table_row"><td class="iw_attribute_name">Address:</td><td>' + place.vicinity + '</td></tr>';
    if (place.formatted_phone_number) {
      content += '<tr class="iw_table_row"><td class="iw_attribute_name">Telephone:</td><td>' + place.formatted_phone_number + '</td></tr>';      
    }
    if (place.rating) {
      var ratingHtml = '';
      for (var i = 0; i < 5; i++) {
        if (place.rating < (i + 0.5)) {
          ratingHtml += '&#10025;';
        } else {
          ratingHtml += '&#10029;';
        }
      }
      content += '<tr class="iw_table_row"><td class="iw_attribute_name">Rating:</td><td><span id="rating">' + ratingHtml + '</span></td></tr>';
    }
    if (place.website) {
      var fullUrl = place.website;
      var website = hostnameRegexp.exec(place.website);
      if (website == null) { 
        website = 'http://' + place.website + '/';
        fullUrl = website;
      }
      content += '<tr class="iw_table_row"><td class="iw_attribute_name">Website:</td><td><a href="' + fullUrl + '">' + website + '</a></td></tr>';
    }
    content += '</table>';
    return content;
  }



function SendEnquiry(){
  //Send enquiry form 
  $('#contact').click(function() {
    $('#quick-contact').modal('show');
    });
}

function myMap(){

           var location =[
        [34.0149748,71.5804899], [33.9975025,71.4863849], [34.0112829,71.5689054], [34.0149748,71.5804899], [33.9998219,71.4853261], [33.9995413,71.4838955],
        [34.0149748,71.5804899], [34.0065771,71.5918912], [33.9922963,71.43596679999996] , [33.9941312,71.43576619999999], [34.0028029,71.53864079999994] ,[33.9976827,71.46557009999992] ];
          var markers = [];
                    var iterator = 0;

                    var map;
                    var mapOptions = {
                         zoom: 14,
                        center: new google.maps.LatLng(34.0028029,71.53864079999994),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: false
                         };

                   map = new google.maps.Map(document.getElementById('map'),mapOptions);
                  for (var i= 0; i < location.length; i++) {
            markers.push(new google.maps.Marker({
              position: new google.maps.LatLng(location[i][0],location[i][1]),
              map: map,
              icon:'assets/img/icons/marker-rent.png',
              draggable: true,
              animation: google.maps.Animation.DROP
            }));
            iterator++;
          }
}
 function Map() {
  google.maps.event.addDomListener(window, 'load', myMap);
  google.maps.event.addDomListener(window, 'load', Tab);
} 
  