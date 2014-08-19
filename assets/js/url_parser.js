$(document).ready(function(){
 $(function(){
$.urlparam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return results[1] || 0;
}

var username= $.urlparam('user');
var index= "index.html?user="+username;
var logo = "index.html?user="+username;
var features = "features.html?user="+username;
var contact = "contact.html?user="+username;
//var sign = "sign_in.html?user="+username;
var index_S ="index.html";
var features_S = "features.html";
var contact_S = "contact.html"

$('#aindex').attr("href",index);
$('#afeatures').attr("href",features);
$('#acontact').attr("href",contact);
$('#alogo').attr("href",logo);
$('#aindexF').attr("href",index);
$('#afeaturesF').attr("href",features);
$('#acontactF').attr("href",contact);
$('#aindexc').attr("href",index);
$('#afeaturesc').attr("href",features);
$('#acontactc').attr("href",contact);
$('#aindexS').attr("href",index);
$('#afeaturesS').attr("href",features);
$('#acontactS').attr("href",contact);
$('#alogoF').attr("href",logo);
$('#alogoc').attr("href",logo);
$('#alogoS').attr("href",logo);



$('#achange').text("sign out");
$('#asign_inF').text("sign out");
$('#asign_inc').text("sign out");
$('#asign_inS').text("sign out");

$(document).ready(function(){
	$('#getusername').val(username);
    
	$('#agetuser').text(username);
});
if(username)
{
	 var signout = "sign_in.html";
    $('#achange').click(function (e) {
      $('#achange').attr("href",index_S);
    });
    $('#asign_inc').click(function (e) {
      $('#asign_inc').attr("href",contact_S);
    });
    $('#asign_inF').click(function (e) {
      $('#asign_inF').attr("href",features_S);
    });
    $('#asign_inS').click(function (e) {
      $('#asign_inS').attr("href",signout);
    });
}

});
});

