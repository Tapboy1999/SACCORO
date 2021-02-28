<?php
//frontend/controllers/CartController.php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller {

    public function index()
    {
       //         echo "<pre>";
       // print_r($_POST);
       // echo "</pre>";
        if (isset($_POST['submit'])){
            foreach ($_SESSION['cart'] as $product_id=>$cart){
                if ($_POST[$product_id]<0){
                    $_SESSION['error']="So luong phai >0";
//                    $url_redirect = $_SERVER['SCRIPT_NAME'].'/gio-hang-cua-ban';
                    header('Location:gio-hang-cua-ban.html');
                    exit();
                }
            }
            
            //lap cac phan tu trong gio hang
            //gan lai so luong
            foreach ($_SESSION['cart'] as $product_id=>$cart){
                $_SESSION['cart'][$product_id]['quantity']= $_POST[$product_id];

            }
            $_SESSION['success'] = "Cap nhat gio hang thanh cong";
        }
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $product_id=>$cart){
                if($cart['quantity']>$cart['amount']){
                    $this->error = "Mặt hàng bạn chọn không đủ số lượng";
                }
            }
        }
        $this->content = $this->render('views/carts/index.php');
        require_once 'views/layouts/main.php';
    }


    //Phương thức nhận request từ ajax để xử lý thêm vào
    // giỏ hàng
    public function add() {
        $product_id = $_GET['product_id'];
        $product_model = new Product();
        $product = $product_model->getById($product_id);
        // + Tạo 1 mảng để chứa các thông tin cần thiết của
        //giỏ hàng là name, price, avatar
        $cart = [
            'name' => $product['title'],
            'price' => $product['sales'],
            'avatar' => $product['avatar'],
            'amount' => $product['amount'],
            //mặc định số lượng ban đầu = 1
            'quantity' => 1
        ];
        // + Xây dựng giỏ hàng sử dụng SESSION, với key=cart
        // - Nếu giỏ hàng chưa từng tồn tại trước đó, khi click
//        Thêm vào giỏ -> thêm mới 1 giỏ hàng
        if (!isset($_SESSION['cart'])) {
            //Thêm phần tử vào giỏ hàng luôn có format:
            //product_id => thông-tin-giỏ-hàng-tương-ứng
            $_SESSION['cart'][$product_id] = $cart;
        } else {
            // - Nếu giỏ hàng đã tồn tại rồi thì sẽ tồn tại 2
            // trường hơp, sử dụng ham array_key_exists để
            //kiểm tra xem key có tồn tại trong 1 mảng hay ko

            // + Thêm sản phẩm chưa từng tồn tại trong giỏ:
            //xử lý tương tự trường hợp thêm mới sp vào giỏ
            if (!array_key_exists($product_id, $_SESSION['cart'])) {
                $_SESSION['cart'][$product_id] = $cart;
            } else {
                $_SESSION['cart'][$product_id]['quantity']++;
                // + Thêm sản phẩm đã tồn tại trong giỏ rồi: ko
                //thêm mới sản phẩm mà update lại số lượng sản phẩm
                //dang có sẵn, bằng cách cộng thêm 1
            }
        }

    }
    public function delete(){
        $prodct_id = $_GET['id'];
        unset($_SESSION['cart'][$prodct_id]);
        //kiem tra neu xoa het san pham thi xoa luon cai gio hang do di
        if (empty($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
        $_SESSION['success']= "Xoa san pham thanh cong";
        header('Location:gio-hang-cua-ban.html');
        exit();
    }
}