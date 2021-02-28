<?php
require_once 'library/Model.php';
class Order extends Model {
  public $id;
  public $fullname;
  public $user_id;
  public $address;
  public $mobile;
  public $email;
  public $note;
  public $price_total;
  public $payment_status;
    public function insert(){
        $sql_insert = "INSERT INTO orders(fullname,user_id,address,mobile,email,note,
price_total,payment_status) VALUES (:fullname,:user_id,:address,:mobile,:email,:note,:price_total,:payment_status)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $arr_insert = [
          ':fullname'=>$this->fullname,
          ':user_id'=>$this->user_id,
          ':address'=>$this->address,
          ':mobile'=>$this->mobile,
          ':email'=>$this->email,
          ':note'=>$this->note,
          ':price_total'=>$this->price_total,
          ':payment_status'=>$this->payment_status

        ];
        //do can phai tra ve id vua insert, nen excute khong can phai gan bien
        $obj_insert->execute($arr_insert);//khong tra ve true false
        $order_id=$this->connection->lastInsertId();
        return $order_id;
    }
    public function myOrder($id){
      $obj_get = $this->connection->prepare("SELECT products.title,orders.*,order_details.quantity FROM orders,order_details INNER JOIN products WHERE orders.id = order_details.order_id AND orders.user_id = $id AND order_details.product_id = products.id");
      $obj_get->execute();
      $order_result = $obj_get->fetchALL(PDO::FETCH_ASSOC);
      return $order_result;
    }
    public function userOrder($user_id){
      $obj_get = $this->connection->prepare("SELECT order_details.quantity,products.title,orders.* FROM products,orders INNER JOIN order_details WHERE products.id = order_details.product_id AND products.user_id = :user_id AND orders.id = order_details.order_id");
      $obj_arr = [
        ':user_id'=>$user_id,
      ];
      $obj_get->execute($obj_arr);
      $order_result = $obj_get->fetchALL(PDO::FETCH_ASSOC);
      return $order_result;
    }
}