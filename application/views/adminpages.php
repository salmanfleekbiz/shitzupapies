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
Dashboard <small>Pages</small>
</h3>
<ul class="breadcrumb">
<li>
<i class="icon-home"></i>
<a href="index">Home</a> 
<i class="icon-angle-right"></i>
</li>
<li><a href="#">Pages</a></li>
</ul>
</div>
</div>
<div class="portlet-body">
<?php if($this->router->fetch_method() == 'addnew' || $this->router->fetch_method() == 'pageview' || $this->router->fetch_method() == 'homepage' || $this->router->fetch_method() == 'contactus'): ?>
<?php if($this->router->fetch_method() == 'homepage') : ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Homepage</div>
</div>
<div class="portlet-body form">
<form action="<?php echo base_url(); ?>admin_pages_cont/homepage_update" class="form-horizontal" name="pageform" id="pageform" method="post">
<h3 class="form-section">Page Info</h3>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Page Tagline</label>
<div class="controls">
<input type="text" name="tagline" id="tagline" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['tagline'] ) ; ?>" >
</div>
</div>
</div>

<div class="span6 ">
<div class="control-group">
<label class="control-label">Page Sub Tagline</label>
<div class="controls">
<input type="text" name="sub_tagline" id="sub_tagline" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['sub_tagline'] ) ; ?>" >
</div>
</div>
</div>

<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Price</label>
<div class="controls">
<input type="text" name="price" id="price" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['price'] ) ; ?>" >
</div>
</div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span12 ">
<div class="control-group">
<label class="control-label">Page Description</label>
<div class="controls">
<textarea class="span12 ckeditor m-wrap" name="pagedescp" id="pagedescp" rows="6"><?php echo ((empty($home_page)) ? "" : $home_page[0]['pagedescp'] ) ; ?></textarea>
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Box 1 Title</label>
<div class="controls">
<input type="text" name="box1title" id="box1title" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['box1title'] ) ; ?>" >
</div>
</div>
<div class="control-group">
<label class="control-label">Box 1 Description</label>
<div class="controls">
<textarea id="box1des" name="box1des" class="span12 m-wrap"><?php echo ((empty($home_page)) ? "" : $home_page[0]['box1des'] ) ; ?></textarea>
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Box 2 Title</label>
<div class="controls">
<input type="text" name="box2title" id="box2title" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['box2title'] ) ; ?>" >
</div>
</div>
<div class="control-group">
<label class="control-label">Box 2 Description</label>
<div class="controls">
<textarea id="box2des" name="box2des" class="span12 m-wrap"><?php echo ((empty($home_page)) ? "" : $home_page[0]['box2des'] ) ; ?></textarea>
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Box 3 Title</label>
<div class="controls">
<input type="text" name="box3title" id="box3title" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['box3title'] ) ; ?>" >
</div>
</div>
<div class="control-group">
<label class="control-label">Box 3 Description</label>
<div class="controls">
<textarea id="box3des" name="box3des" class="span12 m-wrap"><?php echo ((empty($home_page)) ? "" : $home_page[0]['box3des'] ) ; ?></textarea>
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Box 4 Title</label>
<div class="controls">
<input type="text" name="box4title" id="box4title" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['box4title'] ) ; ?>" >
</div>

<div class="control-group">
<label class="control-label">Box 4 Description</label>
<div class="controls">
<textarea id="box4des" name="box4des" class="m-wrap span12"><?php echo ((empty($home_page)) ? "" : $home_page[0]['box4des'] ) ; ?></textarea>
</div>
</div>

