<?php
class Model extends Database {
    protected $table;
    protected $connection;

    public $errors = array();

    public function __construct() {
        // parent::__construct(); 

        $this->connection = $this->connection(); // Initialize the connection
        if (!property_exists($this, 'table')) {
            $this->table = strtolower($this::class);
        }
    }

    public function query($query, $bindings) {
        try {
            $stmt = $this->connection->prepare($query);
    
            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . $this->connection->error);
            }
    
            // Bind parameters
            if (!empty($bindings)) {
                $types = str_repeat('s', count($bindings));
                $stmt->bind_param($types, ...$bindings);
            }
    
            $stmt->execute();
    
            // Fetch results
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
    
            $stmt->close();
    
            return $data;
        } catch (Exception $e) {
            // Handle database error, log, or return an error message as needed
            die("Database Error: " . $e->getMessage());
        }
    }
    
    // find value by where condition
    // public function where($column, $value) {
    //     $query = "SELECT * FROM $this->table WHERE $column = :value";
    //     return $this->query($query, [
    //         'value' => $value
    //     ]);
    // }
    public function where($column, $value, $result = null) {
        $query = "SELECT * FROM $this->table WHERE $column = ?";
        if ($result !== null) {
            $query = $result->prepare() . " AND $column = ?";
        }
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        return $stmt->get_result();
    }

    // get all data
    public function findall() {
        $query = "SELECT * FROM $this->table ";
        return $this->query($query, []);
    }

    // insert data
    public function insert($data) {
        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
            
            $stmt = $this->connection->prepare($query);
    
            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . $this->connection->error);
            }
    
            // Bind parameters
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            $stmt->execute();
    
            // Check for errors during execution
            if ($stmt->errno !== 0) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
    
            $stmt->close();
            return true;
        } catch (Exception $e) {
            // Log the detailed error message
            error_log('Database Error: ' . $e->getMessage());
    
            // Set the error property for further analysis
            $this->errors[] = $e->getMessage();
            
            return false;
        }
    }

    // update data
    public function update($id, $idcolumn, $data) {
        $bindings = array();
        $setClause = "";
        foreach ($data as $key => $value) {

            $setClause .= "$key = :$key";
    
            $bindings[":$key"] = $value;
    
            if ($key !== array_key_last($data)) {
                $setClause .= ", ";
            }
        }
    
        $query = "UPDATE $this->table SET $setClause WHERE $idcolumn = :id";

        $bindings[':id'] = $id;

        return $this->query($query, $bindings);
    }

    // delete data
    public function delete($id, $idcolumn) {

        $query = "DELETE FROM $this->table WHERE $idcolumn = :id";

        $bindings = [':id' => $id];

        return $this->query($query, $bindings);
    }


    public function loadWithSort($sortColumn, $sortType) {

        $query = "SELECT * FROM $this->table ORDER BY $sortColumn $sortType";
        
        return $this->query($query, []);

    }
    
    // get distinct items
    public function getDistinct($column) {
        $query = "SELECT DISTINCT $column FROM $this->table";
        return $this->query($query, []);
    }

    // get min or max
    public function getMinMax($column, $minmax) {
        $query = "SELECT $minmax($column) FROM $this->table";
        return $this->query($query, []);
    }
    
}
?>

