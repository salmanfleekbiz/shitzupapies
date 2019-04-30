<?php
function classActive($name){
	$getname = explode(",",$name);
		if (in_array(substr($_SERVER['PHP_SELF'],15,-4), $getname)) {
    		return 'class="start active"';
		}
}
?>