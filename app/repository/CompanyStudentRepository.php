<?php

class CompanyStudentRepository {
    private $conn;


    public function __construct($conn) {
        $this->conn = $conn;
        
    } 

    // public function getAllRequests(): array {
    //     // Corrected the SQL query with proper INNER JOIN clauses
    //     $sql = "SELECT 
    //         student.user_id, 
    //         student.first_name,
    //         student.last_name,
    //         student.reg_no
    //     FROM 
    //         student
    //     INNER JOIN 
    //         applyadvertisement 
    //     ON 
    //         student.user_id = applyadvertisement.applied_by
    //     INNER JOIN
    //         company_ad
    //     ON
    //         company_a.ad_id = applyadvertisement.ad_id";  // Added JOIN condition

    //     $result = $this->conn->query($sql);

    //     $requests = [];

    //     if ($result && $result->num_rows > 0) {  // Check if result is valid before accessing num_rows
    //         while ($row = $result->fetch_assoc()) {
    //             $request = new StudentReqModel(
    //                 $row['user_id'], 
    //                 $row['first_name'],
    //                 $row['last_name'],
    //                 $row['reg_no']  
    //             );

    //             $requests[] = $request;
    //         }
    //     } else {
    //         // Handle the case where query fails or returns no results
    //         error_log("Query failed or returned no results: " . $this->conn->error);
    //     }

    //     return $requests;
    // }

    public function getStudentRequests() {
        $userId = $_SESSION['userId'];
        
        $sql = "
        SELECT 
        s.cv,s.first_name, s.last_name, s.reg_no , ca.position
        FROM student AS s 
        JOIN applyadvertisement AS aa ON s.id = aa.applied_by 
        JOIN first_round_data AS frt ON aa.id = frt.applied_id 
        JOIN company_ad AS ca ON frt.ad_id = ca.ad_id 
        WHERE ca.company_id = {$userId};
        ";

        $result =$this->conn->query($sql);

        $requests = [];        

        return $requests;
        
  
    }
}
