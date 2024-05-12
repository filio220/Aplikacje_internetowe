<?php
// Kontroler zarządzający logiką biznesową

require_once 'model.php';

class Controller {
    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
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

    private function submitData() {
        // Przetwarzanie danych z formularza
        $data = $_POST['data'] ?? '';
        // Zapisz dane do bazy danych
        $this->model->saveData($data);
        $this->viewData(); // Wywołanie widoku danych po zapisie
    }

    private function viewData() {
        // Pobierz dane z bazy danych za pomocą modelu
        $data = $this->model->getData();
        require 'view_data.php'; // Wywołanie widoku tabeli z danymi
    }

    private function showDetails() {
        $id = $_GET['id'] ?? 0;
        $details = $this->model->getDetails($id);
        require 'view_details.php';
    }
}
