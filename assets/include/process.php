<?php
session_start();
require_once('config.php');
$action = htmlspecialchars($_REQUEST['action'], ENT_QUOTES);
if($action=='login')
{
$username = htmlspecialchars($_REQUEST['username'], ENT_QUOTES);
$password = htmlspecialchars($_REQUEST['password'], ENT_QUOTES);
$check = mysqli_fetch_array(mysqli_query($connection_to_fivestaradmin,"SELECT * FROM user_login WHERE `user_email`='".$username."'"));
if($username == $check['user_email'] && $password == $check['user_password']){
$_SESSION['member_id'] = $check['id'];
$_SESSION['member_name'] = $check['user_name'];
echo 'match';
}else{
echo 'nomatch';
}
}
if($action=='accountsetting')
{
$firstname = htmlspecialchars($_REQUEST['firstname'], ENT_QUOTES);
$lastname = htmlspecialchars($_REQUEST['lastname'], ENT_QUOTES);
$username = htmlspecialchars($_REQUEST['username'], ENT_QUOTES);
$useremail = htmlspecialchars($_REQUEST['useremail'], ENT_QUOTES);
$userphone = htmlspecialchars($_REQUEST['userphone'], ENT_QUOTES);
$userpassword = htmlspecialchars($_REQUEST['userpassword'], ENT_QUOTES);
$update = mysqli_fetch_array(mysqli_query($connection_to_fivestaradmin,"Update `user_login` SET `f_name` = '" . $firstname . "',`l_name` = '" . $lastname . "',`user_name` = '" . $username . "',`user_password` = '" . $userpassword . "',`user_email` = '" . $useremail . "',`user_role` = 'administrator',`user_phone` = '" . $userphone . "' Where `id` = '1'"));
}
if($action=='newsite')
{
$hostname = htmlspecialchars($_REQUEST['hostname'], ENT_QUOTES);
$siteusername = htmlspecialchars($_REQUEST['siteusername'], ENT_QUOTES);
$siteuserpassword = htmlspecialchars($_REQUEST['siteuserpassword'], ENT_QUOTES);
$databasename = htmlspecialchars($_REQUEST['databasename'], ENT_QUOTES);
$sitelocation = htmlspecialchars($_REQUEST['sitelocation'], ENT_QUOTES);
$siteinsert = mysqli_query($connection_to_fivestaradmin,"INSERT INTO `new_site_register` SET `host_name` = '" . $hostname . "',`site_user_name` = '" . $siteusername . "',`site_user_password` = '" . $siteuserpassword . "',`site_db_name` = '" . $databasename . "',`site_location` = '" . $sitelocation . "'");
if($siteinsert){ echo 'insertsucessfullsite';}
}
if($action=='updatenewsite')
{
$id = htmlspecialchars($_REQUEST['id'], ENT_QUOTES);	
$hostname = htmlspecialchars($_REQUEST['hostname'], ENT_QUOTES);
$siteusername = htmlspecialchars($_REQUEST['siteusername'], ENT_QUOTES);
$siteuserpassword = htmlspecialchars($_REQUEST['siteuserpassword'], ENT_QUOTES);
$databasename = htmlspecialchars($_REQUEST['databasename'], ENT_QUOTES);
$sitelocation = htmlspecialchars($_REQUEST['sitelocation'], ENT_QUOTES);
$updatesite = mysqli_query($connection_to_fivestaradmin,"Update `new_site_register` SET `host_name` = '" . $hostname . "',`site_user_name` = '" . $siteusername . "',`site_user_password` = '" . $siteuserpassword . "',`site_db_name` = '" . $databasename . "',`site_location` = '" . $sitelocation . "' Where `id` = '" . $id . "'");
if($updatesite){ echo 'updatesucessfullsite';}
}
?>