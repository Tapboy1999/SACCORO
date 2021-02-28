<?php 

	require_once BASE_AD."/config/Database.php";

	class Model{
		public $connection;
		public function __construct(){
			$this->connection = $this->getConnection();
		}

		public function getConnection(){
			try{
				$connection = new PDO(Database::DB_DSN,Database::DB_USERNAME,Database::DB_PASSWORD);
			}
			catch(PDOExeption $e){
				die("Connection false" . $e->getMessage());
			}
			return $connection;
		}

		public function closeConnection(){
			$this->connection = null;
		}
	}


?>