<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include("admin_login_head.inc.php"); ?>	
</head>
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<h3 style="color:#FFFFFF">Peturl</h3>
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="form-vertical login-form" action="" method="post" name="admin_login" id="admin_login">
			<input type="hidden" name="action" id="action" value="login"/>
            <h3 class="form-title">Login to your account</h3>
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				<span>Enter any username and password.</span>
			</div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
					</div>
				</div>
			</div>
             <div class="alert alert-danger password_wrong" style="display:none">Incorrect Username / Password</div>
             <div class="alert alert-success password_success" style="display:none">Login Successful</div>
            
			<div class="form-actions">
				
                <div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div> 
                
                <button type="submit" class="btn green pull-right">
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
	</div>
	<div class="copyright">
		<?php echo date('Y') ?> &copy; Peturl. Admin Dashboard.
	</div>
<script type="text/javascript">
$("#admin_login").validate({
rules: {
username: "required",
password: "required",
},
messages: {
username: "Please enter username",
password: "Enter Your Password",
},
submitHandler: function() {
admin_login();
//$("#admin_login").submit();
},
success: function(label) {
label.remove();
}
});
</script>
</body>
</html>