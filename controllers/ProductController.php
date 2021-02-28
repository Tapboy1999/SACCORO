<?php  
require_once BASE_PATH."/controllers/Controller.php";
require_once BASE_PATH."/models/Product.php";
require_once BASE_PATH."/models/Category.php";
require_once BASE_PATH."/models/Order.php";
class ProductController extends Controller
{	
	private $product_model;
	private $category_model;
	public function __construct(){
		parent::__construct();
		$this->product_model = new Product;
		$this->category_model = new Category();
	}
	public function search(){
		if(isset($_POST['search'])){
			$search = Helper::filler($_POST['Search']);
			$search_product = $this->product_model->search($search);
			if(empty($search_product)){
				$this->error = "Không tìm thấy sản phẩm phù hợp";
			}
			$this->content = $this->render("./views/products/seach.php",[
				"products"=>$search_product,
			]);
			require "./views/layouts/main.php";
		}
	}
	// lấy sản phẩm thuộc category
	public function list(){
		if(isset($_GET['id'])){
			$this->product_model->category_id = $_GET['id'];
			$this->category_model->id = $_GET['id'];
			$result_product_cate = $this->product_model->getProductbyCategoryId();
			$result_category = $this->category_model->getCategoryById();
			$this->content = $this->render('./views/products/product_category.php',[
				'products'=>$result_product_cate,
				'categories'=>$result_category,
			]);
			require './views/layouts/main.php';
		}
	}
	public function mylist(){
		if(isset($_GET['id'])){
			$this->product_model->category_id = $_GET['id'];
			$id = $_GET['id'];
			$result_product_cate = $this->product_model->mylist($_SESSION['userlogin']['id'],$id);
			$this->content = $this->render('./views/products/myproduct.php',[
				'myProducts'=>$result_product_cate,
			]);
			require './views/layouts/myshop.php';
		}
	}
	public function detail(){
		if(isset($_GET['id'])){
			$this->product_model->id = $_GET['id'];
			$result_products = $this->product_model->getProductById();
			$this->content = $this->render('./views/products/detail.php',[
				'products' => $result_products,

			]);
			require './views/layouts/main.php';
		}
	}
	public function hotlist(){
		$result_products_hot = $this->product_model->getAllProduct();
		$this->content = $this->render("./views/products/product_hot.php",['products'=>$result_products_hot]);
		require "./views/layouts/main.php";
	}
	public function myProduct(){
		if(!isset($_SESSION['userlogin'])){
			$_SESSION['continue'] = 'myProduct';
			header('Location:dang-nhap.html');
			exit();
		}else{
			$myId = $_SESSION['userlogin']['id'];
			$myProducts = $this->product_model->getProductByUserId($myId);
			$this->content = $this->render("./views/products/myproduct.php",[
				'myProducts'=>$myProducts,
			]);
			require_once "./views/layouts/myshop.php";	
		}	
	}
	public function userOrder(){
		if(!isset($_SESSION['userlogin'])){
			$_SESSION['continue'] = 'shop';
			header('Location:dang-nhap.html');
			exit();
		}
		$id = $_SESSION['userlogin']['id'];
		$order_model = new Order();
		$re_myOder = $order_model->userOrder($id);
		$this->content = $this->render("./views/order/useroder.php",['userOrders'=>$re_myOder,]);
		require_once "./views/layouts/myshop.php";
	}
	public function create(){
    //xử lý submit form
    if (isset($_POST['addPr'])) {
      	
      	$title = Helper::filler($_POST['title']);
      	$price = str_replace(",", "", $_POST['price']);
      	$sales = str_replace(",", "", $_POST['sales']);
      	$amount = $_POST['amount'];
	    $content = Helper::filler($_POST['content']);
	    //$create_at = $_POST['create_at'];
      	//xử lý validate
      	if(!is_numeric($price) || !is_numeric($sales)){
      		$this->error = "Dữ liệu không hợp lệ";
      	}
      	if (empty($title) || empty($price) || empty($sales) || empty($amount) || empty($content)) {
        	$this->error = 'Bạn cần nhập đủ thông tin';
      	}else{
      		if(!isset($_POST['statushot']) || !isset($_POST['category_id']) || $_FILES['avatar']['name']==null){
      			$this->error = 'Bạn cần nhập đủ thông tin';
      		}
	      	else {

	      		$category_id = $_POST['category_id'];
	      		$status_hot = $_POST['statushot'];
	      		if ($_FILES['avatar']['error'] == 0) {
		        	//validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng khôngg quá 2 Mb
			        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			        $extension = strtolower($extension);
			        $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

			        $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
			        //làm tròn theo đơn vị thập phân
			        $file_size_mb = round($file_size_mb, 2);

			        if (!in_array($extension, $arr_extension)) {
			          $this->error = 'Cần upload file định dạng ảnh';
			        } else if ($file_size_mb > 2) {
			          $this->error = 'File upload không được quá 2MB';
			        }
      			}
      		}
      	}


      // if(!empty($this->error)){
      // 	echo $this->error;
      // }

      //nếu ko có lỗi thì tiến hành save dữ liệu
      if (empty($this->error)) {
        $filename = '';
        //xử lý upload file nếu có 
        if ($_FILES['avatar']['error'] == 0) {
          $dir_uploads = BASE_PATH . '/assets/uploads/products';
          if (!file_exists($dir_uploads)) {
            mkdir($dir_uploads);
          }
          //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
          $filename = time() . '-product-' . $_FILES['avatar']['name'];
          move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
        }
        //save dữ liệu vào bảng products
        //$product_model = new Product();
        $this->product_model->category_id = $category_id;
        $this->product_model->title = $title;
        $this->product_model->avatar = $filename;
        $this->product_model->price = $price;
        $this->product_model->sales = $sales;
        $this->product_model->amount = $amount;
        $this->product_model->content = $content;
        $this->product_model->status_hot = $status_hot;


        $is_insert = $this->product_model->create($_SESSION['userlogin']['id']);
        if ($is_insert) {
          $_SESSION['success'] = 'Thêm dữ liệu thành công';
        } else { 
          $_SESSION['error'] = 'Thêm dữ liệu thất bại';
        }
        header('Location: index.php?ctr=product&act=myProduct');
        exit();
      }
    }

	    //lấy danh sách category đang có trên hệ thống để phục vụ cho search
	    // $category_model = new Category();
	    $categories = $this->category_model->getAllCategory();

	    $this->content = $this->render('views/products/create.php', [
	        'categories' => $categories
	    ]);
	    require_once 'views/layouts/myshop.php';
  	}

