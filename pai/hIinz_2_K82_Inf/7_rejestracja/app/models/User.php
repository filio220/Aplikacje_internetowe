<?php
	class User {
		private $db;

		public function __construct($dbConfig) {
			try {
				$this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
			} catch(Exception $e) {
				die("Błędne połączenie z bazą danych: ".$e->getMessage());
			}
		}

		public function create($username, $password, $email, $city_id, $birthday) {
			$hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
			$stmt = $this->db->prepare("INSERT INTO users (username, password, email, city_id, birthday) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sssis", $username, $hashedPassword, $email, $city_id, $birthday);
			$result = $stmt->execute();
			$stmt->close();
			return $result;
		}

		public function getCities() {
			$stmt = $this->db->prepare("SELECT id, name FROM cities ORDER BY name ASC");
			$stmt->execute();
			return $stmt->get_result();
		}

	}