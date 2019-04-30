<footer>
<div class="container">
<div class="row text-center">
<div class="col-md-12">
<ul class="text-uppercase">
<?php foreach($footer_pages as $menu):  ?>
<li><a href="<?php echo base_url().strtolower(str_replace(' ','-',$menu['page_name'])) ?>"><?php echo $menu['page_name']; ?></a></li>
<?php endforeach; ?>


<?php /*?><li><a href="<?php echo base_url(); ?>">Growing</a></li>
<li><a href="<?php echo base_url(); ?>">Life span</a></li>
<li><a href="<?php echo base_url(); ?>">Non Moulting</a></li>
<li><a href="<?php echo base_url(); ?>">How Active</a></li>
<li><a href="<?php echo base_url(); ?>">Weight</a></li>
<li><a href="<?php echo base_url(); ?>">Size</a></li>
<li><a href="<?php echo base_url(); ?>">Description</a></li>
<li><a href="<?php echo base_url(); ?>">Problems</a></li>
<li><a href="<?php echo base_url(); ?>">Adults</a></li>
<li><a href="<?php echo base_url(); ?>">Training</a></li>
<li><a href="<?php echo base_url(); ?>">Buying a Puppy</a></li><?php */?>


</ul>
<p class="copyright">Copyright &copy; 2016. Peturl. All Right Reserved</p>
<p class="copyright">Website by - <a href="http://www.goagainstthegrain.co.uk/">Against The Grain</a></p>
</div>
</div>
</div>
</footer>
