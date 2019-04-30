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
Dashboard  <small>Pets</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Pets</a></li>
</ul>
</div>
</div>

<div class="portlet-body">


<?php 
if(isset($_GET['success'])) {
	echo '<div class="alert alert-success">Delete Successful</div>';
}
if(isset($_GET['updatesuccess'])) {
	echo '<div class="alert alert-success">Update Successful</div>';
}
if(isset($_GET['error'])){
	echo '<div class="alert alert-danger password_wrong">Please try again</div>';
}
if(isset($_GET['notfound'])){
	echo '<div class="alert alert-danger">Please try again</div>';
}
?>
<?php if($functionname == 'type'){ ?>
<div class="table-toolbar">
<div class="btn-group">
<form action="<?php echo base_url(); ?>admin_pets/admin_addpets" method="post" name="insert" id="insert"class="form-horizontal">
<input type="hidden" id="name" name="name" value="<?php echo $this->router->fetch_method(); ?>" />
<button type="submit" class="btn green">Add New Type <i class="icon-plus"></i></button>
</form>
</div>
</div>
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none">&nbsp;</th>
<th>Pet Type</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th colspan="2" class="hidden-480" style="text-align:center">Action</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data as $type) {
?>
<tr class="odd gradeX">
<td style="display:none"><?php echo $type['id']; ?></td>
<td><?php echo str_replace("-"," ",$type['type']); ?></td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td colspan="2" style="text-align:center">
<form action="<?php echo base_url(); ?>admin_pets/admin_editpets" method="post" name="insert" id="editbtn" class="editbtn form-horizontal">
<input type="hidden" id="name" name="name" value="<?php echo $this->router->fetch_method(); ?>" />
<input type="hidden" id="id" name="id" value="<?php echo $type['id']; ?>" />
<button type="submit" class="btn green">Edit</button>
</form>
<a class="btn red" href="<?php echo base_url(); ?>admin_pets/deletetype/<?php echo $type['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else if($functionname == 'breed'){ ?>
<form action="<?php echo base_url(); ?>admin_pets/admin_addpets" method="post" name="insert" id="insert"class="form-horizontal">
<input type="hidden" id="name" name="name" value="<?php echo $this->router->fetch_method(); ?>" />
<button type="submit" class="btn green">Add New Breed <i class="icon-plus"></i></button>
</form>
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none">&nbsp;</th>
<th>Pet Type</th>
<th>Pet Breed</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th colspan="2" class="hidden-480" style="text-align:center">Action</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data as $type) {
?>
<tr class="odd gradeX">
<td style="display:none"><?php echo $type['id']; ?></td>
<td><?php echo str_replace("-"," ",$type['type']);  ?></td>
<td><?php echo str_replace("-"," ",$type['breed']); ?></td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td colspan="2" style="text-align:center">
<form action="<?php echo base_url(); ?>admin_pets/admin_editpets" method="post" name="insert" id="editbtn" class="editbtn form-horizontal">
<input type="hidden" id="name" name="name" value="<?php echo $this->router->fetch_method(); ?>" />
<input type="hidden" id="id" name="id" value="<?php echo $type['petid']; ?>" />
<button type="submit" class="btn green">Edit</button>
</form>
<a class="btn red" href="<?php echo base_url(); ?>admin_pets/deletebreed/<?php echo $type['petid']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php }; ?>
</div>
</div>
</div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>