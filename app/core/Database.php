<?php   

    class Database {

        private $conn = null;

        public function connection () {
          
            if ($this->conn === null) {
              
                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            }
            return $conn;
        }

           

       
        public function query($sql, $data = [], $data_type = "object") {
            $conn = $this->connection();
            $stmt = $conn->prepare($sql);
        
            if ($stmt) {
                try {
                    if (!empty($data)) {
                        // Bind parameters for positional placeholders (?)
                        if (is_array($data)) {
                            $types = str_repeat('s', count($data));
                            $stmt->bind_param($types, ...$data);
                        } else {
                            // Bind parameters for named placeholders (:name)
                            foreach ($data as $param => &$value) {
                                $stmt->bind_param('s', $value);
                            }
                        }
                    }
        
                    $check = $stmt->execute();
        
                    if ($check) {
                        $result = $stmt->get_result();
        
                        if ($result) {
                            if ($data_type == "object") {
                                return $result->fetch_all(MYSQLI_ASSOC);
                            } else {
                                // Return the result count
                                return $result->num_rows;
                            }
                        } else {
                            // Return true if the query executed successfully with no result set
                            return true;
                        }
                    }
                } catch (mysqli_sql_exception $e) {
                    die("Database query failed: " . $e->getMessage());
                }
            }
        
            return false;
        }
        
 
}