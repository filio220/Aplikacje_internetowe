<?php
  require_once 'db.php';

	class Model {
		private $db;

		public function __construct(){
			$this->db = dbConnect();
		}

		public function saveData($firstName, $lastName){
			$stmt = $this->db->prepare('INSERT INTO user (firstName, lastName) VALUES (?, ?)');
			$stmt->bind_param('ss', $firstName, $lastName);
			$stmt->execute();
			$stmt->close();
		}
	}
?>