<?php
  require_once 'model.php';

	class Controller {
		private $model;

		public function __construct() {
			$this->model = new Model();
		}

		public function handleRequest(){
			$action = $_GET['action'] ?? 'home';
			//echo $action;

			switch($action){
				case 'submit':
					$this->submitData();
					break;
				case 'view':
					$this->viewData();
					break;
				case 'details':
					$this->showDetails();
					break;
				default:
					$this->showForm();
					break;
			}
		}

		private function showForm() {
			require 'view_form.php';
		}

		private function submitData(){
			$firstName = $_POST['firstName'] ?? '';
			$lastName = $_POST['lastName'] ?? '';
			$this->model->saveData($firstName, $lastName);
		}
	}
?>