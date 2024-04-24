<?php

include_once('../app/model/StudentReqModel.php');

class StudentReqRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    } 

    public function getAllRequests(): array {
        // Corrected the SQL query with proper INNER JOIN clauses
        $sql = "SELECT 
            student.user_id, 
            student.first_name,
            student.last_name,
            student.reg_no
        FROM 
            student
        INNER JOIN 
            applyadvertisement 
        ON 
            student.user_id = applyadvertisement.applied_by
        INNER JOIN
            company_ad
        ON
            company_a.ad_id = applyadvertisement.ad_id";  // Added JOIN condition

        $result = $this->conn->query($sql);

        $requests = [];

        if ($result && $result->num_rows > 0) {  // Check if result is valid before accessing num_rows
            while ($row = $result->fetch_assoc()) {
                $request = new StudentReqModel(
                    $row['user_id'], 
                    $row['first_name'],
                    $row['last_name'],
                    $row['reg_no']  
                );

                $requests[] = $request;
            }
        } else {
            // Handle the case where query fails or returns no results
            error_log("Query failed or returned no results: " . $this->conn->error);
        }

        return $requests;
    }
}
