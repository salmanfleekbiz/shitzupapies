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
<?php if($this->uri->segment(3) == 'edit'): ?>
<section class="subheader">
<div class="container">
<h4 class="text-uppercase">Edit Page</h4>
</div>
</section>
<section class="signup">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach ($edit_page as $edit) : ?>
<input type="hidden" name="pageid" id="pageid" value="<?php echo $this->uri->segment(4);?>">
<form method="post" name="usersignupstepthree" id="usersignupstepthree" action="#" enctype="multipart/form-data" >
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingThree">
<h4 class="panel-title">
<button class="collapsed" id="stepthreeshow" name="stepthreeshow" role="button" data-toggle="collapse" data-parent="#accordion" href="#stepThree" aria-expanded="false" aria-controls="stepThree">
Page Details
</button>
</h4>
</div>
<div id="stepThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
<div class="panel-body">
<div class="col-md-12 paddingremove">
<div class="col-md-12">
<h4>Page Information</h4>
</div>


<div class="col-md-12 fileplus">
<h4>Banners</h4><span class="imgsizemsg">( 1150px x 360px looks best ) </span>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="file-add add-btn">+</button>
</div>
<div class="col-md-12 fileupload">
<input type="hidden" name="allimagesarray" id="allimagesarray" value="<?php echo ($edit == '' ? '' : $edit['banner'])?>">
<?php 
$banner = explode(',',$edit['banner']);
for($i = 0; $i < count($banner); $i++ ) { ?>
<div class="col-md-6">
<div><label class="required">Banners</label>


<div class="fileinput fileinput-new" data-provides="fileinput">
<span class="btn btn-primary btn-file"><span>Browse&hellip;</span><input type="file" id="banner<?php echo $i; ?>" name="banner[]" class="banner" onBlur="bannerEmpty(<?php echo $i; ?>);" accept="image/*"/>
</span>
<span class="fileinput-filename"><?php echo $banner[$i];?></span>

<?php if($i != 0){ ?>
<button type="button" title="Remove" onClick="if(!confirm('Are you sure you want to continue?')) { return false; } else {deleteimage(<?php echo $i; ?>);}" class="deleteimage remove-btn">-</button>
<?php
}
?>

</div>

</div>
<div style="width:10%" class="left-block img-responsive">
<img src="<?php echo base_url().'upload/'.$banner[$i];?>" alt="<?php echo ($edit == '' ? '' : str_replace('-',' ',$edit['page_name']))?>" class="center-block img-responsive">
<input type="hidden" name="img_name[]" id="img_name<?php echo $i; ?>" value="<?php echo $banner[$i];?>" class="img_name">
</div>
</div>
<?php } ?>
</div>
<div class="col-md-12 youtubeplus">
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="url-add add-btn">+</button>
</div>
<?php 
$youtube_url = explode(',',$edit['youtube_url']);
$sex = explode(',',$edit['sex']);
$age = explode(',',$edit['age']);
$ref = explode(',',$edit['ref']);
$keynotes = explode(',,,,',$edit['keynotes']);
?>
<div class="youtubeurl">
<h4>Youtube <span class="tooltips"><span class="pagenametooltip youtubetooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips youtubehidetooltips">
<span class="youtubeclosebtn">X</span>

You will need a Free You Tube channel !!!<br><br>
Login or signup<br>
Click the upload button top right of the page, Click the select file tab upload or drag and drop file<br>
Keep the file public do not change<br>
Once you have selected the file you want, upload... it will ask you for a Title, E.g. "Shih Tzu Puppies 8 Weeks Old"<br>
In the description field add some text about them include your Petul.uk/pagenamelink<br>
The Tag section add some key words about your pets what breed and type they are e.g. shihtzu, puppies, dogs, pets, channelpets, peturl,<br>
All this information will help users on You Tube and search engines find your video and divert them to your webpage<br>
You can always go back and edit and make changes at a later date if you need to Now just click the SAVE button and you are all done<br>
Copy the You Tube video link and paste it in the video fields on Peturl.uk<br>
Add a gender of pet in first video, sex, age and reference then just keep repeating until you have uploaded them all<br>
See a E.g. of how a finished page will look to the public www.peturl.uk/shihtzu-puppies-for-sale www.peturl.uk/koi-carp-for-sale<br>


</span>
</span></h4>

<?php for($i = 0; $i < count($youtube_url); $i++ ) { ?>
<div class="col-md-12 col-sm-11 less">
<div class="col-md-5">
<p><label class="required">Youtube Url</label>
<input class="pg_name pageurl" type="text" name="url[]" id="url<?php echo $i; ?>" onBlur="urlEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $youtube_url[$i])?>" />
<?php if($edit != ''){ ?>
<script>
setInterval(function(){
	urlEmpty(<?php echo $i; ?>);
}, 1000);
	
</script>
	
<?php }; ?>
<span class="error_message" id="urlmessage<?php echo $i; ?>">
<a target="_blank" href="<?php echo ($edit == '' ? '' : $youtube_url[$i])?>">
<img alt="play video" src="http://clients.5stardesigners.net/shihtzupapies/assets/img/youtube-play-button-small.png">
</a>
</span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Sex</label>
<input class="url_detail sex" type="text" name="sex[]" id="sex<?php echo $i; ?>" onBlur="sexEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $sex[$i])?>" onKeyUp="this.value=this.value.replace(/[^a-zA-Z]/g, '')"/>
<span class="error_message" id="sexmessage<?php echo $i; ?>"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Age</label>
<input class="url_detail age" type="text" name="age[]" id="age<?php echo $i; ?>" onBlur="ageEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $age[$i])?>" />
<span class="error_message" id="agemessage<?php echo $i; ?>"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Ref</label>
<input class="url_detail ref" type="text" name="ref[]" id="ref<?php echo $i; ?>" onBlur="refEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $ref[$i])?>"/>
<span class="error_message" id="refmessage<?php echo $i; ?>"></span></p>
</div>
<div class="col-md-1">
<?php if($i != 0){ ?>
<button type="button" title="Remove" onClick="if(!confirm('Are you sure you want to continue?')) { return false; } else {deleturl(<?php echo $i; ?>);}" class="deleteurl remove-btn">-</button>
<?php
}
?>
</div>
</div>
<?php } ?>
</div>

<div class="col-md-12 keynotesplus">
<h4>Key Facts <span class="tooltips"><span class="pagenametooltip keyfatcstooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips keyfatcshidetooltips">
<span class="keyfatcsclosebtn">X</span>
This is so you can list all the main things that come with your pets and what customers should know about</span>
</span></h4>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="keynotes-add add-btn">+</button>
</div>

