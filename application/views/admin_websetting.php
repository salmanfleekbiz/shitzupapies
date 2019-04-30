<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include("admin_head.inc.php"); ?>	
</head>
<body class="page-header-fixed">
<?php include("admin_sub_header.php"); ?>
<div class="page-container">
<?php include('sidebar/sidebar.php'); ?>
<div class="page-content">
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<h3 class="page-title">
Dashboard <small>Login</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Login</a></li>
</ul>
</div>
</div>
<div class="portlet-body">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Login Details</div>
</div>
<div class="portlet-body form">
<?php 
if(isset($_GET['success'])) {
	echo '<div class="alert alert-success">Update Successful</div>';
}
?>
<form action="" class="form-horizontal" name="pageform" id="pageform" method="post">
<input type="hidden" name="admin_id" id="admin_id" value="<?php echo ($showall[0]['id']) ? $showall[0]['id'] : ''?>">
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Username</label>
<div class="controls">
<input type="text" name="admin_username" id="admin_username" class="m-wrap span12" placeholder="" value="<?php echo ($showall[0]['username']) ? $showall[0]['username'] : ''?>">
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Password</label>
<div class="controls">
<input type="text" name="admin_password" id="admin_password" class="m-wrap span12" placeholder="" value="">
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Email</label>
<div class="controls">
<input type="text" name="admin_email" id="admin_email" class="m-wrap span12" placeholder="" value="<?php echo ($showall[0]['email']) ? $showall[0]['email'] : ''?>">
</div>
</div>
</div>

<div class="span6 ">
<div class="control-group">
<label class="control-label">Aliymo</label>
<div class="controls">
<input type="text" name="aliymo" id="aliymo" class="m-wrap span12" placeholder="" value="<?php echo ($showall[0]['aliymo']) ? $showall[0]['aliymo'] : ''?>">
</div>
</div>
</div>

</div> 
 <div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>    
<div class="form-actions">
<button type="submit" name="submit" id="submit" class="btn green"><i class="icon-ok"></i>Update Setting</button>
</div>
</form>
<script>
$("#pageform").validate({
rules: {
admin_username: "required",
admin_email: "required"
},
messages: {
admin_username: "Please enter Username",
admin_email: "Please enter Email",
},
submitHandler: function() {
update_setting();
},
success: function(label) {
label.remove();
}
});
</script>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>