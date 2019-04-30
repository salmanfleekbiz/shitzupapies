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

<?php 
if(isset($_GET['success'])) {
	echo '<div class="alert alert-success">Delete Successful</div>';
}
if(isset($_GET['error'])){
	echo '<div class="alert alert-danger">Please try again</div>';
}
if(isset($_GET['notfound'])){
	echo '<div class="alert alert-danger">Please try again</div>';
}
?>

<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none">&nbsp;</th>
<th>Full Name</th>
<th class="hidden-480">User Email</th>
<th class="hidden-480">Phone</th>
<th class="hidden-480"></th>
<th colspan="2" class="hidden-480" style="text-align:center">Action</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data as $user_data) {
?>
<tr class="odd gradeX">
<td style="display:none"><?php echo $user_data['id']; ?></td>
<td><?php echo $user_data['first_name']." ".$user_data['last_name']; ?></td>
<td><?php echo $user_data['email']; ?></td>
<td><?php echo $user_data['phone']; ?></td>
<td>&nbsp;</td>
<td colspan="2" style="text-align:center">
<a class="btn green" data-toggle="modal" href="#responsive-<?php echo $user_data['id']; ?>">View</a>
<a class="btn red" href="<?php echo base_url(); ?>admin_user/delete/<?php echo $user_data['id']; ?>">Delete</a>
</td>
</tr>
<div id="responsive-<?php echo $user_data['id']; ?>" class="modal hide fade" tabindex="-1" data-width="760">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h3>User Details</h3>
</div>
<div class="modal-body">
<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
<div class="row-fluid">
<div class="span6">
<p>First Name <input type="text" class="span12 m-wrap" value="<?php echo $user_data['first_name']; ?>"></p>
<p>Email <input type="text" class="span12 m-wrap" value="<?php echo $user_data['email']; ?>"></p>
<p>Address <input type="text" class="span12 m-wrap" value="<?php echo $user_data['address_one']; ?>"></p>
<p>Post code <input type="text" class="span12 m-wrap" value="<?php echo $user_data['post_code']; ?>"></p>
<p>State <input type="text" class="span12 m-wrap" value="<?php echo $user_data['state']; ?>"></p>
<p>Payment <input type="text" class="span12 m-wrap" value="<?php echo $user_data['payment']; ?>"></p>
</div>
<div class="span6">
<p>Last Name<input type="text" class="span12 m-wrap" value="<?php echo $user_data['last_name']; ?>"></p>
<p>Phone <input type="text" class="span12 m-wrap" value="<?php echo $user_data['phone']; ?>"></p>
<p>City <input type="text" class="span12 m-wrap" value="<?php echo $user_data['city']; ?>"></p>
<p>Country <input type="text" class="span12 m-wrap" value="<?php echo $user_data['country']; ?>"></p>
<p>Social Link <input type="text" class="span12 m-wrap" value="<?php echo $user_data['social_link']; ?>"></p>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
</div>
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