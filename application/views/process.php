<?php
$action = htmlspecialchars($_REQUEST['action'], ENT_QUOTES);
if($action == 'userlogin'){
$useremail = htmlspecialchars($_REQUEST['useremail'], ENT_QUOTES);
$userpassword = htmlspecialchars($_REQUEST['userpassword'], ENT_QUOTES);
echo 'User Email'.$useremail.' Password'.$userpassword;
}
?>