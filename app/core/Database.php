<?php
class Database {

    private function connect() {
        $string = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

        try {
            $conn = new PDO($string,DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Could not connect to database: " . $e->getMessage());
        }
    }

    public function query($sql, $data = [], $data_type = "object") {
        $conn = $this->connect();
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
?>
