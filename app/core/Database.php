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
                if (!empty($data)) {
                    $types = str_repeat('s', count($data));
                    $stmt->bind_param($types, ...$data);
                }

                $check = $stmt->execute();

                if ($check) {
                    $result = $stmt->get_result();

                    if ($result) {
                        if ($data_type == "object") {
                            return $result->fetch_all(MYSQLI_ASSOC);
                        } else {
                            return true;  // Adjust this based on your needs
                        }
                    } else {
                        return false;
                    }
                }
            } catch (mysqli_sql_exception $e) {
                die("Database query failed: " . $e->getMessage());
            }
        }

        return false;
    }
 
}