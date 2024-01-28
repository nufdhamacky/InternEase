<?php   

    class Database {

        public function connection () {

            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            return $conn;
            
        }

        public function query($sql, $data = [], $data_type = "object") {
            $conn = $this->connection();
            $stmt = $conn->prepare($sql);
    
            if ($stmt) {
                try {
                    $check = $stmt->execute($data);
    
                    if ($check) {
                        if ($data_type == "object") {
                            return $stmt->fetchAll(PDO::FETCH_OBJ);
                        } else {
                            return $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                    
                    if (is_array($data) && count($data)> 0) {
                        return $data;
                    }
                
                    }
                } catch (PDOException $e) {
                    die("Database query failed: " . $e->getMessage());
                }
            }
    
            return false;
        }
 
    }