<div class="col-md-12 keynotess">
<?php for($j = 0; $j < count($keynotes); $j++ ) { ?>
<div class="col-md-12">
<p>
<label class="required">Key Facts</label>
<input class="pg_keynotes keynotes" type="text" name="keynotes[]" id="keynotes<?php echo $j; ?>" onBlur="keynotesEmpty(<?php echo $j; ?>)" value="<?php echo ($edit == '' ? '' : $keynotes[$j])?>"/>
<span class="error_message" id="keynotesmessage<?php echo $j; ?>"></span>
<?php if($j != 0){ ?>
<button type="button" title="Remove" onClick="if(!confirm('Are you sure you want to continue?')) { return false; } else {deletenote(<?php echo $j; ?>);}" class="deletenote remove-btn">-</button>
<?php
}
?>
</p>
</div>
<?php } ?>
</div>
<div class="col-md-12 stepthree">
<div class="col-md-12">
<h5>Description</h5>
<p><textarea class="pg_description ckeditor " id="desc" name="desc"><?php echo ($edit == '' ? '' : str_replace('-',' ',$edit['description']))?></textarea></p>
</div>

<div class="col-md-12 less">
<h5>Contact Information</h5>
<div class="col-md-4">
<p><label class="required">Telephone</label>
<input class="pg_name" type="text" name="tel" id="tel" value="<?php echo ($edit == '' ? "" : ($edit['tel'] == '' ? $userdata['0']['phone'] : str_replace('-',' ',$edit['tel'])) )?>" />
<span class="error_message" id="telmessage"></span></p>
</div>
<div class="col-md-4">
<p>
<label class="required">Email
<span class="tooltips"><span class="pagenametooltip emailtooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips emailhidetooltips">
<span class="emailclosebtn">X</span>
Your email address is covered with a form Know one can see your email address publicly</span>
</span>
</label>
<input class="pg_name" type="text" name="email" id="email" value="<?php echo ($edit == '' ? "" : ($edit['email'] == '' ? $userdata['0']['email'] : str_replace('-',' ',$edit['email'])) )?>"/>
<span class="error_message" id="emailmessage"></span></p>
</div>
<div class="col-md-4">
<p>
<label class="">Aliymo Social Link
<span class="tooltips"><span class="pagenametooltip aliymotooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips aliymohidetooltips">
<span class="aliymoclosebtn">X</span>
Space saving tool which allows you to add multiple social media channels in one rememberable link. If you do not have one you can create one for free at www.aliymo.com</span>
</span>
</label>
<input class="pg_name" type="text" name="sociallink" id="sociallink" value="<?php echo ($edit == '' ? "" : ($edit['sociallink'] == '' ? $userdata['0']['social_link'] : str_replace('-',' ',$edit['sociallink'])) )?>" />
<span class="error_message" id="sociallinkmessage"></span></p>
</div>
</div>

</div>
<div class="col-md-12">
<input type="hidden" name="pageid" id="pageid" value="<?php echo $edit['page_id']; ?>"/>
<p><button type="button" class="btn pull-right" id="buttonthird" onClick="updatepage()">Update</button>
</p>
</div>
</div>
</div>
</div>
</div>
</form>
<?php 
$remain_day = $edit['remaindate'];
?>
<?php endforeach; ?>
</div>
</div>
</div>
<div id="error"></div>
</div>
</section>

<?php elseif($this->uri->segment(3) == 'renewpage'): ?>
<section class="subheader">
<div class="container">
<h4 class="text-uppercase">Edit Page</h4>
</div>
</section>
<section class="signup">
<div class="container">
<div class="row">
<div id="error"></div>
<div class="col-md-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach ($edit_page as $edit) : ?>
<input type="hidden" name="pageid" id="pageid" value="<?php echo $this->uri->segment(4);?>">
<form method="post" name="usersignupstepthree" id="usersignupstepthree" action="#" enctype="multipart/form-data" >
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingThree">
<h4 class="panel-title">
<button class="collapsed" id="stepthreeshow" name="stepthreeshow" role="button" data-toggle="collapse" data-parent="#accordion" href="#stepThree" aria-expanded="false" aria-controls="stepThree">
Page Details
</button>
</h4>
</div>
<div id="stepThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
<div class="panel-body">
<div class="col-md-12 paddingremove">
<div class="col-md-12">
<h4>Page Information</h4>
</div>


<div class="col-md-12 fileplus">
<h4>Banners</h4><span class="imgsizemsg">( 1150px x 360px looks best ) </span>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="file-add add-btn">+</button>
</div>
<div class="col-md-12 fileupload">
<input type="hidden" name="allimagesarray" id="allimagesarray" value="<?php echo ($edit == '' ? '' : $edit['banner'])?>">
<?php 
$banner = explode(',',$edit['banner']);
for($i = 0; $i < count($banner); $i++ ) { ?>
<div class="col-md-6">
<div><label class="required">Banners</label>


<div class="fileinput fileinput-new" data-provides="fileinput">
<span class="btn btn-primary btn-file"><span>Browse&hellip;</span><input type="file" id="banner<?php echo $i; ?>" name="banner[]" class="banner" onBlur="bannerEmpty(<?php echo $i; ?>);" accept="image/*"/>
</span>
<span class="fileinput-filename"><?php echo $banner[$i];?></span>

<?php if($i != 0){ ?>
<button type="button" title="Remove" onClick="if(!confirm('Are you sure you want to continue?')) { return false; } else {deleteimage(<?php echo $i; ?>);}" class="deleteimage remove-btn">-</button>
<?php
}
?>

</div>

</div>
<div style="width:10%" class="center-block img-responsive">
<img src="<?php echo base_url().'upload/'.$banner[$i];?>" alt="<?php echo ($edit == '' ? '' : str_replace('-',' ',$edit['page_name']))?>" class="center-block img-responsive">
<input type="hidden" name="img_name[]" id="img_name<?php echo $i; ?>" value="<?php echo $banner[$i];?>" class="img_name">
</div>
</div>
<?php } ?>
</div>
<div class="col-md-12 youtubeplus">
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="url-add add-btn">+</button>
</div>
<?php 
$youtube_url = explode(',',$edit['youtube_url']);
$sex = explode(',',$edit['sex']);
$age = explode(',',$edit['age']);
$ref = explode(',',$edit['ref']);
$keynotes = explode(',,,,',$edit['keynotes']);
?>
<div class="youtubeurl">

