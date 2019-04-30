<div class="page-sidebar nav-collapse collapse">
<ul class="page-sidebar-menu">
<li>
<div class="sidebar-toggler hidden-phone"></div>
</li>
<li class="<?php if($this->router->class == 'admin_dashboard'){echo 'active open';} ?>">
<a href="<?php  echo base_url(); ?>admin_dashboard">
<i class="icon-home"></i> 
<span class="title">Dashboard</span>
<span class="selected"></span>
</a>
</li>

<li class="<?php if($this->router->class == 'admin_pets'){echo 'active open';} ?>">
<a href="javascript:;">
<i class="icon-bookmark-empty"></i>
<span class="title">Pets</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu ">

<li class="<?php echo ((!empty($functionname) && ($functionname == 'type')) ? 'active' : "" ); ?>">
<a href="<?php echo base_url(); ?>admin_pets/type">Pet type</a>
</li>
<li class="<?php echo ((!empty($functionname) && ($functionname == 'breed')) ? 'active' : "" ); ?>">
<a href="<?php  echo base_url(); ?>admin_pets/breed">Pet Breed</a>
</li>
</ul>
</li>

<li class="<?php if($this->uri->segment(1) == 'admin_pages_cont'){echo 'active';} ?>">
<a href="javascript:;">
<i class="icon-file-text"></i>
<span class="title">Pages</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">

<li class="<?php if(($this->uri->segment(2) == 'homepage')){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_pages_cont/homepage">Homepage</a>
</li>

<li class="<?php if($this->uri->segment(2) == ''){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_pages_cont">Other Pages</a>
</li>





</ul>
</li>

<li class="<?php if($this->uri->segment(1) == 'admin_slider'){echo 'active';} ?>">
<a href="javascript:;">
<i class="icon-file-text"></i>
<span class="title">Slider</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">

<li class="<?php if(($this->uri->segment(2) == 'slider')){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_slider">All Slide</a>
</li>
</ul>
</li>



<li class="<?php if($this->uri->segment(1) == 'admin_email'){echo 'active';} ?>">
<a href="javascript:;">
<i class="icon-file-text"></i>
<span class="title">Email</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">

<li class="<?php if(($this->uri->segment(2) == 'admin_email')){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_email">All Emails</a>
</li>
</ul>
</li>



<li class="<?php if(($this->uri->segment(1) == 'admin_user') or ($this->uri->segment(1) == 'admin_pages')){echo 'active open';} ?>">
<a href="javascript:;">
<i class="icon-user"></i>
<span class="title">Users</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">
<li class="<?php if($this->uri->segment(1) == 'admin_user'){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_user">All Users</a>
</li>
<li class="<?php if($this->uri->segment(1) == 'admin_pages'){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_pages">All Users Pages</a>
</li>
</ul>
</li>
<li class="<?php if($this->router->class == 'admin_websetting'){echo 'active open';} ?>"> 
<a href="javascript:;">
<i class="icon-cogs"></i>
<span class="title">Settings</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">
<li class="<?php if($this->router->class == 'admin_websetting'){echo 'active';} ?>">
<a href="<?php  echo base_url(); ?>admin_websetting">Login</a>
</li>
</ul>
</li>
</ul>
</div>