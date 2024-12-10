<?php

class ComplaintModel extends Model{
    protected $table = 'complaint';

    private $connection;

    public function __construct() {
        $this->connection = $this->connection();
    }
    
    public function createStudentComplaint($userId, $description){
        $query = "INSERT INTO complaint('user_id', 'description') VALUES ('?','')";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('is', $userId, $description);
        $stmt->execute(); 
    }
}