<h4>Youtube <span class="tooltips"><span class="pagenametooltip youtubetooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips youtubehidetooltips">
<span class="youtubeclosebtn">X</span>
You will need a Free You Tube channel !!!<br><br>
Login or signup<br>
Click the upload button top right of the page, Click the select file tab upload or drag and drop file<br>
Keep the file public do not change<br>
Once you have selected the file you want, upload... it will ask you for a Title, E.g. "Shih Tzu Puppies 8 Weeks Old"<br>
In the description field add some text about them include your Petul.uk/pagenamelink<br>
The Tag section add some key words about your pets what breed and type they are e.g. shihtzu, puppies, dogs, pets, channelpets, peturl,<br>
All this information will help users on You Tube and search engines find your video and divert them to your webpage<br>
You can always go back and edit and make changes at a later date if you need to Now just click the SAVE button and you are all done<br>
Copy the You Tube video link and paste it in the video fields on Peturl.uk<br>
Add a gender of pet in first video, sex, age and reference then just keep repeating until you have uploaded them all<br>
See a E.g. of how a finished page will look to the public www.peturl.uk/shihtzu-puppies-for-sale www.peturl.uk/koi-carp-for-sale<br>


</span>
</span></h4>

<?php for($i = 0; $i < count($youtube_url); $i++ ) { 

?>
<div class="col-md-12 col-sm-11 less">
<div class="col-md-5">
<p><label class="required">Youtube Url</label>
<input class="pg_name pageurl" type="text" name="url[]" id="url<?php echo $i; ?>" onBlur="urlEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $youtube_url[$i])?>" />
<span class="error_message" id="urlmessage<?php echo $i; ?>">
<a target="_blank" href="<?php echo ($edit == '' ? '' : $youtube_url[$i])?>">
<img alt="play video" src="http://clients.5stardesigners.net/shihtzupapies/assets/img/youtube-play-button-small.png">
</a>
</span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Sex</label>
<input class="url_detail sex" type="text" name="sex[]" id="sex<?php echo $i; ?>" onBlur="sexEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $sex[$i])?>" onKeyUp="this.value=this.value.replace(/[^a-zA-Z]/g, '')"/>
<span class="error_message" id="sexmessage<?php echo $i; ?>"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Age</label>
<input class="url_detail age" type="text" name="age[]" id="age<?php echo $i; ?>" onBlur="ageEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $age[$i])?>" />
<span class="error_message" id="agemessage<?php echo $i; ?>"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Ref</label>
<input class="url_detail ref" type="text" name="ref[]" id="ref<?php echo $i; ?>" onBlur="refEmpty(<?php echo $i; ?>)" value="<?php echo ($edit == '' ? '' : $ref[$i])?>"/>
<span class="error_message" id="refmessage<?php echo $i; ?>"></span></p>
</div>
<div class="col-md-1">
<?php if($i != 0){ ?>
<button type="button" title="Remove" onClick="if(!confirm('Are you sure you want to continue?')) { return false; } else {deleturl(<?php echo $i; ?>);}" class="deleteurl remove-btn">-</button>
<?php
}
?>
</div>
</div>
<?php } ?>
</div>

<div class="col-md-12 keynotesplus">
<h4>Key Facts <span class="tooltips"><span class="pagenametooltip keyfatcstooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips keyfatcshidetooltips">
<span class="keyfatcsclosebtn">X</span>
This is so you can list all the main things that come with your pets and what customers should know about</span>
</span></h4>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="keynotes-add add-btn">+</button>
</div>

<div class="col-md-12 keynotess">
<?php for($j = 0; $j < count($keynotes); $j++ ) { ?>
<div class="col-md-12">
<p>
<label class="required">Keyfacts</label>
<input class="pg_keynotes keynotes" type="text" name="keynotes[]" id="keynotes<?php echo $j; ?>" onBlur="keynotesEmpty(<?php echo $j; ?>)" value="<?php echo ($edit == '' ? '' : $keynotes[$j])?>"/>
<span class="error_message" id="keynotesmessage<?php echo $j; ?>"></span>
<?php if($j != 0){ ?>
<button type="button" title="Remove" onClick="if(!confirm('Are you sure you want to continue?')) { return false; } else {deletenote(<?php echo $j; ?>);}" class="deletenote remove-btn">-</button>
<?php
}
?>
</p>
</div>
<?php } ?>
</div>
<div class="col-md-12 stepthree">
<div class="col-md-12">
<h5>Description</h5>
<p><textarea class="pg_description ckeditor " id="desc" name="desc"><?php echo ($edit == '' ? '' : str_replace('-',' ',$edit['description']))?></textarea></p>
</div>

<div class="col-md-12 less">
<h5>Contact Information</h5>
<div class="col-md-4">
<p><label class="required">Telephone</label>
<input class="pg_name" type="text" name="tel" id="tel" value="<?php echo ($edit == '' ? "" : ($edit['tel'] == '' ? $userdata['0']['phone'] : str_replace('-',' ',$edit['tel'])) )?>" />
<span class="error_message" id="telmessage"></span></p>
</div>
<div class="col-md-4">
<p>
<label class="required">Email
<span class="tooltips"><span class="pagenametooltip emailtooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips emailhidetooltips">
<span class="emailclosebtn">X</span>
Your email address is covered with a form Know one can see your email address publicly</span>
</span>
</label>
<input class="pg_name" type="text" name="email" id="email" value="<?php echo ($edit == '' ? "" : ($edit['email'] == '' ? $userdata['0']['email'] : str_replace('-',' ',$edit['email'])) )?>"/>
<span class="error_message" id="emailmessage"></span></p>
</div>
<div class="col-md-4">
<p>
<label class="">Aliymo Social Link
<span class="tooltips"><span class="pagenametooltip aliymotooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips aliymohidetooltips">
<span class="aliymoclosebtn">X</span>
Space saving tool which allows you to add multiple social media channels in one rememberable link. If you do not have one you can create one for free at www.aliymo.com</span>
</span>
</label>
<input class="pg_name" type="text" name="sociallink" id="sociallink" value="<?php echo ($edit == '' ? "" : ($edit['sociallink'] == '' ? $userdata['0']['social_link'] : str_replace('-',' ',$edit['sociallink'])) )?>" />
<span class="error_message" id="sociallinkmessage"></span></p>
</div>
</div>


