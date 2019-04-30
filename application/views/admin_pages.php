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
Users <small>Dashboard</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Users</a></li>
</ul>
</div>
</div>

<div class="portlet-body">

<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none">&nbsp;</th>
<th>Page name</th>
<th class="hidden-480">Page Url</th>
<th class="hidden-480">User name</th>
<th class="hidden-480">Payment</th>
<th colspan="2" class="hidden-480" style="text-align:center">Action</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data as $page_data) {
?>
<tr class="odd gradeX">
<td style="display:none"><?php echo $page_data['pegesid']; ?></td>
<td><?php echo $page_data['page_name']; ?></td>
<td><a href="<?php echo base_url().$page_data['page_url']; ?>"><?php echo $page_data['page_url']; ?></a></td>
<td><?php echo $page_data['first_name']." ".$page_data['last_name']; ?></td>
<td>
<?php echo ($page_data['payment'] == 'done' ? "Paid" : "Unpaid"); ?>
</td>
<td colspan="2" style="text-align:center">
<a class="btn green" href="<?php echo base_url().$page_data['page_url']; ?>">View</a>
<a class="btn <?php if($page_data['admin_status'] == '1'){echo "disable";} else {echo "blue";} ?>" href="<?php echo base_url(); ?>admin_pages/admin_disable_pages/<?php echo $page_data['pegesid']; ?>"><?php if($page_data['admin_status'] == '1'){echo "Disable";} else {echo "Enable";} ?></a>
<a class="btn red" href="<?php echo base_url(); ?>admin_pages/delete/<?php echo $page_data['pegesid']; ?>">Delete</a>
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