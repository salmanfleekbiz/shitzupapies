<!DOCTYPE html>
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
Peturl <small>Slider</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Slider</a></li>
</ul>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">Slider</div>
</div>
<div class="portlet-body form">
<?php if($this->router->fetch_method() == 'addnew'){ ?>
<form action="<?php  echo base_url(); ?>admin_slider/insertData" name="sliderForm" id="sliderForm" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="control-group">
<label class="control-label">Upload Slider Image</label>
<div class="controls">
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
</div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
<div>
<span class="btn btn-file"><span class="fileupload-new">Select image</span>
<span class="fileupload-exists">Change</span>
<input type="file" name="sliderimage" id="sliderimage" class="default" /></span>
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
</div>
</div>
<div class="form-actions">
<button class="btn blue" type="submit" id="submit" name="submit">Upload Slide</button>
</div>
</form> 
<script type="text/javascript">
$("#sliderForm").validate({
rules: {
sliderimage: "required"
},
messages: {
sliderimage: "Please select file"
}
});

function sendslider(){
var formData = new FormData($('#sliderForm')[0]);
jQuery.ajax({
url: "<?php  echo base_url(); ?>insertData",
type: "POST",
data: formData,
contentType: false,
cache: false,
processData: false,
success: function (data)
{
	
}
});
}
</script>
<?php }else if($this->router->fetch_method() == 'editslide'){ ?>
<form action="<?php  echo base_url(); ?>admin_slider/updateData" name="sliderForm" id="sliderForm" method="post" enctype="multipart/form-data" class="form-horizontal">
<input type="hidden" name="id" id="id" value="<?php echo $editslidedata[0]['id']; ?>">
<div class="control-group">
<label class="control-label">Upload Slider Image</label>
<div class="controls">
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
<img src="<?php  echo base_url(); ?>upload/slider/<?php echo $editslidedata[0]['slidename']; ?>" alt="" />
</div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
<div>
<span class="btn btn-file"><span class="fileupload-new">Select image</span>
<span class="fileupload-exists">Change</span>
<input type="file" name="sliderimage" id="sliderimage" class="default" /></span>
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
</div>
</div>
<div class="form-actions">
<button class="btn blue" type="submit" id="submit" name="submit">Update Slide</button>
</div>
</form> 
<script type="text/javascript">
$("#sliderForm").validate({
rules: {
sliderimage: "required"
},
messages: {
sliderimage: "Please select file"
}
});

function sendslider(){
var formData = new FormData($('#sliderForm')[0]);
jQuery.ajax({
url: "<?php  echo base_url(); ?>insertData",
type: "POST",
data: formData,
contentType: false,
cache: false,
processData: false,
success: function (data)
{
	
}
});
}
</script>
<?php }else{ ?>
<a href="<?php  echo base_url(); ?>admin_slider/addnew" class="btn green">Add New Slide</a>
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none;">&nbsp;</th>
<th class="hidden-480">Slide Image</th>
<th style="display:none;" class="hidden-480">&nbsp;</th>
<th style="display:none;" class="hidden-480">&nbsp;</th>
<th style="display:none;" class="hidden-480">&nbsp;</th>
<th class="hidden-480">Action</th>
</tr>
</thead>
<tbody>
<?php
foreach($slide as $slider){
?>
<tr class="odd gradeX">
<td style="display:none;">001245</td>
<td><img src="<?php  echo base_url(); ?>upload/slider/<?php echo $slider['slidename']; ?>" width="50" height="50"></td>
<td style="display:none;" class="hidden-480">&nbsp;</td>
<td style="display:none;" class="hidden-480">&nbsp;</td>
<td style="display:none;" class="center hidden-480">&nbsp;</td>
<td style="width:18%;text-align:center;" ><a href="<?php  echo base_url(); ?>admin_slider/editslide/<?php echo $slider['id']; ?>" class="btn green">Edit</a>&nbsp;<a href="<?php  echo base_url(); ?>admin_slider/deletslide/<?php echo $slider['id']; ?>" class="btn red">Delete</a></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>