</div>
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="text-center">
<tbody>
<tr class="off_white price_title text-center">
<td>Page Name</td>
<td>Page Url</td>
<td>Month</td>
<td>Total</td>
</tr>
<tr>
<td class="details"><div id="stepthree_pagename"><?php echo ($edit == '' ? '' : str_replace('-',' ',$edit['page_name']))?></div></td>
<td class="details"><div id="stepthree_pageurl"><?php echo ($edit == '' ? '' : $edit['page_url'])?></div></td>
<td class="qty">01</td>
<td class="price">£ <?php echo $home_page[0]['price']; ?> PCM</td>
</tr>
</tbody>
</table>
<div class="col-md-12">
<input type="hidden" name="pageid" id="pageid" value="<?php echo $edit['page_id']; ?>"/>
<p><button type="button" class="btn pull-right" id="buttonthird" onClick="onlypay()">Pay with Paypal</button>
</p>
</div>
</div>
</div>
<div id="error"></div>
</div>
</div>
</form>
<?php 


$remain_day = $edit['remaindate'];

?>

<?php /*?><form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type='hidden' name='business' value='AnnaJTarvin-facilitator@inbound.plus'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='item_name' id="paypal_item_name" value="<?php echo ($edit == '' ? '' : $edit['page_url'])?>">
<input type='hidden' name='amount' value='<?php echo $home_page[0]['price']; ?>'>
<input type='hidden' name='currency_code' value='GBP'>
<input type="hidden" name="tx" value="">
<input type='hidden' name='handling' value='0'>
<input type='hidden' name='cancel_return' value='<?php echo base_url(); ?>'>
<input type='hidden' name='return' id="paypal_return_url" value="<?php echo base_url(); ?>dashboard/renewpayment?pageid=<?php echo $edit['page_id']; ?>&remaindate=<?php echo $remain_day; ?>">
<button type="submit" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="paypal_form_submit" id="paypal_form_submit" alt="" value="Pay" class="paynow"></button>
</form><?php */?>
<?php endforeach; ?>
</div>
</div>
</div>
</div>
</section>
<?php else :?>
<section class="subheader">
<div class="container">
<h4 class="text-uppercase">Add Page</h4>
</div>
</section>
<section class="signup">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<form method="post" name="usersignupsteptwo" id="usersignupsteptwo" action="#" enctype="multipart/form-data" >
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingTwo">
<h4 class="panel-title">
<button class="collapsed" id="steptwoshow" name="steptwoshow" role="button" data-toggle="collapse" data-parent="#accordion" href="#stepTwo" aria-expanded="false" aria-controls="stepTwo">
Step 1: Page Name
</button>
</h4>
</div>
<div id="stepTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
<div class="panel-body">
<div class="col-md-6">
<p>
<label class="required">Page Name <span class="tooltips"><span class="pagenametooltip pagenamestooltip" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips pagenameshidetooltips">
<span class="pagenamesclosebtn">X</span>
This will be the name shown publicly on your webpage at the top and will also be used as your page url address link this cannot be changed once the page has been created</span>
</span></label>
<input class="pg_name" type="text" name="pagename" id="pagename"/></p>
</div>
<div class="col-md-6">
<p><label class="required">URL 
<span class="tooltips"><span class="pagenametooltip urltooltip" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips urlhidetooltips">
<span class="urlclosebtn">X</span>
This will be your PRO Peturl link to share.The url is based on the name of your webpage if you wish to change your url you will need to change the page name this will automatically change to the nearest availability</span>
</span>
</label>
<input class="pg_url" type="hidden" name="pageurl" id="pageurl"/>
<span id="url"></span>
</p>
</div>
<div class="col-md-6">
<p><label class="required">Pets Type</label>
<select name="petstype" id="petstype">
<option value="">Select Pet Type</option>
<?php foreach ($fetch_type as $data){ ?>
<option value="<?php echo $data['id']; ?>"><?php echo $data['type']; ?></option>
<?php } ?>
</select></p>
</div>
<div class="col-md-6">
<p id="breedresult"><label class="required">Breed</label>
<select name="breed" id="breed">
<option value="">Please Select Breed</option>
</select>
</p>
</div>
<div class="col-md-12">
<p><button type="button" class="btn pull-right" id="butonsecond" name="butonsecond" >Continue</button></p>
</div>
</div>
</div>
</div>
</form>
<form method="post" name="usersignupstepthree" id="usersignupstepthree" action="#" enctype="multipart/form-data" >
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingThree">
<h4 class="panel-title">
<button class="collapsed" id="stepthreeshow" name="stepthreeshow" role="button" data-toggle="collapse" data-parent="#accordion" href="#stepThree" aria-expanded="false" aria-controls="stepThree" disabled>
Page 2: Page Details
</button>
</h4>
</div>
<div id="stepThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
<div class="panel-body">
<div class="col-md-12 paddingremove">
<div class="col-md-12">
<h4>Page Information</h4>
</div>


<div class="col-md-12 fileplus">
<h4>Banners</h4>
<span class="imgsizemsg">( 1150px x 360px looks best ) </span>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="file-add add-btn">+</button>
</div>
<div class="col-md-12 fileupload">
<div class="col-md-6">
<div><label class="required">Banners</label>


<div class="fileinput fileinput-new" data-provides="fileinput">
<span class="btn btn-primary btn-file"><span>Browse&hellip;</span><input type="file" id="banner0" name="banner[]" class="banner" onBlur="bannerEmpty(0);" accept="image/*"/>
</span>
<span class="fileinput-filename">No file chosen</span>
</div>


<!--<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-primary btn-file">
Browse&hellip; <input type="file" id="banner0" name="banner[]" class="banner" onBlur="bannerEmpty(0);" accept="image/*">
</span>
</span>
<input type="text" class="form-control" readonly>
</div>-->
<span class="error_message" id="bannermessage0"></span>
</div>
</div>
</div>

