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
<h4 class="text-uppercase">View Video</h4>
</div>
</section>
<section class="signup">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<iframe width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $vid; ?>" frameborder="0" allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</section>

<?php require_once('front_footer.php'); ?>
</body>
</html>