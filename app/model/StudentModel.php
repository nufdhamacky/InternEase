<?php

class StudentModel extends Model{
    
    public function getStudentByUserId($userId) {
        $query = "SELECT * FROM students WHERE user_id = ?";
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
        $query = "UPDATE students SET $updateFields WHERE user_id = ?";
        $this->query($query, $updateValues);
    }
}