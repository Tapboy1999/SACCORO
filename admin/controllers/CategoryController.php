<?php 
include 'Controller.php';
include BASE_PATH.'/models/Category.php';

class CategoryController extends Controller{
	
	public function render($file, $valiables = []){
		extract($valiables);
		ob_start();
		require_once $file;
		$render_view = ob_get_clean();
		return $render_view;
		 
	}
	




}



?>