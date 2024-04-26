<?php
class CompanyStudentRepository extends model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private function executeQuery($sql) {
        $result = $this->conn->query($sql);

        if ($result === false) {
            throw new Exception("Database query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function getStudentRequests() {
        $userId = $_SESSION['userId'];
        $sql = "SELECT s.cv, s.first_name, s.last_name, s.reg_no, ca.position
                FROM student AS s 
                JOIN applyadvertisement AS aa ON s.id = aa.applied_by 
                JOIN first_round_data AS frt ON frt.applied_id = aa.id 
                JOIN company_ad AS ca ON frt.ad_id = ca.ad_id 
                WHERE ca.company_id = {$userId}";
        
        $result = $this->executeQuery($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentRequestsByAd($ad_id) {
        $userId = $_SESSION['userId'];
        $sql = "SELECT s.cv, s.first_name, s.last_name, s.reg_no, ca.position
                FROM student AS s 
                JOIN applyadvertisement AS aa ON s.id = aa.applied_by 
                JOIN first_round_data AS frt ON frt.applied_id = aa.id 
                JOIN company_ad AS ca ON frt.ad_id = ca.ad_id 
                WHERE ca.company_id = {$userId} AND ca.ad_id = {$ad_id}";
        
        $result = $this->executeQuery($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAds($status = 1): array {
        $userId = $_SESSION['userId'];
        $sql = "SELECT ca.ad_id, ca.position 
                FROM company_ad ca 
                WHERE ca.status = '{$status}' AND ca.company_id = '{$userId}'";
        
        $result = $this->executeQuery($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
