<div class="header navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container-fluid">
<a class="brand" href="<?php echo  base_url(); ?>admin_dashboard">
Peturl 
</a>
<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
<img src="<?php echo  base_url(); ?>assets/img/menu-toggler.png" alt="" />
</a>          
<ul class="nav pull-right">
<li class="dropdown user">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<span class="username"><?php echo $user_name; ?></span>
<i class="icon-angle-down"></i>
</a>
<ul class="dropdown-menu">
<li><a href="<?php echo  base_url(); ?>admin_dashboard/logout"><i class="icon-key"></i> Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</div>
