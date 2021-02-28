<?php 

include BASE_PATH."/library/Model.php";

class Category extends Model{
	public $id;
	public $name;
	public $description;
	public $status;
	public $create_at;
	public $update_at;

	public function getAllCategory(){
		$obj_select = $this->connection->prepare("SELECT * FROM categories WHERE status = 1 ORDER BY id DESC"); 
		$arr_select = [];
		$obj_select->execute($arr_select);
		$categories = $obj_select->fetchALL(PDO::FETCH_ASSOC);
		return $categories;
	}
	public function getCategoryById(){
		$obj_select = $this->connection->prepare("SELECT * FROM categories WHERE id = :id LIMIT 1");
		$arr_select = [':id'=>$this->id];
		$obj_select->execute($arr_select);
		$category = $obj_select->fetchAll(PDO::FETCH_ASSOC);
		return $category;
	}


}





 ?>