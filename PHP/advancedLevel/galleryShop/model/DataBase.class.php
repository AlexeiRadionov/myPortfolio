<?php
	class DataBase {
		const HOST = 'localhost';
		const USER = 'root';
		const PASS = '';
		const DB = 'gallery';

		private static $instance;
		private $db;

		public function getDb() {
			return $this -> db;
		}

		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new self();
			}
			
			return self::$instance;
		}

		private function __construct() {
			try {
			setlocale(LC_ALL, 'ru_RU.UTF8');	
			$this->db = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB, self::USER, self::PASS);
			$this->db->exec('SET NAMES UTF8');

			} catch (PDOException $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	 
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}

		public function getAssocResult($sql) {
			$query = $this->db->prepare($sql);
			$query->execute();

			if($query->errorCode() != PDO::ERR_NONE){
				$info = $query->errorInfo();
				die($info[2]);
			}

			return $query->fetchAll();
		}

		public function executeQuery($sql){
			$query = $this->db->prepare($sql);
			$query->execute();

			if($query->errorCode() != PDO::ERR_NONE){
				$info = $query->errorInfo();
				die($info[2]);
			}

			return $query->rowCount();
		}
	}
?>