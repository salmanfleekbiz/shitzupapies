<?php 
$localhost = 'localhost';
$username = 'root';
$pass = '';
$db = 'fivestaradmin';
global $connection_to_fivestaradmin;
$connection_to_fivestaradmin = mysqli_connect($localhost,$username,$pass,$db);
include('function.php');
global $server_url;
$server_url = "http://localhost/fivestaradmin";
global $site_admin_url;
$site_admin_url = $server_url . "/index";
global $site_admin_login_url;
$site_admin_login_url = $server_url . "/login";
global $site_admin_logout_url;
$site_admin_logout_url = $server_url . "/logout";
?>