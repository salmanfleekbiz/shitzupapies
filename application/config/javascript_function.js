function userlogin(){
$('.loadinghide').show();
var action = 'userlogin';
var useremail = $('#useremail').val();
var userpassword = $('#userpassword').val();
var userremember = $('#userremember:checked').val();
$.ajax({
url: baseUrl+"userlogin/process",
data: {action:action,useremail:useremail,userpassword:userpassword,userremember:userremember},
type: 'POST',
success: function (result) {
	$('.loadinghide').hide();
	if(result == "pass") {
		window.location = baseUrl+'dashboard';
	} else {
		document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Login Failed.</div>';	
	}
},
error: function(){
	$('.loadinghide').hide();
}
});
}


function forgotpass(){
$('.loadinghide').show();
var useremail = $('#forgotemail').val();
$.ajax({
url: baseUrl+"userlogin/forgotpass",
data: {useremail:useremail},
type: 'POST',
success: function (result) {
	$('.loadinghide').hide();
	if(result == "pass") {
		window.location = baseUrl+'dashboard';
	} else {
		document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Login Failed.</div>';	
	}
},
error: function(){
	$('.loadinghide').hide();
}
});
}


//frontend Data fetch
function fetchbreed() {
var petid = $('#petstype').val();
jQuery.ajax({
url : baseUrl+'usersignup/petid',
data: {petid:petid},
timeout: 10000,
type: 'POST',
success : function(data) {
$("#breedresult").html(data);
},
error: function(){
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
});
}


//Edit Page Data fetch
function edit_fetchbreed() {
var petid = $('#petstype').val();
jQuery.ajax({
url : baseUrl+'userhome/petid',
data: {petid:petid},
timeout: 10000,
type: 'POST',
success : function(data) {
$("#breedresult").html(data);
},
error: function(){
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
});
}


// Check Url
function check_url() {	
var url = $('#pagename').val();
var email = $('#email').val();
jQuery.ajax({
url : baseUrl+'userhome/urlcheck',
data: {url:url},
timeout: 10000,
type: 'POST',
success : function(data) {
$("#pageurl").val(baseUrl+data);
$("#stepthree_pagename").html(url);
$("#stepthree_pageurl").html(data);
$("#paypal_item_name").val(baseUrl+data);
$('#paypal_return_url').val(baseUrl+'usersignup/paymentcomplete?url='+data+'&&email='+email);
},
error: function(){
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
});
}




// Edit Check url
function edit_check_url() {	
var url = $('#pagename').val();
jQuery.ajax({
url : baseUrl+'userhome/urlcheck',
data: {url:url},
timeout: 10000,
type: 'POST',
success : function(data) {
$("#pageurl").val(baseUrl+data);
$("#stepthree_pagename").html(url);
$("#stepthree_pageurl").html(data);
$("#paypal_item_name").val(baseUrl+data);
$('#paypal_return_url').val(baseUrl+'dashboard/paymentcomplete?url='+data);
},
error: function(){
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
});
}


// Edit Page
function edit_page() {
window.scrollTo(0, 0);
$('.loadinghide').show();

var pagename = $('#pagename').val();
var pageurl = $('#pageurl').val();
var petstype = $('#petstype').val();
var breed = $('#breed').val();
var url = $(".pageurl").map(function() {
return this.value;
}).get();
var sex = $(".sex").map(function() {
return this.value;
}).get();
var age = $(".age").map(function() {
return this.value;
}).get();
var ref= $(".ref").map(function() {
return this.value;
}).get();
var keynotes= $(".keynotes").map(function() {
return this.value;
}).get().join(',,,,');
var desc = $('#desc').val();
var data1 = new FormData();
var count = $('input[name="banner[]"]').length;
for(i=0; i<count; i++) {
$.each($('input[name^="banner"]')[i].files, function(j, file) {
    data1.append('banner[]', file);
});
}
var pageid = $('#pageid').val();
data1.append("pagename",pagename);
data1.append("pageurl", pageurl);
data1.append("petstype", petstype);
data1.append("breed", breed);
data1.append("url", url);
data1.append("sex", sex);
data1.append("age", age);
data1.append("ref", ref);
data1.append("keynotes", keynotes);
data1.append("desc", desc);
data1.append("pageid", pageid);

jQuery.ajax({
url : baseUrl+'dashboard/editnewpage',
data : data1,
enctype: 'multipart/form-data',
processData: false,  // tell jQuery not to process the data
contentType: false ,  // tell jQuery not to set contentType
type: 'POST',
success : function(data) {
$('.loadinghide').hide();
if(data == "pass") {
document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Update Successfully.</div>';	

} else if(data == "already")  {
document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Email Already Register.</div>';	
}else {
document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Please try again.</div>';	
}
},
error: function(){
$('.loadinghide').hide();	
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
}); 

}




//Create Newpage
function createnewpages() {
$('.loadinghide').show();
var pagename = $('#pagename').val();
var pageurl = $('#pageurl').val();
var petstype = $('#petstype').val();
var breed = $('#breed').val();
var url = $(".pageurl").map(function() {
return this.value;
}).get();
var sex = $(".sex").map(function() {
return this.value;
}).get();
var age = $(".age").map(function() {
return this.value;
}).get();
var ref= $(".ref").map(function() {
return this.value;
}).get();
var keynotes= $(".keynotes").map(function() {
return this.value;
}).get().join(',,,,');
var desc = $('#desc').val();
var data1 = new FormData();
var count = $('input[name="banner[]"]').length;
for(i=0; i<count; i++) {
$.each($('input[name^="banner"]')[i].files, function(j, file) {
    data1.append('banner[]', file);
});
}
data1.append("pagename",pagename);
data1.append("pageurl", pageurl);
data1.append("petstype", petstype);
data1.append("breed", breed);
data1.append("url", url);
data1.append("sex", sex);
data1.append("age", age);
data1.append("ref", ref);
data1.append("keynotes", keynotes);
data1.append("desc", desc);

jQuery.ajax({
url : baseUrl+'dashboard/createnewpage',
data : data1,
enctype: 'multipart/form-data',
processData: false,  // tell jQuery not to process the data
contentType: false ,  // tell jQuery not to set contentType
type: 'POST',
success : function(data) {
$('.loadinghide').hide();
if(data == "pass") {
$('#paypal_form_submit').click();
} else if(data == "already")  {
document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Email Already Register.</div>';	
}else {
document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Please try again.</div>';	
}
},
error: function(){
$('.loadinghide').hide();	
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
}); 
}


// Signup form 
function submitform() {
window.scrollTo(0, 0);
$('.loadinghide').show();
	
var fname = $('#fname').val();
var lname = $('#lname').val();
var email = $('#email').val();
var telephone = $('#telephone').val();
var password = $('#password').val();
var address1 = $('#address1').val();
var address2 = $('#address2').val();
var city = $('#city').val();
var postcode = $('#postcode').val();
var country = $('#country').val();
var region = $('#region').val();
var aliymo = $('#aliymo').val();
var pagename = $('#pagename').val();
var pageurl = $('#pageurl').val();
var petstype = $('#petstype').val();
var breed = $('#breed').val();
var url = $(".pageurl").map(function() {
return this.value;
}).get();
var sex = $(".sex").map(function() {
return this.value;
}).get();
var age = $(".age").map(function() {
return this.value;
}).get();
var ref= $(".ref").map(function() {
return this.value;
}).get();
var keynotes= $(".keynotes").map(function() {
return this.value;
}).get().join(',,,,');
var desc = $('#desc').val();
var data1 = new FormData();
var count = $('input[name="banner[]"]').length;
for(i=0; i<count; i++) {
$.each($('input[name^="banner"]')[i].files, function(j, file) {
    data1.append('banner[]', file);
});
}
data1.append("fname", fname);
data1.append("lname", lname);
data1.append("email", email);
data1.append("telephone", telephone);
data1.append("password", password);
data1.append("address1",address1);
data1.append("address2",address2);
data1.append("city",city);
data1.append("postcode",postcode);
data1.append("country",country);
data1.append("region",region);
data1.append("aliymo",aliymo);
data1.append("pagename",pagename);
data1.append("pageurl", pageurl);
data1.append("petstype", petstype);
data1.append("breed", breed);
data1.append("url", url);
data1.append("sex", sex);
data1.append("age", age);
data1.append("ref", ref);
data1.append("keynotes", keynotes);
data1.append("desc", desc);

jQuery.ajax({
url : baseUrl+'usersignup/insert',
data : data1,
enctype: 'multipart/form-data',
processData: false,  // tell jQuery not to process the data
contentType: false ,  // tell jQuery not to set contentType
type: 'POST',
success : function(data) {
$('.loadinghide').hide();
if(data == "pass") {
		$('#paypal_form_submit').click()
	} else if(data == "already")  {
		document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Email Already Register.</div>';	
	}else {
		document.getElementById('error').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Please try again.</div>';	
	}
},
error: function(){
$('.loadinghide').hide();	
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
}); 
}



// Update Profile 
function profile_update() {

var fname = $('#fname').val();
var lname = $('#lname').val();
var email = $('#email').val();
var telephone = $('#telephone').val();
var password = $('#password').val();
var address1 = $('#address1').val();
var address2 = $('#address2').val();
var city = $('#city').val();
var postcode = $('#postcode').val();
var country = $('#country').val();
var region = $('#region').val();
var aliymo = $('#aliymo').val();

$('.loadinghide').show();

jQuery.ajax({
url : baseUrl+'profile/updateprofile',
data : {fname:fname,lname:lname,email:email,telephone:telephone,password:password,address1:address1,address2:address2,city:city,postcode:postcode,country:country,region:region,aliymo:aliymo},
type: 'POST',
success : function(data) {
	$('.loadinghide').hide();
if(data == "pass") {
		document.getElementById('message').innerHTML='<div class="alert alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Successfully Updated</div>';	
	} else {
		document.getElementById('message').innerHTML='<div class="alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error please try again.</div>';	
	}
},
error: function(){
	$('.loadinghide').hide();
$('#fountainTextG').hide();
showMessage('#fff', '#000000', 'There is a some error please again latter');
}
}); 
}
