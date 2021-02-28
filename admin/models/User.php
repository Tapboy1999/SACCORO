<?php 
require_once BASE_PATH."/library/Model.php";

class User extends Model{
	public $id;
	public $username;
	public $password;
	public $full_name;
	public $lever;
	public $phone;
	public $address;
	public $email; 
	public $avatar;
	public $created_at;


	public function __construct(){
		parent::__construct();
        if (isset($_GET['username']) && !empty($_GET['username'])) {
            $username = addslashes($_GET['username']);
            $this->str_search .= " AND users.username LIKE '%$username%'";
        }
	}
	public function getUserByUsernameAndPassword($username , $password){
		$obj_select = $this->connection->prepare('SELECT * FROM admins WHERE username = :username AND password = :password');
		$arr_select = [
			':username' => $username,
			':password' => $password,
		];
		$obj_select->execute($arr_select);
		$user = $obj_select->fetch(PDO::FETCH_ASSOC);
		return $user;
	} 


}	
?>