<div class="col-md-12 youtubeplus">
<h4>Youtube <span class="tooltips"><span class="pagenametooltip youtubetooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips youtubehidetooltips">
<span class="youtubeclosebtn">X</span>
You will need a Free You Tube channel !!!<br><br>
Login or signup<br>
Click the upload button top right of the page, Click the select file tab upload or drag and drop file<br>
Keep the file public do not change<br>
Once you have selected the file you want, upload... it will ask you for a Title, E.g. "Shih Tzu Puppies 8 Weeks Old"<br>
In the description field add some text about them include your Petul.uk/pagenamelink<br>
The Tag section add some key words about your pets what breed and type they are e.g. shihtzu, puppies, dogs, pets, channelpets, peturl,<br>
All this information will help users on You Tube and search engines find your video and divert them to your webpage<br>
You can always go back and edit and make changes at a later date if you need to Now just click the SAVE button and you are all done<br>
Copy the You Tube video link and paste it in the video fields on Peturl.uk<br>
Add a gender of pet in first video, sex, age and reference then just keep repeating until you have uploaded them all<br>
See a E.g. of how a finished page will look to the public www.peturl.uk/shihtzu-puppies-for-sale www.peturl.uk/koi-carp-for-sale<br>


</span>
</span></h4>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="url-add add-btn">+</button>
</div>
<div class="youtubeurl">
<div class="col-md-12 col-sm-11 less">
<div class="col-md-5">
<p><label class="required">Youtube Url</label>
<input class="pg_name pageurl" type="text" name="url[]" id="url0" onBlur="urlEmpty(0)" />
<span class="error_message" id="urlmessage0"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Sex</label>
<input class="url_detail sex" type="text" name="sex[]" id="sex0" onBlur="sexEmpty(0)" onKeyUp="this.value=this.value.replace(/[^a-zA-Z]/g, '')"/>
<span class="error_message" id="sexmessage0"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Age</label>
<input class="url_detail age" type="text" name="age[]" id="age0" onBlur="ageEmpty(0)" />
<span class="error_message" id="agemessage0"></span></p>
</div>
<div class="col-md-2">
<p><label class="required url_detail">Ref</label>
<input class="url_detail ref" type="text" name="ref[]" id="ref0" onBlur="refEmpty(0)" />
<span class="error_message" id="refmessage0"></span></p>
</div>
<div class="col-md-1">

</div>
</div>
</div>

<div class="col-md-12 keynotesplus">
<h4>Key Facts <span class="tooltips"><span class="pagenametooltip keyfatcstooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips keyfatcshidetooltips">
<span class="keyfatcsclosebtn">X</span>
This is so you can list all the main things that come with your pets and what customers should know about</span>
</span></h4>
<div class="alert urllimitfull bg-danger" style="display:none">You can not insert more then 12 url</div>
<button type="button" title="Add More" class="keynotes-add add-btn">+</button>
</div>

<div class="col-md-12 keynotess">
<div class="col-md-12">
<p>
<label class="required">Keyfacts </label>
<input class="pg_keynotes keynotes" type="text" name="keynotes[]" id="keynotes0" onBlur="keynotesEmpty(0)" />
<span class="error_message" id="keynotesmessage0"></span>
</p>
</div>
</div>
<div class="col-md-12 stepthree">
<div class="col-md-12">
<h5>Description</h5>
<p><textarea class="pg_description ckeditor " id="desc" name="desc"></textarea></p>
</div>

<div class="col-md-12 less">
<h5>Contact Information</h5>
<div class="col-md-4">
<p><label class="required">Telephone</label>
<input class="pg_name" type="text" name="tel" id="tel" value="<?php echo $userdata['0']['phone'];  ?>" />
<span class="error_message" id="telmessage"></span></p>
</div>
<div class="col-md-4">
<p>
<label class="required">Email 
<span class="tooltips"><span class="pagenametooltip emailtooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips emailhidetooltips">
<span class="emailclosebtn">X</span>
Your email address is covered with a form Know one can see your email address publicly</span>
</span>
</label>
<input class="pg_name" type="text" name="email" id="email" value="<?php echo $userdata['0']['email'];  ?>" />
<span class="error_message" id="emailmessage"></span></p>
</div>
<div class="col-md-4">
<p>
<label class="">Aliymo Social Link 
<span class="tooltips"><span class="pagenametooltip aliymotooltip" href="#" data-toggle="tooltip" data-placement="top" title="">?</span>
<span class="hidetooltips aliymohidetooltips">
<span class="aliymoclosebtn">X</span>
Space saving tool which allows you to add multiple social media channels in one rememberable link. If you do not have one you can create one for free at www.aliymo.com</span>
</span>
</label>
<input class="pg_name" type="text" name="sociallink" id="sociallink" value="<?php echo $userdata['0']['social_link'];  ?>" />
<span class="error_message" id="sociallinkmessage"></span></p>
</div>
</div>


</div>
<?php /*?><table width="90%" border="0" cellspacing="0" cellpadding="0" class="text-center">
<tbody>
<tr class="off_white price_title text-center">
<td>Page Name</td>
<td>Page Url</td>
<td>Month</td>
<td>Total</td>
</tr>
<tr>
<td class="details"><div id="stepthree_pagename"></div></td>
<td class="details"><div id="stepthree_pageurl"></div></td>
<td class="qty">01</td>
<td class="price">£ <?php echo $home_page[0]['price']; ?> PCM</td>
</tr>
</tbody>
</table><?php */?>
<div class="col-md-12">
<p><button type="button" class="btn pull-right" id="buttonthird" onClick="clickedconfirm()">Create Page</button>
</p>
</div>
</div>
</div>
<div id="error"></div>
</div>
</div>
</form>


<?php /*?><form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type='hidden' name='business' value='AnnaJTarvin-facilitator@inbound.plus'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='item_name' id="paypal_item_name" value="">
<input type='hidden' name='amount' value='<?php echo $home_page[0]['price']; ?>'>
<input type='hidden' name='currency_code' value='GBP'>
<input type="hidden" name="tx" value="">
<input type='hidden' name='handling' value='0'>
<input type='hidden' name='cancel_return' value='<?php echo base_url(); ?>'>
<input type='hidden' name='return' id="paypal_return_url" value="">
<button type="submit" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="paypal_form_submit" id="paypal_form_submit" alt="" value="Pay" class="paynow"></button>
</form><?php */?>

</div>
</div>
</div>
</div>
</section>
<?php endif; ?>
<script type="text/javascript">



$('#petstype').change(function () {
	edit_fetchbreed();
});



