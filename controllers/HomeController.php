<?php 
require_once 'Controller.php';
require_once BASE_PATH.'/models/Category.php';
require_once BASE_PATH.'/models/Product.php';

class HomeController extends Controller{
	public function __construct(){
		parent::__construct();
	}
 
	public function render($file, $valiables = []){
		extract($valiables);
		ob_start();
		require_once $file;
		$render_view = ob_get_clean();
		return $render_view;
		
	}
	public function index(){
		
		$get_all_products = new Product();
		$result_products = $get_all_products->getAllProduct();
		$result_hot = $get_all_products->getProductHot();

		$this->content = $this->render('./views/home/home.php',[
			'products' => $result_products,
			'product_hot'=>$result_hot,
		]);

		require_once './views/layouts/main.php';
	}

}


?>