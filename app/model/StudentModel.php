<?php

class StudentModel extends Model{
    protected $table = 'student';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }
    
    public function getStudentByUserId($userId) {
        $query = "SELECT * FROM student WHERE user_id = ?";
        $result = $this->query($query, [$userId]);
        return $result[0] ?? null;
    }

    public function updateStudent($userId, $data) {
        $updateFields = '';
        $updateValues = [];
        
        // Construct the SET clause for the SQL query
        foreach ($data as $key => $value) {
            $updateFields .= "$key = ?, ";
            $updateValues[] = $value;
        }
        // Remove trailing comma and space
        $updateFields = rtrim($updateFields, ', ');
        
        // Add the user ID to the update values array
        $updateValues[] = $userId;

        // Update the student record in the database
        $query = "UPDATE student SET $updateFields WHERE user_id = ?";
        $this->query($query, $updateValues);
    }

    public function get_student_id_with_user_id($userId){
        $query = "SELECT id FROM $this->table WHERE user_id=?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['id'];
        
        return $result;
    }
}