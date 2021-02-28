<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'models/Product.php';
require_once 'controllers/ProductController.php';

class PaymentController extends Controller {


  public function index() {
      //xu ly submit form, khi user click tanh toan
      if(!isset($_SESSION['userlogin'])){
        header('Location:dang-nhap.html');
        exit();
      }
      foreach ($_SESSION['cart'] as $product_id=>$cart){
        if($cart['quantity']>$cart['amount']){
          header('location: gio-hang-cua-ban.html');
          die;
        }
      }
      if (isset($_POST['submit'])){
          $fullname = Helper::filler($_POST['fullname']);
          $address = Helper::filler($_POST['address']);
          $mobile = Helper::filler($_POST['mobile']);
          $email = Helper::filler($_POST['email']);
          $note = Helper::filler($_POST['note']);
          $method = $_POST['method'];
          $user_id = $_SESSION['userlogin']['id'];
          if(!is_numeric($mobile) & $mobile != 10 ){
            $this->error = "SDT khong hop le";
          }else if (empty($fullname) || empty($address) || empty($mobile) ||empty($email)){
              $this->error = "Fullname hoac address hoac mobile hoac email khong duoc trong";
          }else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
              $this->error = "Email khong dung dinh dang";
          }
          if (empty($this->error)){
              //luu thong tin don hang vao bang order khi click thanh toan
              $order_model = new Order();
              $order_model->fullname = $fullname;
              $order_model->user_id = $user_id;
              $order_model->address = $address;
              $order_model->mobile = $mobile;
              $order_model->email = $email;
              $order_model->note = $note;
              //xu li phan payment_status: trang thai thanh toan don hang
              //mac dinh la chua thanh toan
              //co chuc nang update lai
              $order_model->payment_status=0;
              //xu li truong price_total: tong gia tri don hang
              $price_total=0;
              foreach ($_SESSION['cart'] as $product_id=>$cart){
                  $price_total+=$cart['sales']*$cart['quantity'];
              }
                $order_model->price_total=$price_total;
              //xay dung phuong thuc insert tra va kieu mang 
              $order_id = $order_model->insert();
//              var_dump($order_id);
              //luu tiep vang bang order_detail
              $order_detai_model = new OrderDetail();
              $product_model = new Product();
                //lap gio hang luu cac thong tin ve product_id va quantity
              foreach ($_SESSION['cart']as $product_id=>$cart){
                  $order_detai_model->order_id= $order_id;
                  $order_detai_model->product_id= $product_id;
                  $order_detai_model->quantity= $cart['quantity'];
                  $is_insert=$order_detai_model->insert();
                  // update so luong sp
                  $product_model->amount = $cart['amount'] - $cart['quantity'];
                  $product_model->id= $product_id;
                  $is_insert_pr = $product_model->updateamount();

//                  var_dump($is_insert);

              }
              // gui mail cho khach hang
             $this->sendMails($email);
              //neu thanh toan truc tuyen, thi chuyen huong toi trang ngan luong
              if ($method==0){
                  $_SESSION['payment_info']=[
                      'price_total'=>$price_total,
                      'fullname'=>$fullname,
                      'email'=>$email,
                      'mobile'=>$mobile
                  ];
                  header('Location:order-online.html');
                  exit();
              }else{
                  //chuyen ve trang cam on

                  header('Location:order-success.html');
                  exit();
              }
          }
      }
    //Lấy nội dung view payment
    $this->content = $this->render('views/payments/index.php');
    //Gọi layout để hiển thị nội dung view vừa lấy đc
    require_once 'views/layouts/main.php';

  }

  public function sendMails($email){
    $to_email = $email;
    $subject = "SACCORO THANKS";
    $body = "Cảm ơn bạn đã mua hàng bạn có thể kiểm tra đơn hàng của mình tại ".BASE_ULR."/don-hang-cua-toi.html";
    $headers = "From: thanhpham@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
      $_SESSION['email'] = "Email successfully sent to $to_email...";
    } else {
      $this->error =  "Email sending failed...";
    }
  }
    //hien thi trang thanh toan ngan luong
    public function online(){
      $this->content=$this->render('config/nganluong/index.php');
      //co the tao 1 trang khac cho trang thanh toan online
      echo $this->content;
    }
    public function thank(){
      $this->content=$this->render('./views/payments/thank.php');
      //co the tao 1 trang khac cho trang thanh toan online
      require "./views/layouts/main.php";
    }
}