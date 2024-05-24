<?php
// Model zarządzający danymi

require_once 'db.php';

class Model {
    private $db;

    public function __construct() {
        $this->db = dbConnect();
    }

    public function saveData($data) {
        $stmt = $this->db->prepare('INSERT INTO user (firstName) VALUES (?)');
        $stmt->bind_param('s', $data);
        $stmt->execute();
        $stmt->close();
    }

    public function getData() {
        $stmt = $this->db->prepare('SELECT * FROM user');
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $result->free();
        $stmt->close();
        return $data;
    }

    public function getDetails($id) {
        $stmt = $this->db->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
