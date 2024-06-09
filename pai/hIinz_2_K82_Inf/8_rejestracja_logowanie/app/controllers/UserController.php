<?php
	require_once BASE_PATH . '/app/models/User.php';
	require_once BASE_PATH . '/app/models/City.php';

	class UserController {
		private $userModel;

		public function __construct() {
			$this->userModel = new User(require BASE_PATH . '/app/config/database.php');
		}

		public function register() {
			$errors = [];
			$data = [];

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				//print_r($_POST);

				$data['username'] = htmlspecialchars(trim($_POST['username']));
				$data['password'] = htmlspecialchars(trim($_POST['password']));
				$data['email'] = htmlspecialchars(trim($_POST['email']));
				$data['city'] = htmlspecialchars(trim($_POST['city']));
				$data['birthday'] = htmlspecialchars(trim($_POST['birthday']));

				if (empty($data['username']) || !preg_match('/^[a-zA-Z0-9]{5,}$/', $data['username'])) {
					$errors['username'] = 'Nazwa użytkownika jest nieprawidłowa';
				}

				if (empty($data['password']) || strlen($data['password']) < 8) {
					$errors['password'] = 'Hasło nie spełnia wymagań';
				}

				if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$errors['email'] = 'Email jest nieprawidłowy';
				}

				//print_r($errors);

				if (empty($errors)) {
					$hash = password_hash($data['password'], PASSWORD_ARGON2ID);
					$this->userModel->create($data['username'], $data['city'], $hash, $data['email'], $data['birthday']);
				}
			}

			require_once BASE_PATH . '/app/views/register.php';
		}

		public function login() {
			$errors = [];
			$data = [];

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				//print_r($_POST);

				$data['email'] = htmlspecialchars(trim($_POST['email']));
				$data['password'] = htmlspecialchars(trim($_POST['password']));
				

				if (empty($data['email'])) {
					$errors['username'] = 'Nazwa użytkownika jest pusta';
				}

				if (empty($data['password'])) {
					$errors['password'] = 'Hasło użytkownika jest puste';
				}

				

				if (empty($errors)) {
					// $hash = password_hash($data['password'], PASSWORD_ARGON2ID);
					// $this->userModel->create($data['username'], $data['city'], $hash, $data['email'], $data['birthday']);
					$email = $_POST['email'];
					$password = $_POST['password'];
					$this->userModel->login($email, $password);
				} else{
					print_r($errors);
				}
			}

			require_once BASE_PATH . '/app/views/login.php';
		}

		public function getCities() {
			$cityModel = new City(require BASE_PATH . '/app/config/database.php');
			$cities = [];
			$result = $cityModel->getCities();
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					$cities[] = $row;
				}
			}
			return $cities;
		}

	}