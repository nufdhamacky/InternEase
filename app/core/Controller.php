<?php

    class Controller {

        public $database;
        public $conn;

        //dependency injection - passing database connection to controller
        public function __construct() {
            $this->database = new Database();
            $this->conn = $this->database->connection();
        }

        //function to load model
        public function model($model) {
            require ('../model/' . $model . '.php');
            return new $model();
        }


        //function to load view
        public function view($view, $data = []) {
            extract($data);
            
            require ('../view/' . $view . '.view.php');
        }

    }  