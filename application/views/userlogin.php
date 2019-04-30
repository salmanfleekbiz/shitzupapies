<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<?php require_once('front_head_inc.php'); ?>
<title>Peturl Login</title>
</head>
<body>
<div class="loadinghide">
<div class="cssload-clock"></div>
</div>
<?php require_once('front_menu.php'); ?>
<section class="subheader">
<div class="container">
<h4 class="text-uppercase">Login</h4>
</div>
</section>
<section class="login">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="signin_wrap loginform">
<form name="userlogin" id="userlogin" action="" method="post">
<h4 class="text-uppercase">Sign In</h4>
<label class="text-uppercase">Email</label>
<input type="email" name="useremail" id="useremail" placeholder="abc@gmail.com"/>
<div></div>
<label class="text-uppercase">password</label>
<input type="password" name="userpassword" id="userpassword" placeholder="******"/>
<div></div>
<label class="chk-remember">
<input type="checkbox" id="remember" name="remember" value="1" />
<label for="remember">Remember&nbsp;me</label>
</label>
<a href="#" class="pull-right ForgotLink">Forgot</a>
<button class="text-uppercase btn btn-block" type="submit" name="submit" id="submit">Sign In</button>
<div id="error"></div>
</form>
</div>

<div class="signin_wrap forgotpassword" style="display:none">
<form name="forgotpass" id="forgotpass" action="" method="post">
<h4 class="text-uppercase">Forgot Password</h4>
<label class="text-uppercase">Email</label>
<input type="email" name="forgotemail" id="forgotemail" placeholder="abc@gmail.com"/>
<a href="#" class="pull-right SignInLink">Login</a>
<button class="text-uppercase btn btn-block" type="submit" name="submit" id="submit">Forgot Password</button>
<div id="error"></div>
</form>
</div>

</div>
</div>
</div>
</section>
<script type="text/javascript">

$('.ForgotLink').click(function(){
	$('.loginform').hide();
	$('.forgotpassword').show();		
});
$('.SignInLink').click(function(){
	$('.forgotpassword').hide();
	$('.loginform').show();		
});

jQuery("#userlogin").validate({
rules: {
useremail: {
  required: true,
  email: true
},
userpassword: "required"
},
messages: {
useremail: "Enter your user email",
userpassword: "Enter your user password"
},
submitHandler: function() {
userlogin();
},
success: function(label) {
label.remove();
}
});

jQuery("#forgotpass").validate({
rules: {
forgotemail: {
  required: true,
  email: true
},
},
messages: {
forgotemail: "Enter your user email",
},
submitHandler: function() {
forgotpass();
},
success: function(label) {
label.remove();
}
});
</script>
<?php require_once('front_footer.php'); ?>
</body>
</html>