var urlcount = <?php if($this->uri->segment(3) == 'edit'){echo count($youtube_url);} else {echo '0'; } ?>;
$('.url-add').click(function(){
if(urlcount <= 11) {
urlcount ++;
$('.youtubeurl').append('<div class="col-md-12"><div class="col-md-5"><p><label class="required">Youtube Url</label><input class="pg_name pageurl" type="text" name="url[]" id="url'+urlcount+'" onBlur="urlEmpty('+urlcount+')"/><span class="error_message" id="urlmessage'+urlcount+'" ></span></p></div><div class="col-md-2"><p><label class="required url_detail">Sex</label><input class="url_detail sex" type="text" name="sex[]" id="sex'+urlcount+'" onBlur="sexEmpty('+urlcount+')" onBlur="ageEmpty(0)"onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g, \'\')" /><span class="error_message"  id="sexmessage'+urlcount+'" ></span></p></div><div class="col-md-2"><p><label class="required url_detail">Age</label><input class="url_detail age" type="text" name="age[]" id="age'+urlcount+'" onBlur="ageEmpty('+urlcount+')" onBlur="ageEmpty(0)" /><span class="error_message" id="agemessage'+urlcount+'" ></span></p></div><div class="col-md-2"><p><label class="required url_detail">Ref</label><input class="url_detail ref" type="text" name="ref[]" id="ref'+urlcount+'" onBlur="refEmpty('+urlcount+')"/><span class="error_message" id="refmessage'+urlcount+'" ></span></p></div><div class="col-md-1"><button type="button" title="Remove" onClick="removeFunc();" class="remove remove-btn urlcount">-</button></div></div>');
document.getElementById("url"+urlcount).focus();
}
});
$(document).on('click', '.urlcount', function removeFunc() {
urlcount--;
var urldel = $(this).parent().parent();
urldel.remove();
});

var keynotescount = <?php if($this->uri->segment(3) == 'edit'){echo count($keynotes);} else {echo '0'; } ?>;
$('.keynotes-add').click(function(){
if(keynotescount <= 11) {
keynotescount ++;
$('.keynotess').append('<div><div class="col-md-12"><p><label class="required">Keyfacts</label><input class="pg_keynotes keynotes" type="text" name="keynotes[]" id="keynotes'+keynotescount+'" onBlur="keynotesEmpty('+keynotescount+')" /><span class="error_message" id="keynotesmessage'+keynotescount+'"></span><button type="button" title="Remove" onClick="removeKeynote();" class="remove remove-btn keynotescount">-</button></p></div></div>');
	document.getElementById("keynotes"+keynotescount).focus();
}
});
$(document).on('click', '.keynotescount', function removeKeynote() {
keynotescount--;
var keynotesdel = $(this).parent().parent();
keynotesdel.remove();
});


var fileuploadcount = <?php if($this->uri->segment(3) == 'edit'){echo count($banner);} else {echo '0'; } ?>;
$('.file-add').click(function(){
if(fileuploadcount <= 11) {
fileuploadcount ++;
$('.fileupload').append('<div class="col-md-6"><div><label class="required">Banners</label><div class="fileinput fileinput-new" data-provides="fileinput"><span class="btn btn-primary btn-file"><span>Browse&hellip;</span><input type="file" id="banner'+fileuploadcount+'" name="banner[]" class="banner" onBlur="bannerEmpty('+fileuploadcount+');" accept="image/*"/></span><span class="fileinput-filename">No file chosen</span><button type="button" title="Remove" onClick="removeFileupload();" class="remove-btn removefile fileuploadcount">-</button></div><span class="error_message" id="bannermessage'+fileuploadcount+'"></span></div></div>');
}
});

$(document).on('click', '.fileuploadcount', function removeFileupload() {
fileuploadcount--;
var fileuploaddele = $(this).parent().parent();
fileuploaddele.remove();
});

$(document).ready(function() {
    $("#usersignupsteptwo").validate({
        rules: {
			pagename:"required",
			petstype:"required",
			breed:"required"
			},
			messages: {
			pagename: "Enter Page name",
			petstype: "Select pet type",
			breed: "Select Pet breed"
			},
		})

    $('#butonsecond').click(function() {
		var check2 = $("#usersignupsteptwo").valid();
		if (check2 == true) {
			enable_thirdstep();
		}
    });
});



function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}
function pagenameEmpty(){
	var chekcName = document.getElementById('pagename').value;
	if(chekcName == ''){
		$("#pagenamemessage").html('<label class="error" for="pagename" generated="true">Enter your page name</label>');	
	}else{
		$("#pagenamemessage").html("");	
	}
}

function breedEmpty(){
	var chekcName = document.getElementById('breed').value;
	if(chekcName == ''){
		$("#breedmessage").html('<label class="error" for="breed" generated="true">Select breed</label>');	
	}else{
		$("#breedmessage").html("");	
	}
}

function petstypeEmpty(){
	var chekcName = document.getElementById('petstype').value;
	if(chekcName == ''){
		$("#petstypemessage").html('<label class="error" for="petstype" generated="true">Enter your pet type</label>');	
	}else{
		$("#petstypemessage").html("");	
	}
}


function bannerEmpty(id){
	var chekcName = document.getElementById('banner'+id).value;
	if(chekcName == ''){
		$("#bannermessage"+id).html("");	
	}else{
		$("#bannermessage"+id).html("");	
	}
}

function emailEmpty(){
	var chekcName = document.getElementById('email').value;
	if(chekcName == ''){
		$("#emailmessage").html('<label class="error" for="email" generated="true">Enter your email</label>');	
	}else{
		$("#emailmessage").html("");	
	}
}


function telEmpty(){
	var chekcName = document.getElementById('tel').value;
	if(chekcName == ''){
		$("#telmessage").html('<label class="error" for="telephone" generated="true">Enter your phone number</label>');	
	}else{
		$("#telmesssage").html("");	
	}
}

/*function sociallinks(){
	var chekcName = document.getElementById('sociallink').value;
	if(chekcName == ''){
		$("#sociallinkmessage").html('<label class="error" for="sociallink" generated="true">Enter Aliymo Social Link</label>');	
	}else{
		$("#sociallinkmessage").html("");	
	}
}*/