</div>
</div>
</div>
<h3 class="form-section">Meta Tag</h3>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Title</label>
<div class="controls">
<input type="text" name="page_meta_title" id="page_meta_title" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['page_meta_title'] ) ; ?>">
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Keyword</label>
<div class="controls">
<input type="text" name="page_meta_keyword" id="page_meta_keyword" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['page_meta_keyword'] ) ; ?>">
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Description</label>
<div class="controls">
<input type="text" name="page_meta_description" id="page_meta_description" class="m-wrap span12" placeholder="" value="<?php echo ((empty($home_page)) ? "" : $home_page[0]['page_meta_description'] ) ; ?>">
</div>
</div>
</div>
</div>    
<div class="form-actions">
<button type="submit" name="submit" id="submit" class="btn green"><i class="icon-ok"></i>Update</button>
</div>
</form>
<script>
$("#pageform").validate({
rules: {
pagename: "required",
},
messages: {
pagename: "Please enter Page Name",
}
});
</script>
</div>
</div>
<?php elseif($this->router->fetch_method() =='contactus') : ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Contact us</div>
</div>
<div class="portlet-body form">
<form action="<?php echo base_url(); ?>admin_pages_cont/<?php echo ($this->router->fetch_method() == 'pageview') ? 'updatepage' : 'create_newpage'; ?>" class="form-horizontal" name="pageform" id="pageform" method="post">
<input type="hidden" name="action" id="action" value="<?php echo ($this->router->fetch_method() == 'pageview') ? 'updatepage' : 'addpage'; ?>">
<input type="hidden" name="pageid" id="pageid" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['id'] : ''; ?>">
<h3 class="form-section">Page Info</h3>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Page Tagline</label>
<div class="controls">
<input type="text" name="pagename" id="pagename" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['page_name'] : ''; ?>" >
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span12 ">
<div class="control-group">
<label class="control-label">Page Description</label>
<div class="controls">
<textarea class="span12 ckeditor m-wrap" name="pagedescp" id="pagedescp" rows="6"><?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['page_content'] : ''; ?></textarea>
</div>
</div>
</div>
</div>
<h3 class="form-section">Meta Tag</h3>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Title</label>
<div class="controls">
<input type="text" name="page_meta_title" id="page_meta_title" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['metatitle'] : ''; ?>">
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Keyword</label>
<div class="controls">
<input type="text" name="page_meta_keyword" id="page_meta_keyword" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['metakeyword'] : ''; ?>">
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Description</label>
<div class="controls">
<input type="text" name="page_meta_description" id="page_meta_description" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['metadescrip'] : ''; ?>">
</div>
</div>
</div>
</div>    
<div class="form-actions">
<button type="submit" name="submit" id="submit" class="btn green"><i class="icon-ok"></i> <?php echo ($this->router->fetch_method() == 'pageview') ? 'Update Page' : 'Create New Page'; ?></button>
</div>
</form>
<script>
$("#pageform").validate({
rules: {
pagename: "required",
},
messages: {
pagename: "Please enter Page Name",
}
});
</script>
</div>
</div>
<?php else: ?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="icon-reorder"></i>Add Page</div>
</div>
<div class="portlet-body form">
<form action="<?php echo base_url(); ?>admin_pages_cont/<?php echo ($this->router->fetch_method() == 'pageview') ? 'updatepage' : 'create_newpage'; ?>" class="form-horizontal" name="pageform" id="pageform" method="post">
<input type="hidden" name="action" id="action" value="<?php echo ($this->router->fetch_method() == 'pageview') ? 'updatepage' : 'addpage'; ?>">
<input type="hidden" name="pageid" id="pageid" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['id'] : ''; ?>">
<h3 class="form-section">Page Info</h3>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Page Name</label>
<div class="controls">
<input type="text" name="pagename" id="pagename" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['page_name'] : ''; ?>" >
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span12 ">
<div class="control-group">
<label class="control-label">Page Description</label>
<div class="controls">
<textarea class="span12 ckeditor m-wrap" name="pagedescp" id="pagedescp" rows="6"><?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['page_content'] : ''; ?></textarea>
</div>
</div>
</div>
</div>
<h3 class="form-section">Meta Tag</h3>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Title</label>
<div class="controls">
<input type="text" name="page_meta_title" id="page_meta_title" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['metatitle'] : ''; ?>">
</div>
</div>
</div>
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Keyword</label>
<div class="controls">
<input type="text" name="page_meta_keyword" id="page_meta_keyword" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['metakeyword'] : ''; ?>">
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6 ">
<div class="control-group">
<label class="control-label">Meta Description</label>
<div class="controls">
<input type="text" name="page_meta_description" id="page_meta_description" class="m-wrap span12" placeholder="" value="<?php echo ($this->router->fetch_method() == 'pageview') ? $datapage['metadescrip'] : ''; ?>">
</div>
</div>
</div>
</div>    
<div class="form-actions">
<button type="submit" name="submit" id="submit" class="btn green"><i class="icon-ok"></i> <?php echo ($this->router->fetch_method() == 'pageview') ? 'Update Page' : 'Create New Page'; ?></button>
</div>
</form>
<script>
$("#pageform").validate({
rules: {
pagename: "required",
},
messages: {
pagename: "Please enter Page Name",
}
});
</script>
</div>
</div>
<?php endif; ?>
<?php else: ?>
<div class="table-toolbar">
<div class="btn-group">
<button class="btn green" id="sample_editable_1_new" onClick="location.href='<?php echo base_url(); ?>admin_pages_cont/addnew'">
Add New Page <i class="icon-plus"></i>
</button>
</div>
</div>
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th style="display:none">&nbsp;</th>
<th>Page name</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th style="display:none">&nbsp;</th>
<th colspan="2" class="hidden-480" style="text-align:center">Action</th>
</tr>
</thead>
<tbody>
<?php foreach ($showall as $getData): ?>
<tr class="odd gradeX">
<td style="display:none"><?=$getData['id'];?></td>
<td><?=$getData['page_name'];?></td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td style="display:none">&nbsp;</td>
<td style="width:15%;text-align:center;"><a class="btn green" href="<?php echo base_url(); ?>admin_pages_cont/pageview/<?=$getData['id'];?>">Edit</a>&nbsp;<a class="btn red" href="<?php echo base_url(); ?>admin_pages_cont/deletepage/<?=$getData['id'];?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
</div>
</div>
</div>
</div>
<?php include('admin_footer.php'); ?>
</body>
</html>