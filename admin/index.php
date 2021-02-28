<?php 
	include '../config/config.php';
	// Khởi tạo session
	session_start();
	// Lấy controller và action trên url
	$controller = isset($_GET['controller']) ? $_GET['controller'] : 'category';
	$action = isset($_GET['action']) ? $_GET['action'] : 'index'; 
	// Tạo đường dẫn
	$controller  = ucfirst($controller)."Controller";
	$path_controller = BASE_AD."/controllers/{$controller}.php";
	
	if(!file_exists($path_controller)){
		die("Trang không tồn tại");
	}
	require_once $path_controller;
	$object = new $controller;
	if(!method_exists($object, $action)){
		die('không tồn tại action $action');
	}
	$object->$action();
   

?>