<?php 

	require_once BASE_PATH."/library/Model.php";

	class User extends Model{
		public $id;
		public $username;
		public $password;
		public $full_name;
		public $phone;
		public $address;
		public $email; 
		public $avatar;
		public $status;
		public $created_at;


	public function __construct(){
		parent::__construct();
        if (isset($_GET['username']) && !empty($_GET['username'])) {
            $username = addslashes($_GET['username']);
            $this->str_search .= " AND users.username LIKE '%$username%'";
        }
	}
	public function getUserByUsernameAndPassword($username , $password){
		$obj_select = $this->connection->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
		$arr_select = [
			':username' => $username,
			':password' => $password,
		];
		$obj_select->execute($arr_select);
		$user = $obj_select->fetch(PDO::FETCH_ASSOC);
		return $user;
	} 
	public function getUserByUsername($username){
        $obj_select = $this->connection
            ->prepare("SELECT COUNT(id) FROM users WHERE username='$username'");
        $obj_select->execute();
        return $obj_select->fetchColumn();
	}
	public function createUsers(){
		$obj_create = $this->connection->prepare('INSERT INTO users (username, password, full_name, phone, address, email) VALUES (:username, :password, :full_name, :phone, :address, :email)');
		$arr_create = [
			':username' => $this->username,
			':password' => $this->password,
			':full_name' => $this->full_name,
			':phone' => $this->phone,
			':address' => $this->address,
			':email' => $this->email,

		];
		return $obj_create->execute($arr_create);
	}
	public function updateUser($id){
		$obj_update = $this->connection->prepare('UPDATE users SET full_name = :full_name, phone=:phone, address=:address, email=:email ,avatar = :avatar WHERE id = :id');
		$arr_update = [
			':full_name' => $this->full_name,
			':phone' => $this->phone,
			':address' => $this->address,
			':email' => $this->email,	
			':avatar' => $this->avatar,
			':id' => $id		
		];
		return $obj_update->execute($arr_update);
	}


	}



?>