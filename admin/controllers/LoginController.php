<?php 
require_once 'Controller.php';
require_once '../library/Model.php';
require_once 'models/User.php';
class LoginController{
	private $content;
	private $error;
	public function render($file, $variables = []){
		extract($variables);
		ob_start();
		require_once $file;
		$render_view = ob_get_clean();
		return $render_view;
	}
	public function login(){
		if(isset($_SESSION['user'])){
			header('Location: index.php?controller=category&action=index');
			exit();
		}
		if(isset($_POST['submit'])){
			$username = $_POST['username'];
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
					$SESSION['success'] = "Đăng nhập thành công";
					$SESSION['user'] = $user;
					// header('Location: index.php?controller=login$action=login');
					$this->content = $this->render("views/layouts/main.php"); 
					require "views/layouts/main.php";
					exit();
				}
			}

		}
		$this->content = $this->render("views/admin/login.php"); 
		require "views/layouts/main_login.php";

	}
	
}


 ?>