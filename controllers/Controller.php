<?php 
require_once BASE_PATH.'/models/Category.php';
require_once BASE_PATH."/helpers/Helper.php";
class Controller {
	public $headers;
	public $content; 
	public $error; 
	public $menushop;

	public function __construct(){

		$get_category = new Category();
		$get_category_result = $get_category->getAllCategory();
		 
		$this->headers = $this->render('./views/layouts/header.php',[
			'categories' => $get_category_result, 
		]);
		$this->menushop = $this->render('./views/layouts/menushop.php',[
			'categories' => $get_category_result, 
		]);
		
		// require "./views/layouts/main.php";
	}

	public function render($file, $valiables = []){
		extract($valiables);
		ob_start();
		require_once $file;
		$render_view = ob_get_clean();
		return $render_view;
		
	}
}



?>