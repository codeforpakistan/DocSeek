// JavaScript Document
var url = "ajax/ajax.php?id1=";
function handleHttpResponse() {
	if (http.readyState == 4) {
		results = JSON.parse(http.responseText);
	}
}
function populateData() {
    var idValue = document.getElementById("id1").value;
    var myRandom=parseInt(Math.random()*99999999);  // cache buster
    http.open("GET", url + escape(idValue) + "&rand=" + myRandom, true);
    http.onreadystatechange = handleHttpResponse;
    http.send(null);
}
function getHTTPObject() {
  var xmlhttp;
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}
var http = getHTTPObject(); // We create the HTTP Object