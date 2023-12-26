<?php   

    class Database {

        public function connection () {

            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            return $conn;
            
        }
 
    }