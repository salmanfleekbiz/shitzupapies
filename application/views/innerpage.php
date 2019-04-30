<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php require_once('front_head_inc.php'); ?>
<?php if($footer_menu_found == 0) { ?>
<title><?php echo ucwords(str_replace('-', ' ' ,$fetch_url[0]['page_name'])); ?></title>
<?php } else { ?>
<title><?php echo $page_data[0]['page_title']; ?></title>
<meta name="description" content="<?php echo ucwords(str_replace('-', ' ' ,$page_data[0]['metadescrip'])); ?>"/>
<meta name="keywords" content="<?php echo ucwords(str_replace('-', ' ' ,$page_data[0]['metakeyword'])); ?>"/>
<?php } ?>
</head>
<body>
<?php if($footer_menu_found == 0) { ?>
<div class="hidetopmenu">	
<?php require_once('front_menu.php'); ?>
</div>
<div class="menubar">
<i class="fa fa-bars"></i>
</div>
<script>
$( document ).ready(function() {
var check = '0';
var windowwidth = $( window ).width();
if(windowwidth <= '750'){
$('.hidetopmenu').show();
} else {
$('.hidetopmenu').hide();
}
$('.menubar').click(function(){
if(check == '0'){
$('.hidetopmenu').show("slow");	
check = '1';
} else {
$('.hidetopmenu').hide("slow");
check = '0';
}
});
});
</script>
<?php } else if($footer_menu_found == 1) { require_once('front_menu.php'); } else { require_once('front_menu.php'); } 
if($footer_menu_found == 0) {
?>
<section class="slider_wrap">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h4 class="title"><?php echo ucwords(str_replace('-', ' ' ,$fetch_url[0]['page_name'])); ?></h4>
<div id="carousel-slider" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<?php 
$pix = explode(",",$fetch_url[0]['banner']);
$i = 0;
foreach ($pix as $getData): 
?>
<li data-target="#carousel-slider" data-slide-to="<?php echo $i; ?>"  class="<?php if($i == 0){echo "active"; } ?>"></li>
<?php $i++; endforeach;  ?>
</ol>
<div class="carousel-inner" role="listbox">
<?php 
$pix = explode(",",$fetch_url[0]['banner']);
$j = 0;
foreach ($pix as $getData): 
?>
<div class="item <?php if($j == 0){echo "active"; } ?>">
<img src="<?php echo base_url().'upload/'.$getData?>" alt="" class="center-block">
</div>
<?php $j++; endforeach;  ?>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="puppies">
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-8">
<div class="row">
<?php 
$youtube_url = explode(",",$fetch_url[0]['youtube_url']);
$sex = explode(",",$fetch_url[0]['sex']);
$age = explode(",",$fetch_url[0]['age']);
$ref = explode(",",$fetch_url[0]['ref']);
?>
<?php 
for($i=0; $i<count($youtube_url); $i++ ) {
$img_vide = str_replace("https://www.youtube.com/watch?v=", "", $youtube_url[$i]);
?>
<div class="col-md-4 col-sm-6">
<div class="puppies_wrap">
<div class="img_wrap">
<?php 
$url = $youtube_url[$i];
preg_match(
'/[\\?\\&]v=([^\\?\\&]+)/',
$url,
$matches
);
$id = $matches[1];
?>
<script>
$(window).resize(function(){
var windowwidth = $( window ).width();
var windowheight = $( window ).height();
});
$(document).ready(function(){
windowwidth = $( window ).width();
windowheight = $( window ).height();
if(windowwidth <= 768) {
$(".youtube<?php echo $i; ?>").colorbox({iframe:true, innerWidth:(windowwidth-110), height:'400px'});
} else {
$(".youtube<?php echo $i; ?>").colorbox({iframe:true, innerWidth:(windowwidth-110), height:(windowheight-110)});
}
});
</script>
<a class='youtube<?php echo $i; ?>' href="https://www.youtube.com/embed/<?php echo $id; ?>?rel=0&amp;wmode=transparent">
<img class="img-responsive" src="<?php echo 'http://img.youtube.com/vi/'.$img_vide.'/0.jpg'; ?>" alt=""/>
<span class="youtubeicon"></span>
</a>
</div>
<div class="details_wrap">
<p><span>Sex :	</span><?php echo str_replace('-',' ',$sex[$i]);  ?></p>
<p><span>Age :	</span><?php echo str_replace('-',' ',$age[$i]);  ?></p>
<p><span>Ref : 	</span><?php echo str_replace('-',' ',$ref[$i]);  ?></p>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<div class="col-md-3 col-sm-4">
<div class="keyfacts">
<h4 class="text-center text-uppercase">Key Facts</h4>
<ul>
<?php 
$keynotes = explode(",,,,",$fetch_url[0]['keynotes']);
foreach ($keynotes as $getData): 
?>
<li><?php echo str_replace('-',' ',$getData); ?>.</li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>
</div>
</section>
<section class="description">
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-8">
<h4 class="text-uppercase title">Description</h4>
<p><?php echo ucwords(str_replace('-', ' ' ,$fetch_url[0]['description'])); ?></p>
</div>
<div class="col-md-3 col-sm-4">
<div class="desc_cont_det">
<ul>
<li>
<a role="button" data-toggle="collapse" href="#collapsephn" aria-expanded="false" aria-controls="collapsephn">
<i class="fa fa-mobile fa-2x"></i> Call Now
</a>
<div class="collapse" id="collapsephn">
<form method="post" action="" id="page_contact1" name="page_contact1">
<a href="tel:<?php echo ($fetch_url[0]['tel'] == '' ? ucwords(str_replace('-', ' ' ,$fetch_user[0]['phone'])) : ucwords(str_replace('-', ' ' ,$fetch_url[0]['tel'])) ); ?>">
<?php echo ($fetch_url[0]['tel'] == '' ? ucwords(str_replace('-', ' ' ,$fetch_user[0]['phone'])) : ucwords(str_replace('-', ' ' ,$fetch_url[0]['tel'])) ); ?>&nbsp;&nbsp;<img src="<?php echo base_url(); ?>userfrontassest/img/callcenteragent.png" width="20px">
</a>
</form>
</div>
</li>
<li>
<script>
$(document).ready(function(){
$(".inline").colorbox({inline:true, width:"90%", height:"680px;"});
});
</script>
<a href="#collapseemail" class="inline">
<i class="fa fa-envelope"></i> Send Message
</a>
<div style='display:none'>
<div id='collapseemail' style='padding:10px; background:#fff;' class="">
<form name="page_contact" id="page_contact" action="" method="post">
<input type="hidden" name="pageowneremail" id="pageowneremail" value="<?php echo ($fetch_url[0]['email'] == '' ? ucwords(str_replace('-', ' ' ,$fetch_user[0]['email'])) : ucwords(str_replace('-', ' ' ,$fetch_url[0]['email'])) ); ?>">
<input type="hidden" name="pageid" id="pageid" class="col-md-12" placeholder="" value="<?php echo $fetch_url[0]['page_id']; ?>">
<input type="text" name="fullname" id="fullname" class="col-md-12" placeholder="Full Name">
<input type="email" name="email" id="email" class="col-md-12" placeholder="Email">
<input type="tel" name="phone" id="phone" class="col-md-12" placeholder="Phone #">
<textarea class="col-md-12" placeholder="Message" id="message" name="message"></textarea>
<input type="submit" id="submitform" name="submitform" class="submitbtn" >
</form>
<div id="form_message"></div>
</div>
</div>
</li>
<li>
<?php 
$getuserurl = $fetch_user[0]['social_link'];
$getpageurl = $fetch_url[0]['sociallink'];
if(substr($getuserurl,0,7) == 'http://'){
	
	$userurl = $fetch_user[0]['social_link'];
} else {
	$userurl = 'http://'.$fetch_user[0]['social_link'];
}

if($getpageurl != '' && substr($getpageurl,0,7) == 'http://'){
	
	$pageurl = $fetch_url[0]['sociallink'];
	
	//echo '<span style="display:none">'.$fetch_url[0]['sociallink'].'</span>';	

} else {
	$pageurl = 'http://'.$fetch_url[0]['sociallink'];
}

?>
<a href="<?php echo ($fetch_url[0]['sociallink'] == '' && $fetch_user[0]['social_link'] == '' ? 'http://www.aliymo.com/peturl' : ($fetch_url[0]['sociallink'] == '' ? $userurl : $pageurl )); ?>" target="_blank"><i class="fa fa-share-alt"></i> Social</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</section>
<section class="googlemap">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgjyhsSqkxUjzT4fRN5IeEgFk-p5O16NE&callback=initMap" async defer></script>
<script>
function initMap() {
var map = new google.maps.Map(document.getElementById('googleMap'), {
zoom: <?php echo ($fetch_user[0]['address_one'] == '' ? '8' : '16'); ?>,
center: {lat: -34.397, lng: 150.644},
scrollwheel: false,
navigationControl: false,
mapTypeControl: false,
scaleControl: false,
draggable: false
});
var geocoder = new google.maps.Geocoder();
var contentString = '<div id="content">'+
'<div id="siteNotice">'+
'</div>'+
'<h6 id="firstHeading" class="firstHeading">Location</h6>'+
'<div id="bodyContent">'+
'<p><?php echo ($fetch_user[0]['address_one'] == '' ? '' : $fetch_user[0]['address_one'].',').$fetch_user[0]['city'].','.$fetch_user[0]['post_code']; ?></p>'+
'</div>'+
'</div>';
var infowindow = new google.maps.InfoWindow({
content: contentString	
});
geocodeAddress(geocoder, map, infowindow);
}
function geocodeAddress(geocoder, resultsMap, infowindow) {
var address = '<?php echo ($fetch_user[0]['address_one'] == '' ? '' : $fetch_user[0]['address_one'].',').$fetch_user[0]['city'].','.$fetch_user[0]['post_code']; ?>';
geocoder.geocode({'address': address}, function(results, status) {
if (status === google.maps.GeocoderStatus.OK) {
resultsMap.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: resultsMap,
position: results[0].geometry.location,
});
infowindow.open(resultsMap, marker);
} else {
alert('Geocode was not successful for the following reason: ' + status);
}
});
}
</script>
<div id="googleMap" style="width:100%;height:420px;"></div>
</section>
<section class="content_brief">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php echo ($fetch_breed[0]['description'] == 'undefined' ? '#' : html_entity_decode(str_replace('-', ' ' ,$fetch_breed[0]['description']))); ?>
</div>
</div>
</div>
</section>
<?php
} else {
foreach($page_data as $pagdata):
?>
<section class="slider_wrap">
<div class="container">
<h1><?php echo $pagdata['page_title']; ?></h1>	
</div>
</section>
<section class="puppies">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php echo $pagdata['page_content']; ?>
</div>
</div>
</div>
</section>
<?php endforeach; }	?>
<?php require_once('front_footer.php'); ?>
<script>
$("#page_contact").validate({
rules: {
fullname:"required",
email:"required",
phone:"required",
message: "required"
},
messages: {
fullname: "Enter Full Name",
email: "Enter Your Email",
phone: "Enter Phone number",
message: "Enter Your Message"
},
submitHandler: function() {
contactuser();
}
})
</script>
<script>
var windowwidth = $( window ).width();
if(windowwidth <= 700){
$('.navbar-header > a').hide();	
$('.navbar.navbar-default').css('background-color', '#72B317');
$('.navbar.navbar-default').css('border' , 'none');
var i = 0;
$(".navbar-toggle.collapsed").click(function(){ 
if(i==0){
$('.navbar-header > a').show();	
i = 1;
$('.navbar.navbar-default').removeAttr('style');
}
else if(i==1){
$('.navbar-header > a').hide();	
i = 0;
$('.navbar.navbar-default').css('background-color', '#72B317');
$('.navbar.navbar-default').css('border' , 'none');
}
});
}	
</script>
</body>
</html>