function urlEmpty(id){
	var chekcName = document.getElementById('url'+id).value;
	if(chekcName == ''){
		$("#urlmessage"+id).html("");	
	}else{
		videoId = chekcName.slice( 32 );
		if(videoId.length > 3) {
		$("#urlmessage"+id).html("<a href='<?php echo base_url(); ?>dashboard/viewvideo/"+videoId+"' target='_blank'><img src='http://img.youtube.com/vi/"+videoId+"/0.jpg' alt='play video' class='youtubeimg' ><span><img src='http://clients.5stardesigners.net/shihtzupapies/assets/img/youtube-play-button-small.png' alt='play video'></span></a>");
		} else {
			$("#urlmessage"+id).html("");	
		}
	}
}
function sexEmpty(id){
	var chekcName = document.getElementById('sex'+id).value;
	if(chekcName == ''){
		$("#sexmessage"+id).html("");	
	}else{
		$("#sexmessage"+id).html("");	
	}
}
function ageEmpty(id){
	var chekcName = document.getElementById('age'+id).value;
	if(chekcName == ''){
		$("#agemessage"+id).html("");	
	}else{
		$("#agemessage"+id).html("");	
	}
}
function refEmpty(id){
	var chekcName = document.getElementById('ref'+id).value;
	if(chekcName == ''){
		$("#refmessage"+id).html("");	
	}else{
		$("#refmessage"+id).html("");	
	}
}
function keynotesEmpty(id){
	var chekcName = document.getElementById('keynotes'+id).value;
	if(chekcName == ''){
		$("#keynotesmessage"+id).html("");	
	}else{
		$("#keynotesmessage"+id).html("");	
	}
}

function updatepage(){  	
	var url = document.getElementsByName('url[]');
	var sex = document.getElementsByName('sex[]');
	var age = document.getElementsByName('age[]');
	var ref = document.getElementsByName('ref[]');
	var keynote = document.getElementsByName('keynotes[]');
	
	
	var tel = document.getElementById('tel').value;
	var email = document.getElementById('email').value;
	var sociallink = document.getElementById('sociallink').value;
	
	
	//alert(banner.length);
	var p = /^(\https\:\/\/\www.)\youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
	
	for (x=0; x<url.length; x++)
	{
		if (myTrim(url[x].value) == "")
		{
		$("#urlmessage"+x).html("Url is required");
		var url_error_field = 1;
		}
		
		if (myTrim(url[x].value) != "")
		{
			if(myTrim(url[x].value).match(p)) {
			} else {
				$("#urlmessage"+x).html("Please Enter proper url (https://www.youtube.com/watch?v=abc)");
				var url_error_field = 1;	
			}
		}
		
		
		if (myTrim(sex[x].value) == "")
		{
		$("#sexmessage"+x).html("Sex is required");
		var sex_error_field = 1;
		}
		if (myTrim(age[x].value) == "")
		{
		$("#agemessage"+x).html("Age is required");
		var age_error_field = 1;
		}
		if (myTrim(ref[x].value) == "")
		{
		$("#refmessage"+x).html("Ref code is required");
		var ref_error_field = 1;
		}
	}
	for (z=0; z<keynote.length; z++)
	{
		if (myTrim(keynote[z].value) == "")
		{
		$("#keynotesmessage"+z).html("Keynotes is required");
		var keynote_error_field = 1;
		}
	}
	if(email == '') {
			emailEmpty();
			email_error_field = 1 
	} else {
		email_error_field = 0;
	}
	if(tel == '') {
		telEmpty();
		telephone_error_field = 1 
	} else {
		telephone_error_field = 0;
	}
	/*if(sociallink == '') {
		sociallinks();
		sociallink_error_field = 1 
	} else {
		sociallink_error_field = 0;
	}*/
	
	if(email_error_field ==1 || telephone_error_field ==1 || /*sociallink_error_field ==1 ||*/ url_error_field == 1 || sex_error_field == 1 || age_error_field == 1 || ref_error_field == 1 || keynote_error_field == 1 ){
	return false;
	}else{
		edit_page();
	}
}
<?php /*?>
function createnewpage(){  	
	var a,b,c = 1;
	var banner = document.getElementsByName('banner[]');
	var url = document.getElementsByName('url[]');
	var sex = document.getElementsByName('sex[]');
	var age = document.getElementsByName('age[]');
	var ref = document.getElementsByName('ref[]');
	var keynote = document.getElementsByName('keynotes[]');
	
	var tel = document.getElementById('tel').value;
	var email = document.getElementById('email').value;
	var sociallink = document.getElementById('sociallink').value;

	var pagename = document.getElementById('pagename').value;
	var petstype = document.getElementById('petstype').value;
	var breed = document.getElementById('breed').value;
	
	//alert(banner.length);
	for (i=0; i<banner.length; i++)
	{
		if (myTrim(banner[i].value) == "")
		{
		$("#bannermessage"+i).html("Banner is required");
		var banner_error_field = 1;
		}
	}
	var p = /^(\https\:\/\/\www.)\youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
	
	for (x=0; x<url.length; x++)
	{
		if (myTrim(url[x].value) == "")
		{
		$("#urlmessage"+x).html("Url is required");
		var url_error_field = 1;
		}
		
		if (myTrim(url[x].value) != "")
		{
			if(myTrim(url[x].value).match(p)) {
			} else {
				$("#urlmessage"+x).html("Please Enter proper url (https://www.youtube.com/watch?v=abc)");
				var url_error_field = 1;	
			}
		}
		
		
		if (myTrim(sex[x].value) == "")
		{
		$("#sexmessage"+x).html("Sex is required");
		var sex_error_field = 1;
		}
		if (myTrim(age[x].value) == "")
		{
		$("#agemessage"+x).html("Age is required");
		var age_error_field = 1;
		}
		if (myTrim(ref[x].value) == "")
		{
		$("#refmessage"+x).html("Ref code is required");
		var ref_error_field = 1;
		}
	}
	for (z=0; z<keynote.length; z++)
	{
		if (myTrim(keynote[z].value) == "")
		{
		$("#keynotesmessage"+z).html("Keynotes is required");
		var keynote_error_field = 1;
		}
	}
	
	if(email == '') {
			emailEmpty();
			email_error_field = 1 
	} else {
		email_error_field = 0;
	}
	if(tel == '') {
		telEmpty();
		telephone_error_field = 1 
	} else {
		telephone_error_field = 0;
	}
	if(sociallink == '') {
		sociallink();
		sociallink_error_field = 1 
	} else {
		sociallink_error_field = 0;
	}
	
	if(pagename == '') {
		pagenameEmpty();
		pagename_error_field = 1 
	} else {
		pagename_error_field = 0;
	}
	if(petstype == '') {
		petstypeEmpty();
		petstype_error_field = 1 
	} else {
		petstype_error_field = 0;
	}
	if(breed == '') {
		breedEmpty();
		breed_error_field = 1 
	} else {
		breed_error_field = 0;
	}
	        
	
	if(sociallink_error_field == 1 || telephone_error_field == 1 || email_error_field == 1 || banner_error_field == 1 || url_error_field == 1 || sex_error_field == 1 || age_error_field == 1 || ref_error_field == 1 || keynote_error_field == 1    || pagename_error_field == 1 || petstype_error_field == 1 || breed_error_field == 1 ){
	return false;
	}else{
		createnewpages();
	}
}<?php */?>

 function clickedconfirm() {
       if (confirm('Just before you subscribe and go PRO, just double check the Type, Breed and Page name you have chosen as once you subscribe you cannot change this.')) {
           formvalidation();
       } else {
           return false;
       }
    }

