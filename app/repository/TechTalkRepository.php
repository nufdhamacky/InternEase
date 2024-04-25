<?php

    include_once('../app/model/TechTalkModel.php');

    class TechTalkRepository{
        private $conn;
        
        public function __construct($conn){
            $this->conn = $conn;
        }
    
        public function addTechTalk($techTalk) {
            $userId = $techTalk->userId;
            $date = $techTalk->date;
            $duration = $techTalk->duration;
            $startTime = $techTalk->start_time;
            $endTime = $techTalk->end_time;
        
            // Prepare the INSERT statement
            $query = "INSERT INTO tech_talk (user_id, date, duration, start_time, end_time) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->conn, $query);
        
            if (!$stmt) {
                // Provide more detailed error message
                echo "Error: Unable to prepare statement. " . mysqli_error($this->conn) . "\n";
                return false;
            }
        
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "issss", $userId, $date, $duration, $startTime, $endTime);
        
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // Provide more detailed error message
                echo "Error: Unable to execute statement. " . mysqli_error($this->conn) . "\n";
                return false;
            }
        }
        
        }