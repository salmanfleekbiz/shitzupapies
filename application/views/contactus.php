<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<?php require_once('front_head_inc.php'); ?>
<title>Peturl</title>
</head>
<body>
<div class="loadinghide">
<div class="cssload-clock"></div>
</div>
<?php require_once('front_menu.php'); ?>
<section class="subheader">
<div class="container">
<h4 class="text-uppercase">Contact us</h4>
</div>
</section>
<section class="signup">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<form method="post" name="usersignup" id="usersignup" action="#" enctype="multipart/form-data" >
<div class="panel panel-default">

<div id="stepOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
<div class="panel-body">
<div class="col-md-6">
<h4>Contact us</h4>
<p><label class="required" >First Name</label>
<input type="text" name="fname" id="fname"/></p>
<p><label class="required">Last Name</label>
<input type="text" name="lname" id="lname"/></p>
</div>
<div class="col-md-6">
<h4 class="hideinmobile">&nbsp;</h4>
<p><label class="required">Email</label>
<input type="text" name="email" id="email" value="<?php echo(!empty($fetch_user) ? $fetch_user[0]['email'] : '' );?>"/>
<span id="emailmesage"></span>
</p>
<p><label class="required">Telephone</label>
<input type="text" name="telephone" id="telephone" maxlength="11" value="<?php echo(!empty($fetch_user) ? $fetch_user[0]['phone'] : '' );?>"/>
<span id="telephonemesage"></span>
</p></div>

<div class="col-md-12">

<p><label class="required">Message</label>
<textarea name="message" id="message" ></textarea>
</p>


<button type="button" name="butonfirst" id="butonfirst" class="btn center-block">Submit</button>
</p>
</div>
</div>
</div>
</div>
</form>


</div>

<div class="col-md-12">

<div class="contact-bottom-text">
<!--You can also Contact Us Socially above it
<br>-->
<a href="<?php echo $all_datashow[0]['aliymo']; ?>" target="new">You can also Contact Us Socially</a>
</div>

</div>

</div>
</div>
</div>
</section>
<script type="text/javascript">

$(document).ready(function() {
    $("#usersignup").validate({
        rules: {
			fname:{required: true, accept: "[a-zA-Z]+" },
			lname:{required: true, accept: "[a-zA-Z]+" },
			email: {
			  required: true,
			  email: true
			},
			telephone:{ required: true,number: true, minlength:11},
			},
			messages: {
			fname: { required: "Enter your first name", accept:"Only Alphabet allow"},
			lname: { required: "Enter your last name", accept:"Only Alphabet allow"},
			email: { required: "Enter your email", email:"Enter your correct email"},
			telephone: { required: "Enter your phone number", minlength:"Minimum Lenght 10",number: "Enter Only Number"},
			},
    })

    $('#butonfirst').click(function() {
        var check = $("#usersignup").valid();
		if (check == true) {
			alert("Email Submit successfully");
		}
    });
});


</script>
<?php require_once('front_footer.php'); ?>
</body>
</html>