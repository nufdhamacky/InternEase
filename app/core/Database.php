<?php   

    class Database {

        public function connection () {
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            return $conn;
        }
 
    }