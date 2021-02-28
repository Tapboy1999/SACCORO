<?php
	session_start(); 
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	include 'config/config.php';
	 
	$ctr = isset($_GET['ctr']) ? $_GET['ctr'] : 'home';
	$act = isset($_GET['act']) ? $_GET['act'] : 'index'; 


	$ctr = ucfirst($ctr).'Controller';
	$path_ctr = BASE_PATH."/controllers/{$ctr}.php";
	if(!file_exists($path_ctr)){
		echo $ctr;
		die ('không tồn tại controller');
	}
	require_once $path_ctr;
	$ob_ac = new $ctr;
	if(!method_exists($ob_ac, $act)){
		die("không tồn tại action");
	}
	$ob_ac->$act();

?>