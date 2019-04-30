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
Pets <small>Dashboard</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Pet Type</a></li>
</ul>
</div>
</div>
<?php 
if($functionname == 'type'){ ?>
<?php if(!$edit){ ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Add pet type</div>
</div>
<div class="portlet-body form">
<form action="" method="post" name="typeform" id="typeform"class="form-horizontal">
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Pet type </label>
<div class="controls">
<input type="text" id="admin_pettype" name="admin_pettype" class="m-wrap span12" placeholder="Pet Type" value="" >
<div class="alert alert-danger already_exist">Type name already exists</div>
</div>
<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
</div>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn green"><i class="icon-ok"></i> Save</button>
<a href="<?php echo base_url(); ?>admin_type" class="btn" >Cancel</a>
</div>
</form>
</div>
</div>
<?php } else if($edit){ ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Edit pet type</div>
</div>
<div class="portlet-body form">
<!-- BEGIN FORM-->
<form action="" method="post" name="typeformedit" id="typeformedit"class="form-horizontal">
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Pet type </label>
<div class="controls">
<input type="hidden" id="pet_id" name="pet_id" class="m-wrap span12" value="<?php echo $data['id']?>" >
<input type="text" id="admin_pettype" name="admin_pettype" class="m-wrap span12" placeholder="Pet Type" value="<?php echo str_replace("-"," ",$data['type']);?>" >
<div class="alert alert-danger already_exist">Type name already exists</div>
</div>
</div>
</div>
</div>
<!--/row-->

<div class="form-actions">
<button type="submit" class="btn green"><i class="icon-ok"></i> Update</button>
<a href="<?php echo base_url(); ?>admin_type" class="btn" >Cancel</a>
</div>
</form>
<!-- END FORM-->                
</div>
</div>
<?php } ?>
<?php } else if($functionname == 'breed'){ ?>
<?php if(!$edit){ ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Add pet breed</div>
</div>
<div class="portlet-body form">
<form action="" method="post" name="breedform" id="breedform"class="form-horizontal">
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Pet type </label>
<div class="controls">
<select id="pettype" name="pettype" class="m-wrap span12">
<option value="">Select Pet Type</option>
<?php
foreach ($data as $type) {
?>
<option value="<?php echo $type['id']; ?>"><?php echo str_replace("-"," ",$type['type']); ?></option>
<?php } ?>
</select>
</div>
</div>
</div>


<div class="span6 ">
<div class="control-group">
<label class="control-label">Pet Breed </label>
<div class="controls">
<input type="text" id="petbreed" name="petbreed" class="m-wrap span12" placeholder="Pet Breed" value="" >
<div class="alert alert-danger already_exist">Pet breed name already exists</div>
</div>
<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span12 ">
<div class="control-group">
<label class="control-label">Page Description</label>
<div class="controls">
<textarea class="span12 ckeditor m-wrap" name="desc" id="desc" rows="6"><?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['page_content'] : ''; ?></textarea>
</div>
</div>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn green"><i class="icon-ok"></i> Save</button>
<a href="<?php echo base_url(); ?>admin_petbreed" class="btn" >Cancel</a>
</div>
</form>
</div>
</div>
<?php } else if($edit){ ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Add pet breed</div>
</div>
<div class="portlet-body form">
<form action="" method="post" name="breedformedit" id="breedformedit"class="form-horizontal">
<input type="hidden" id="petbreedid" name="petbreedid" class="m-wrap span12" value="<?php echo $datab['petid']?>" >
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Pet type </label>
<div class="controls">
<select id="pettype" name="pettype" class="m-wrap span12">
<option value="">Select Pet Type</option>
<?php
foreach ($data as $type) {
?>
<option value="<?php echo $type['id']; ?>" <?php if($datab['type_id'] == $type['id']){echo "selected";}else {}?> ><?php echo str_replace("-"," ",$type['type']); ?></option>
<?php } ?>
</select>
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Pet Breed </label>
<div class="controls">
<input type="text" id="petbreed" name="petbreed" class="m-wrap span12" placeholder="Pet Breed" value="<?php echo str_replace("-"," ",$datab['breed']); ?>" >
<div class="alert alert-danger already_exist">Pet breed name already exists</div>
</div>
<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
</div>
</div>
</div>


<div class="row-fluid">
<div class="span12 ">
<div class="control-group">
<label class="control-label">Page Description</label>
<div class="controls">
<textarea class="span12 ckeditor m-wrap" name="desc" id="desc" rows="6"><?php echo $datab['description']; ?></textarea>
</div>
</div>
</div>
</div>


<div class="form-actions">
<button type="submit" class="btn green"><i class="icon-ok"></i> Update</button>
<a href="<?php echo base_url(); ?>admin_petbreed" class="btn" >Cancel</a>
</div>
</form>
</div>
</div>
<?php } ?>
<?php } ?>
</div>
</div>
</div>
<script type="text/javascript">

$("#breedform").validate({
ignore: [],
debug: false,

rules: {
pettype: "required",
petbreed: "required",
desc: {
required: function() 
{
CKEDITOR.instances.desc.updateElement();
}
}
},
messages: {
pettype: "Please select pet type",
petbreed: "Please enter pet breed",
desc: "Please enter pet Description",
},
submitHandler: function() {
add_pet_breed();
},
success: function(label) {
label.remove();
}
});


$("#breedformedit").validate({
ignore: [],
debug: false,
rules: {
pettype: "required",
petbreed: "required",
desc: {
required: function() 
{
CKEDITOR.instances.desc.updateElement();
}
}
},
messages: {
pettype: "Please select pet type",
petbreed: "Please enter pet breed",
desc: "Please enter pet Description",
},
submitHandler: function() {
edit_pet_breed();
},
success: function(label) {
label.remove();
}
});

$("#typeform").validate({
rules: {
admin_pettype: "required",
},
messages: {
admin_pettype: "Please enter Pet type",
},
submitHandler: function() {
add_pet_type();
},
success: function(label) {
label.remove();
}
});

$("#typeformedit").validate({
rules: {
admin_pettype: "required",
},
messages: {
admin_pettype: "Please enter Pet type",
},
submitHandler: function() {
edit_pet_type();
},
success: function(label) {
label.remove();
}
});
</script>
<?php include('admin_footer.php'); ?>
</body>
</html>