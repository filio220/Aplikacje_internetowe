<?php
    class User {
        private $db;

        public function __construct($dbConfig){
            try {
                $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
            } catch(Exception $e) {
                die("Błędne połączenie z bazą danych: " . $e->getMessage());
            }
        }
    }
?>