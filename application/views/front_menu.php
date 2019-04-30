<nav class="navbar navbar-default">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="<?php echo base_url(); ?>"><h4>Peturl</h4></a>
</div>
<div class="collapse navbar-collapse" id="navbar-collapse">
<ul class="nav navbar-nav pull-right text-uppercase">
<?php if($this->session->userdata('userid')  == ''){ ?>
<li <?php echo ($this->router->class == 'Userhome' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>">HOME</a></li>
<?php } ?>
<?php if($this->session->userdata('userid')){ ?>
<li <?php echo (($this->router->class == 'dashboard') && ($this->uri->segment(3) != 'add') ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
<li <?php echo ($this->uri->segment(3) == 'add' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>dashboard/page/add">Create New Page</a></li>
<li <?php echo ($this->router->class == 'profile' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>profile">Profile</a></li>
<li <?php echo ($this->router->class == 'contactus' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>contactus">Contact</a></li>
<li <?php echo ($this->router->class == 'Userhome' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>dashboard/logout">logout</a></li>
<? } else {?>
<li <?php echo ($this->router->class == 'contactus' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>contactus">CONTACT</a></li>
<li <?php echo ($this->router->class == 'userlogin' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>userlogin">LOGIN</a></li>
<li <?php echo ($this->router->class == 'usersignup' ? 'class="active"' : ''); ?>><a href="<?php echo base_url(); ?>usersignup">SIGNUP</a></li>
<?php } ?>
</ul>
</div>
</div>
</nav>