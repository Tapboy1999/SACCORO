<?php 
require_once 'Controller.php';
require_once BASE_PATH.'/models/User.php';
require_once BASE_PATH.'/models/Order.php';

class UserController extends Controller{ 
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
	public function login(){
		if(isset($_SESSION['userlogin'])){
			header('Location: trang-chu.html');
			exit();
		}
		if(isset($_POST['userlogin'])){ 
			$username = Helper::filler($_POST['username']);
			$password = md5($_POST['password']);
			if(empty($username) || empty($password)){
				$this->error = "tài khoản hoặc mật khẩu không được để trống";
			}
			$user_model = new User();
			if(empty($this->error)){
				$user = $user_model->getUserByUsernameAndPassword($username,$password);
				
				if(empty($user)){
					$this->error = "Sai tài khoản hoặc mật khẩu, vui lòng thử lại";
				}
				else{
					foreach ($user as $key=>$value) {
						$user[$key] = $value;
					}
					if($user['status'] == 0){
						$this->error = "Tài khoản của bạn bị khóa vui lòng liên hệ admin để được hỗ trợ";
						
					}
					else{
						$_SESSION['success'] = "Đăng nhập thành công";
						$_SESSION['userlogin'] = $user;
						if($_SESSION['continue']){
							$continue = $_SESSION['continue'];
							switch ($continue) {
								case 'myProduct':
									header('Location: index.php?ctr=product&act=myProduct');
									exit();
								
								default:
									# code...
									break;
							}
						}
						header('Location: trang-chu.html');
						exit(); 
					} 
				}
			}

		}
		$this->content = $this->render("views/users/login.php"); 
		require "views/layouts/main.php";
	}

	public function create(){
		if(isset($_SESSION['userlogin'])){
			header('Location: trang-chu.html');
			exit();
		}
		if(isset($_POST['register'])){
			$username = Helper::filler($_POST['re_username']);
			$password = Helper::filler($_POST['re_password']);
			$confirm = Helper::filler($_POST['re_confirmpass']);
			$full_name = Helper::filler($_POST['re_fullname']);
			$email = $_POST['re_email'];
			$phone = $_POST['re_phone'];
			$address = Helper::filler($_POST['re_address']);

			if($password != $confirm){
				$this->error = "Mật khẩu không khớp";
			}
			else{
				$user_model = new User();
				$user_model->username = $username;
				$user_model->password = md5($password);
				$user_model->full_name = $full_name;
				$user_model->email = $email;
				$user_model->phone = $phone;
				$user_model->address = $address;
				if(!empty($username)){
					$user_log = $user_model->getUserByUsername($username);
					if($user_log){
						$this->error = "Tài khoản đã tồn tại";
					}
					else{
						$is_user = $user_model->createUsers();
						$_SESSION['success'] = "Tạo tài khoản thành công";
						header("Location: dang-nhap.html");
						exit();
					}
				}
			}
		}
		$this->content = $this->render("views/users/register.php");
		require "views/layouts/main.php";

	}
	public function update(){

		if(isset($_POST['update'])){
			$full_name = Helper::filler($_POST['re_fullname']);
			$email = $_POST['re_email'];
			$phone = $_POST['re_phone'];
			$address = Helper::filler($_POST['re_address']);
			if ($_FILES['useravatar']['error'] == 0) {
		        	//validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng khôngg quá 2 Mb
			        $extension = pathinfo($_FILES['useravatar']['name'], PATHINFO_EXTENSION);
			        $extension = strtolower($extension);
			        $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

			        $file_size_mb = $_FILES['useravatar']['size'] / 1024 / 1024;
			        //làm tròn theo đơn vị thập phân
			        $file_size_mb = round($file_size_mb, 2);

			        if (!in_array($extension, $arr_extension)) {
			          $this->error = 'Cần upload file định dạng ảnh';
			        } else if ($file_size_mb > 2) {
			          $this->error = 'File upload không được quá 2MB';
			        }
      		}
			if(!is_numeric($phone) || strlen($phone) != 10){
				$this->error = "Số điện thoại không hợp lệ";
			}
			if(empty($this->error))
			{
				$user_model = new User();
				$filename = "default_avt.png";
				
				if ($_FILES['useravatar']['error'] == 0) {
          			$dir_uploads = BASE_PATH . '/assets/uploads/users';
          			if (!file_exists($dir_uploads)) {
            			mkdir($dir_uploads);
          			}
          			//tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
          			$filename = time() . '-avatar-' . $_FILES['useravatar']['name'];
          			move_uploaded_file($_FILES['useravatar']['tmp_name'], $dir_uploads . '/' . $filename);
        		}
        		$user_model->full_name = $full_name;
				$user_model->email = $email;
				$user_model->phone = $phone;
				$user_model->address = $address;
				$user_model->avatar = $filename;
				$is_user = $user_model->updateUser($_SESSION['userlogin']['id']);
				$user = $user_model->getUserByUsernameAndPassword($_SESSION['userlogin']['username'],$_SESSION['userlogin']['password']);
				$_SESSION['userlogin'] = $user;
				$_SESSION['success'] = "Cập nhật tài khoản thành công";
				header("Location: trang-chu.html");
				exit();
				}
			}
		
		$this->content = $this->render("views/users/update.php");
		require "views/layouts/main.php";
	}
	public function shop(){
		if(!isset($_SESSION['userlogin'])){
			$_SESSION['continue'] = 'shop';
			header('Location:dang-nhap.html');
			exit();
		}else{
			require_once "./views/users/myshop.php";
		}
	}

	public function myOrder(){
		if(!isset($_SESSION['userlogin'])){
			$_SESSION['continue'] = 'shop';
			header('Location:dang-nhap.html');
			exit();
		}
		$id = $_SESSION['userlogin']['id'];
		$order_model = new Order();
		$re_myOder = $order_model->myOrder($id);
		$this->content = $this->render("./views/users/myorder.php",['myOrders'=>$re_myOder,]);
		require_once "./views/layouts/main.php";
	}
	
	public function logout(){
		session_unset();
		header("Location: trang-chu.html");
		exit();
	}
}

?>