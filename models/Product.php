<?php 

require_once BASE_PATH."/library/Model.php";
class Product extends Model
{

	public $id;
	public $category_id;
	public $title;
	public $avatar;
	public $price;
	public $sales;
	public $amount;
	public $content;
	public $status_hot;
	public $create_at;

	public function getAllProduct(){
		$obj_select = $this->connection->prepare('SELECT * FROM products ORDER BY id DESC');
		$arr_select = [];
		$obj_select->execute($arr_select);
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
	}
	public function getProductbyCategoryId(){
		$obj_select = $this->connection->prepare('SELECT * FROM products WHERE category_id = :id');
		$arr_select = [
			':id'=>$this->category_id,
		];
		$obj_select->execute($arr_select);
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
	}
	public function getProductById(){
		$obj_select = $this->connection->prepare("SELECT * FROM products WHERE id=:id");
		$arr_select = [
			':id' => $this->id,
		];
		$obj_select->execute($arr_select);
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
	}
	public function getProductHot(){
		$obj_select = $this->connection->prepare("SELECT * FROM products WHERE status_hot = 1 ORDER BY id DESC LIMIT 4 ");
		$arr_select = [];
		$obj_select->execute($arr_select);
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
	}
	public function create($user_id){
		$obj_create = $this->connection->prepare("INSERT INTO products (category_id, title, avatar, price, sales, amount, status_hot, content, user_id) VALUES (:category_id, :title, :avatar, :price, :sales, :amount, :status_hot, :content, :user_id)");
		$arr_create = [
			':category_id' => $this->category_id,
			':title' => $this->title,
			':avatar' => $this->avatar,
			':price' => $this->price,
			':sales' => $this->sales,
			':amount' => $this->amount,
			':status_hot' => $this->status_hot,
			':content' => $this->content,
			':user_id' => $user_id,
		];
		$obj_create->execute($arr_create);
		return $obj_create;
	}
	public function getProductByUserId($id){
		$obj_select = $this->connection->prepare("SELECT products.*,categories.name FROM products,categories WHERE user_id = :id and products.category_id = categories.id");
		$arr_select = [':id'=>$id];
		$obj_select->execute($arr_select);
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
	}
	public function getById($id){
	    $obj_select = $this->connection
	      ->prepare("SELECT products.*, categories.name AS category_name FROM products 
	          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

	    $obj_select->execute();
	    return $obj_select->fetch(PDO::FETCH_ASSOC);
  	}
  	public function mylist($user_id,$category_id){
  		$obj_select = $this->connection->prepare("SELECT products.*, categories.key_seach,categories.name FROM categories,products WHERE products.category_id = categories.id AND products.user_id = :user_id AND products.category_id = :category_id");
		$arr_select = [':user_id'=>$user_id,
			':category_id' => $category_id
		];
		$obj_select->execute($arr_select);
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
  	}
  	public function delete($id){
        $obj_delete = $this->connection->prepare("DELETE FROM order_details WHERE product_id = $id");
        $obj_delete->execute();
        $obj_delete = $this->connection->prepare("DELETE FROM products WHERE id = $id");
        return $obj_delete->execute();
    }
    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE products SET category_id=:category_id, title=:title, avatar=:avatar, price=:price,sales = :sales,amount=:amount,content=:content, status_hot=:status_hot WHERE id = $id
		");
        $arr_update = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':sales' =>$this->sales,
            ':amount' => $this->amount,
            ':content' => $this->content,
            ':status_hot' => $this->status_hot,
        ];
        return $obj_update->execute($arr_update);
    }
    public function updateamount(){
    	$obj_update = $this->connection
            ->prepare("UPDATE products SET amount=:amount WHERE id = :id
		");
        $arr_update = [
            ':amount' => $this->amount,
            ':id' =>$this->id,
        ];
        return $obj_update->execute($arr_update);
    }
    public function search($string){
    	$obj_select = $this->connection->prepare("SELECT * FROM `products` WHERE `title` LIKE '%$string%'");
		$obj_select->execute();
		$products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $products;
    }


    
}






?>