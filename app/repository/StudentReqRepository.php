<?php

include_once('../app/model/StudentReqModel.php');

class StudentReqRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    } 

    public function getAllRequests(): array {
        $sql = "SELECT * FROM student";
        $result = $this->conn->query($sql);

        $requests = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $request = new StudentReqModel(
                    $row['user_id'], // Assuming user_id is the correct column name
                    $row['first_name'],
                    $row['last_name'],
                    $row['reg_no']
                    // $row['cv']
                );

                $requests[] = $request;
            }
        }

        return $requests;
    }
}
