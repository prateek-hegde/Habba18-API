<?php
date_default_timezone_set('Asia/Calcutta');
require_once './core/class.user.php';
$user = new User();

$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

//do something with this information
if( $webOS || $Android ){
    header('Location: https://play.google.com/store/apps/details?id=com.acharya.habbaregistration');
}
?>