function formvalidation(){  	
	var a,b,c = 1;
	var banner = document.getElementsByName('banner[]');
	var url = document.getElementsByName('url[]');
	var sex = document.getElementsByName('sex[]');
	var age = document.getElementsByName('age[]');
	var ref = document.getElementsByName('ref[]');
	var keynote = document.getElementsByName('keynotes[]');
	
	var tel = document.getElementById('tel').value;
	var email = document.getElementById('email').value;
	var sociallink = document.getElementById('sociallink').value;
	
	var pagename = document.getElementById('pagename').value;
	var petstype = document.getElementById('petstype').value;
	var breed = document.getElementById('breed').value;
	
	//alert(banner.length);
	for (i=0; i<banner.length; i++)
	{
		if (myTrim(banner[i].value) == "")
		{
		$("#bannermessage"+i).html("Banner is required");
		var banner_error_field = 1;
		}
	}
	var p = /^(\https\:\/\/\www.)\youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
	
	for (x=0; x<url.length; x++)
	{
		if (myTrim(url[x].value) == "")
		{
		$("#urlmessage"+x).html("Url is required");
		var url_error_field = 1;
		}
		
		if (myTrim(url[x].value) != "")
		{
			if(myTrim(url[x].value).match(p)) {
			} else {
				$("#urlmessage"+x).html("Please Enter proper url (https://www.youtube.com/watch?v=abc)");
				var url_error_field = 1;	
			}
		}
		
		
		if (myTrim(sex[x].value) == "")
		{
		$("#sexmessage"+x).html("Sex is required");
		var sex_error_field = 1;
		}
		if (myTrim(age[x].value) == "")
		{
		$("#agemessage"+x).html("Age is required");
		var age_error_field = 1;
		}
		if (myTrim(ref[x].value) == "")
		{
		$("#refmessage"+x).html("Ref code is required");
		var ref_error_field = 1;
		}
	}
	for (z=0; z<keynote.length; z++)
	{
		if (myTrim(keynote[z].value) == "")
		{
		$("#keynotesmessage"+z).html("Keynotes is required");
		var keynote_error_field = 1;
		}
	}
	if(pagename == '') {
		pagenameEmpty();
		pagename_error_field = 1 
	} else {
		pagename_error_field = 0;
	}
	if(petstype == '') {
		petstypeEmpty();
		petstype_error_field = 1 
	} else {
		petstype_error_field = 0;
	}
	if(breed == '') {
		breedEmpty();
		breed_error_field = 1 
	} else {
		breed_error_field = 0;
	}
	
	if(email == '') {
			emailEmpty();
			email_error_field = 1 
	} else {
		email_error_field = 0;
	}
	if(tel == '') {
		telEmpty();
		telephone_error_field = 1 
	} else {
		telephone_error_field = 0;
	}
	/*if(sociallink == '') {
		sociallinks();
		sociallink_error_field = 1 
	} else {
		sociallink_error_field = 0;
	}*/
	        
	
	if(telephone_error_field == 1 || email_error_field == 1 || banner_error_field == 1 || url_error_field == 1 || sex_error_field == 1 || age_error_field == 1 || ref_error_field == 1 || keynote_error_field == 1   || pagename_error_field == 1 || petstype_error_field == 1 || breed_error_field == 1 ){
	return false;
	}else{
		createnewpages();
	}
}

function onlypay() {
	$('#paypal_form_submit').click()	
}

function enable_thirdstep(){
$('#stepthreeshow').removeAttr('disabled');
$('#steptwoshow').click();
$('#stepthreeshow').click();
}
$('#pagename').focusout(function() {
	edit_check_url();
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

// Youtube Close Button
var youtubeclosebtn = 1;
$('.youtubeclosebtn').click(function(e) {
	if(youtubeclosebtn == 0){
		$('.youtubehidetooltips').hide();
		youtubeclosebtn = 1 ;	
	} 
});

$('.youtubetooltip').click(function(e) {
	if(youtubeclosebtn == 1){
		$('.youtubehidetooltips').show();
		youtubeclosebtn = 0 ;	
	} 
});



// Keyfatcs Close Button
var keyfatcsclosebtn = 1;
$('.keyfatcsclosebtn').click(function(e) {
	if(keyfatcsclosebtn == 1){
		$('.keyfatcshidetooltips').hide();
		keyfatcsclosebtn = 0 ;	
	} 
});
$('.keyfatcstooltip').click(function(e) {
	$('.keyfatcshidetooltips').show();
	keyfatcsclosebtn = 1 ;
});




// Email Close Button
var keyfatcsclosebtn = 1;
$('.emailclosebtn').click(function(e) {
	if(emailclosebtn == 1){
		$('.emailhidetooltips').hide();
		emailclosebtn = 0 ;	
	} 
});
$('.emailtooltip').click(function(e) {
	$('.emailhidetooltips').show();
	emailclosebtn = 1 ;
});




// Aliymo Close Button
var aliymoclosebtn = 1;
$('.aliymoclosebtn').click(function(e) {
	if(aliymoclosebtn == 1){
		$('.aliymohidetooltips').hide();
		aliymoclosebtn = 0 ;	
	} 
});
$('.aliymotooltip').click(function(e) {
	$('.aliymohidetooltips').show();
	aliymoclosebtn = 1 ;
});




// Pagename Close Button
var pagenamesclosebtn = 1;
$('.pagenamesclosebtn').click(function(e) {
	if(pagenamesclosebtn == 1){
		$('.pagenameshidetooltips').hide();
		pagenamesclosebtn = 0 ;	
	} 
});
$('.pagenamestooltip').click(function(e) {
	$('.pagenameshidetooltips').show();
	pagenamesclosebtn = 1 ;
});




// URL Close Button
var urlclosebtn = 1;
$('.urlclosebtn').click(function(e) {
	if(urlclosebtn == 1){
		$('.urlhidetooltips').hide();
		urlclosebtn = 0 ;	
	} 
});
$('.urltooltip').click(function(e) {
	$('.urlhidetooltips').show();
	urlclosebtn = 1 ;
});


</script>
<?php require_once('front_footer.php'); ?>
</body>
</html>