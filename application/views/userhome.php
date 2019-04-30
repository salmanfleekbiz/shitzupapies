<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<?php require_once('front_head_inc.php'); ?>
<title>Peturl</title>
</head>
<body>
<?php require_once('front_menu.php'); ?>
<?php foreach($home_page as $page_data): ?>
<section class="getstarted">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h4 class="title"><?php echo $page_data['tagline']; ?><br>
<?php echo $page_data['sub_tagline']; ?>
</h4>
</div>
<div class="col-md-4 col-sm-4">
<img src="<?php echo base_url(); ?>userfrontassest/img/dog-left.png" alt="" class="center-block img-responsive"/>
</div>
<div class="col-md-4 col-sm-4 text-center">
<div class="price">
<?php /*?><sup class="currency">£</sup> 
<span class="amount"><?php echo $page_data['price']; ?></span>
<span class="period">/ Month
<span class="contract">No Contract</span>
</span><?php */?>
</div>
<a class="getstarted" href="<?php echo base_url(); ?>usersignup">Get Started</a>
</div>
<div class="col-md-4 col-sm-4">
<img src="<?php echo base_url(); ?>userfrontassest/img/dog-right.png" alt="" class="center-block img-responsive"/>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<!--img src="<?php echo base_url(); ?>userfrontassest/img/banner-img.png" alt="" class="banner-img center-block img-responsive"/-->

    <div id="carousel-generic" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
      	<?php
			$a=1;
			foreach($slide as $slider){
		?>
        <div class="item <?php if($a == 1){ ?> active <?php }else{} ?>">
          <img src="<?php  echo base_url(); ?>upload/slider/<?php echo $slider['slidename']; ?>" alt="">
        </div>
        <?php $a++; } ?>
        
      </div>
    
      <a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

</div>
</div>
</div>
</section>
<section class="workflow">
<div class="container">
<div class="row text-center">
<div class="col-md-12">
<?php echo html_entity_decode($page_data['pagedescp']); ?>
</div>
</div>
<div class="row">
<div class="col-md-12 steps-line visible-lg visible-md visible-sm">
<span class="pull-left">START</span>
<span class="pull-right">DONE</span>
<hr/>
</div>
<div class="col-md-1 col-sm-1"></div>
<div class="col-md-10 col-sm-10">
<div class="row">
<div class="col-md-3 col-sm-3">
<div class="steps_wrap">
<h5><?php echo $page_data['box1title']; ?></h5>
<p><?php echo $page_data['box1des']; ?></p>
</div>
</div>
<div class="col-md-3 col-sm-3">
<div class="steps_wrap">
<h5><?php echo $page_data['box2title']; ?></h5>
<p><?php echo $page_data['box2des']; ?></p>
</div>
</div>
<div class="col-md-3 col-sm-3">
<div class="steps_wrap">
<h5><?php echo $page_data['box3title']; ?></h5>
<p><?php echo $page_data['box3des']; ?></p>
</div>
</div>
<div class="col-md-3 col-sm-3">
<div class="steps_wrap">
<h5><?php echo $page_data['box4title']; ?></h5>
<p><?php echo $page_data['box4des']; ?></p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php endforeach; ?>
<?php require_once('front_footer.php'); ?>
</body>
</html>