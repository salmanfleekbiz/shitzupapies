<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<?php require_once('front_head_inc.php'); ?>
<title>Peturl Login</title>
</head>
<body>
<?php require_once('front_menu.php'); ?>
<section class="subheader">
	<div class="container">
    	<h4 class="text-uppercase">Dashboard
        	<span class="pull-right">You Currently Have <?php echo count($fetch_dashboard); ?> Pages</span>
        </h4>
    </div>
</section>
<section class="puppies_wrapper">
	<div class="container">
    	<div class="row">
        	<?php
			if(isset($_GET['unpublish'])) {
			echo '<div class="alert alert-success">Page Unpublish successfully</div>';
		   	}
			if(isset($_GET['publish'])) {
			echo '<div class="alert alert-success">Page publish successfully</div>';
		   	}
			/*if(isset($_GET['payment'])){
			echo '<div class="alert alert-danger">Package expired</div>';
			}*/
		   ?>
        	<form method="post">
            <?php 
			
			if(empty($fetch_dashboard)){echo "<div class='nopagecreate'>No Page Create</div>";}
			else {
			foreach ($fetch_dashboard as $getData): 
			$pix = explode(",",$getData['banner']);
			//$remain_day = $getData['remaindate'];
			?>
                <div class="col-md-3 col-sm-4">
                    <div class="puppies_wrap">
                        <div class="img_wrap">
                            <div class="hover text-center">
                                <ul>
                                    <li><a href="<?php echo $getData['page_url']; ?>"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="<?php echo base_url().'dashboard/page/edit/'.$getData['page_id']; ?>"><i class="fa fa-edit"></i></a></li>
                                    <li><a href="<?php echo base_url().'dashboard/delete/'.$getData['page_id']; ?>">
                                    
                                    <?php /*if(($getData['payment_date'] == '') || ($remain_day == '0')){ echo '<i class="fa fa-lock"></i>';} else */if($getData['status'] == 0){ echo '<i class="fa fa-lock"></i>';} else {echo '<i class="fa fa-unlock"></i>';} ?>
                                    </a>
                                    </li>       
                                </ul>
                            </div>
							<?php /*if(($getData['payment_date'] == '') || ($remain_day == '0')){ echo '<span class="status">Expired</span>';} else */if($getData['status'] == 0){ echo '<span class="status unpublish">Unpublish</span>';} else {} ?>
                            <img class="img-responsive center-block" src="<?php echo base_url().'upload/'.$pix[0]?>" alt=""/>
                        </div>
                        <div class="details_wrap">
                            <h5><a href="<?php echo $getData['page_url']; ?>"><?php echo str_replace('-',' ',$getData['page_name']); ?></a></h5>
                            <div>
                                <i class="fa fa-eye"></i> <?php echo $getData['view']; ?>
                              <?php /*?>  <span class="pull-right"><i class="fa fa-calendar"></i>
								<?php 
									if(($getData['payment_date'] == '') || ($remain_day <= 0)){
										$remain_day = '0';
										echo $remain_day.' Days Left';
									} else {
										echo $getData['remaindate'].' Days Left';
									}
								?>
                                </span><?php */?>
                            </div>
                            <a class="upd_subscription<?php /*?><?php echo (($getData['payment_date'] == '') || ($remain_day == '0') ? "renew_subscription" : "upd_subscription")?><?php */?>" href="<?php echo base_url().'dashboard/page/edit/'.$getData['page_id']; ?>"><?php echo (($getData['payment_date'] == '') /*|| ($remain_day == '0')*/ ? "Maintain Page" : "Maintain Page")?> <span class="pull-right"><i class="fa fa-angle-double-right"></i></span></a>
                        </div>
                    </div>
                </div>
			<?php endforeach; } ?>
            </form>
    	</div>
    </div>
</section>






<script type="text/javascript">
jQuery("#userlogin").validate({
rules: {
useremail: {
  required: true,
  email: true
},
userpassword: "required"
},
messages: {
useremail: "Enter your user email",
userpassword: "Enter your user password"
},
submitHandler: function() {
userlogin();
},
success: function(label) {
label.remove();
}
});
</script>
<?php require_once('front_footer.php'); ?>
</body>
</html>