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
Menu <small>Dashboard</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Menu</a></li>
</ul>
</div>
</div>

<div class="portlet-body">
<div class="table-toolbar">
<div class="btn-group">
<a id="sample_editable_1_new" class="btn black" href="<?php echo base_url(); ?>admin_web_pages/add_pages">
Add New Type <i class="icon-plus"></i>
</a>
</div>
</div>
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none">&nbsp;</th>
<th >Page name</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th class="hidden-480" style="text-align:center">Action</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data as $page_data) {
?>
<tr class="odd gradeX">
<td style="display:none"><?php echo $page_data['id']; ?></td>
<td style="width: 75%"><?php echo $page_data['page_name']; ?></td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td style="text-align:center">
<a class="btn green" href="<?php echo base_url().'admin_web_pages/edit_page/'.$page_data['id']; ?>">Edit</a>&nbsp;&nbsp;&nbsp;
<a class="btn <?php if($page_data['status'] == '1'){echo "disable";} else {echo "blue";} ?>" href="<?php echo base_url(); ?>admin_web_pages/admin_disable_pages/<?php echo $page_data['id']; ?>"><?php if($page_data['status'] == '1'){echo "Enable";} else {echo "Disable";} ?></a>&nbsp;&nbsp;&nbsp;
<a class="btn red" href="<?php echo base_url(); ?>admin_web_pages/delete/<?php echo $page_data['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>


</div>
</div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>