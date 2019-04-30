<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php require_once('front_head_inc.php'); ?>
<title>Peturl</title>
</head>
<body>
<div class="loadinghide">
<div class="cssload-clock"></div>
</div>
<?php require_once('front_menu.php'); ?>
<section class="subheader">
<div class="container">
<h4 class="text-uppercase">Profile</h4>
</div>
</section>
<section class="signup">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<form method="post" name="userprofile" id="userprofile" action="#">
<?php
foreach($fetch_dashboard as $user_info):
?>
<div class="panel panel-default">
<div id="stepOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
<div class="panel-body">
<div class="col-md-6">
<h4>Your Personal Details</h4>
<p><label class="required">Email</label>
<input type="text" name="email" id="email" value="<?php echo ($user_info['email'] ? $user_info['email'] : ""); ?>" disabled/></p>
<p><label class="required">Telephone</label>
<input type="text" name="telephone" id="telephone" maxlength="11" value="<?php echo ($user_info['phone'] ? $user_info['phone'] : ""); ?>"/></p>
<p><label class="required">Post Code</label>
<input type="text" name="postcode" id="postcode" maxlength="6" value="<?php echo ($user_info['post_code'] ? $user_info['post_code'] : ""); ?>"/></p>
<p><label>Aliymo</label>
<input type="text" name="aliymo" id="aliymo" value="<?php echo ($user_info['social_link'] ? $user_info['social_link'] : ""); ?>"/></p>
</div>
<div class="col-md-6 gappass">
<h4 class="hideinmobile">&nbsp;</h4>
<p class="passfield"><label class="">Create New Password </label>
<input type="password" name="cpassword" id="cpassword"/></p>
<p class="passfield"><label class="">Confirm New Password</label>
<input type="password" name="password" id="password"/></p>
<p class="passfield"><label class="">Verify Old Password</label>
<input type="password" name="oldpassword" id="oldpassword"/></p>



</div>
<div class="col-md-12">
<p><button type="button" name="passbutton" id="passbutton" class="btn center-block updatepass">Update Password</button></p>
<p><button type="submit" name="butonfirst" id="butonfirst" class="btn center-block">Update Profile</button>
</p>
<div class="col-md-12" id="message">
</div>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</form>
</div>
<?php } else { ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<form method="post" name="userprofile" id="userprofile" action="#">
<?php foreach($fetch_dashboard as $user_info): ?>
<div class="panel panel-default">
<div id="stepOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
<div class="panel-body">
<div class="col-md-6">
<h4>Your Personal Details</h4>
<p><label class="required">Email</label>
<input type="text" name="email" id="email" value="<?php echo ($user_info['email'] ? $user_info['email'] : ""); ?>" disabled/></p>
<p><label class="required">Telephone</label>
<input type="text" name="telephone" id="telephone" maxlength="11" value="<?php echo ($user_info['phone'] ? $user_info['phone'] : ""); ?>"/></p>
<p class="passfield"><label class="">Create New Password </label>
<input type="password" name="cpassword" id="cpassword"/></p>

<p class="passfield"><label class="">Verify Old Password </label>
<input type="password" name="oldpassword" id="oldpassword"/></p>

</div>
<div class="col-md-6">
<h4 class="hideinmobile">&nbsp;</h4>
<p><label class="required">Post Code</label>
<input type="text" name="postcode" id="postcode" maxlength="6" value="<?php echo ($user_info['post_code'] ? $user_info['post_code'] : ""); ?>"/></p>
<p><label>Aliymo</label>
<input type="text" name="aliymo" id="aliymo" value="<?php echo ($user_info['social_link'] ? $user_info['social_link'] : ""); ?>"/></p>
<p class="passfield"><label class="">Confirm New Password</label>
<input type="password" name="password" id="password"/></p>
</div>
<div class="col-md-12">
<p class="pull-right">
<button type="button" name="passbutton" id="passbutton" class="btn updatepass">Update Password</button>
<button type="submit" name="butonfirst" id="butonfirst" class="btn">Update Profile</button>
</p>
<div class="col-md-12" id="message">
</div>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</form>
</div>
<?php } ?>
</div>
</div>
</div>
</section>
<script>
$(document).ready(function(){
var check = '0';
$(".passfield").hide();
$("#passbutton").click(function(){
if(check == '0') {
$(".passfield").show("slow");
$(".updatepass").hide();
check = '1';
} else {
$(".passfield").hide("slow");
check = '0';
}
});
});
$(document).ready(function() {
$.validator.addMethod(
"regex",
function(value, element, regexp) {
var re = new RegExp(regexp);
return this.optional(element) || re.test(value);
},
"Please enter full url example (www.aliymo.com/pagename)"
);
});
$("#userprofile").validate({
rules: {
email: {
required: true,
email: true
},
telephone:{ required: true,number: true, minlength:11},
password:{
equalTo: "#cpassword"
},
cpassword: {minlength:8},	
city:{required: true, accept: "[a-zA-Z]+" },
postcode:{required: true, minlength:6},
aliymo: { regex: "^(?:www\.)?aliymo.com\/[a-zA-Z]" }
},
messages: {
email: { required: "Enter your email", email:"Enter your correct email"},
telephone: { required: "Enter your phone number", minlength:"Minimum Lenght 11",number: "Enter Only Number"},
password: "Enter your confirm password" ,
cpassword: { minlength:"Minimum Lenght 8"},
city: { required: "Enter your city", accept:"Enter letter only"},
postcode: { required: "Enter your post code", minlength:"Minimum Lenght 6"}
},
submitHandler: function() {
profile_update();
},
success: function(label) {
label.remove();
}
})
</script>
<?php require_once('front_footer.php'); ?>
</body>
</html>