  	public function update(){
  		$id = $_GET['id'];
  		$products = $this->product_model->getById($id);
    //xử lý submit form
    	if (isset($_POST['update'])) {
      	
      	$title = Helper::filler($_POST['title']);
      	$price = $_POST['price'];

      	$price = str_replace(",", "", $_POST['price']);
      	$sales = str_replace(",", "", $_POST['sales']);
      	$amount = $_POST['amount'];
	    $content = Helper::filler($_POST['content']);
	    //$create_at = $_POST['create_at'];
      	//xử lý validate
      	if(!is_numeric($price) || !is_numeric($sales)){
      		$this->error = "Dữ liệu không hợp lệ";
      	} 
   		if (empty($title) || empty($price) || empty($sales) || empty($amount) || empty($content)) {
        	$this->error = 'Bạn cần nhập đủ thông tin';
      	}else{
      		if(!isset($_POST['statushot']) || !isset($_POST['category_id'])){
      			$this->error = 'Bạn cần nhập đủ thông tin';
   			}
	      	else {

	      		$category_id = $_POST['category_id'];
	      		$status_hot = $_POST['statushot'];
	      		if ($_FILES['avatar']['error'] == 0) {
		        	//validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng khôngg quá 2 Mb
			        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			        $extension = strtolower($extension);
			        $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

			        $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
			        //làm tròn theo đơn vị thập phân
			        $file_size_mb = round($file_size_mb, 2);

			        if (!in_array($extension, $arr_extension)) {
			          $this->error = 'Cần upload file định dạng ảnh';
			        } else if ($file_size_mb > 2) {
			          $this->error = 'File upload không được quá 2MB';
			        }
      			}
      		}
      	}


      // if(!empty($this->error)){
      // 	echo $this->error;
      // }

      //nếu ko có lỗi thì tiến hành save dữ liệu
     	if (empty($this->error)) {
     		if( $_FILES['avatar']['name']==null){
     			$filename = $products['avatar'];
     		}else{
        		$filename = '';
        //xử lý upload file nếu có 
        	if ($_FILES['avatar']['error'] == 0) {
	          	$dir_uploads = BASE_PATH . '/assets/uploads/products';
	          	if (!file_exists($dir_uploads)) {
	            	mkdir($dir_uploads);
	          	}
	          //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
	          	$filename = time() . '-product-' . $_FILES['avatar']['name'];
	          	move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
	        	}
	    	}
	        //save dữ liệu vào bảng products
	        //$product_model = new Product();
	        $this->product_model->category_id = $category_id;
	        $this->product_model->title = $title;
	        $this->product_model->avatar = $filename;
	        $this->product_model->price = $price;
	        $this->product_model->sales = $sales;
	        $this->product_model->amount = $amount; 
	        $this->product_model->content = $content;
	        $this->product_model->status_hot = $status_hot;


	        $is_insert = $this->product_model->update($id); 
	        if ($is_insert) {
	          	$_SESSION['success'] = 'Cập nhật thành công';
	        } else { 
	          	$_SESSION['error'] = 'Cập nhật thất bại';
	        }
		        header('Location: index.php?ctr=product&act=myProduct');
		        exit();	
	    }
    }

	    //lấy danh sách category đang có trên hệ thống để phục vụ cho search
	    // $category_model = new Category();
    $categories = $this->category_model->getAllCategory();
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // var_dump($products);
    $this->content = $this->render('views/products/update.php', [
        'categories' => $categories,
        'products' => $products,
    ]);
    require_once 'views/layouts/myshop.php';
  	}

  	public function delete(){

	    // if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	    //   $_SESSION['error'] = 'ID không hợp lệ';
	    //   header('Location: index.php?ctr=product&act=myProduct');
	    //   exit();
	    // }

	    $id = $_GET['product_id'];
	    $is_delete = $this->product_model->delete($id);
	    if ($is_delete) {
	      $_SESSION['success'] = 'Xóa dữ liệu thành công';
	    } else {
	      $_SESSION['error'] = 'Xóa dữ liệu thất bại';
	    }
	    header('Location: index.php?ctr=product&act=myProduct');
	    exit();
  	}
    
}






?>