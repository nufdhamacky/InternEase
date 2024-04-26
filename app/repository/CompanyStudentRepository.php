<?php

class CompanyStudentRepository extends model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getStudentRequests() {
        $userId = $_SESSION['userId'];
        $sql = "SELECT s.cv, s.first_name, s.last_name, s.reg_no, ca.position
                FROM student AS s 
                JOIN applyadvertisement AS aa ON s.id = aa.applied_by 
                JOIN first_round_data AS frt ON aa.id = frt.applied_id 
                JOIN company_ad AS ca ON frt.ad_id = ca.ad_id 
                WHERE ca.company_id = {$userId};";
        $result = $this->query($sql);

        return $result;
    }

    public function getAds($status = 1): array {
        $sql = "SELECT ca.* FROM company_ad ca WHERE ca.status = '{$status}'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC); // Adjust fetching method if needed
    }
}