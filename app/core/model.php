<?php
class Model extends Database {
    protected $table;

    public $errors = array();

    public function __construct() {
        if (!property_exists($this, 'table')) {
            $this->table = strtolower(get_called_class());
        }
    }
    
    // find value by where condition
    public function where($column, $value) {
        $query = "SELECT * FROM $this->table WHERE $column = :value";
        return $this->query($query, [
            'value' => $value
        ]);
    }

    public function setTable($table) {
        $this->table = $table;
    }

    // get all data
    public function findall() {
        $query = "SELECT * FROM $this->table ";
        return $this->query($query, []);
    }

    public function getTable() {
        return $this->table;
    }

    // insert data
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), "?"));
        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
    
        return $this->query($query, array_values($data), 'object');
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
