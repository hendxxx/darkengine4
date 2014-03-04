<?php	
$time = 86000;
session_set_cookie_params($time);
session_start();

include('config.php');

$url = $_GET['url'];
if (URL_SUFFIX != ""){
	$url = explode(URL_SUFFIX,$url);
}
if (count($url) > 1)
$url = $url[0];
else
$url = $_GET['url'];
 
require_once (ROOT . DS  .'library' . DS . 'bootstrap.php');
