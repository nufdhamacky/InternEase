<?php

class ComplaintModel extends Model{
    protected $table = 'complaint';

    private $connection;

    public function __construct() {
        $this->connection = $this->connection();
    }
    
    public function createStudentComplaint($userId, $description) {
        $query = "INSERT INTO complaint(user_id, description) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('is', $userId, $description);
        $success = $stmt->execute();

        return $success;
    }

    public function fetchStudentComplaint($userId){
        $query = "SELECT description FROM complaint where user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row;
    }
}