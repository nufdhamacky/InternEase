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
        $sql = "SELECT s.cv, s.first_name, s.last_name, s.reg_no, ca.position, aa.id, frt.status
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
        $sql = "SELECT s.cv, s.first_name, s.last_name, s.reg_no, ca.position, aa.id, frt.status
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

    public function updateStudentStatus($appliedId, $status) {
        $query = "UPDATE first_round_data SET status = ? WHERE applied_id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('ii', $status, $appliedId);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } else {
            throw new Exception("Statement preparation failed: " . $this->conn->error);
        }
    }

    // public function getShortlistedStudents($companyId){
    //     $query = "SELECT s.cv, s.first_name, s.last_name, s.reg_no, ca.position
    //             FROM student AS s 
    //             JOIN applyadvertisement AS aa ON s.id = aa.applied_by 
    //             JOIN first_round_data AS frt ON frt.applied_id = aa.id 
    //             JOIN company_ad AS ca ON frt.ad_id = ca.ad_id 
    //             WHERE ca.company_id = {$userId} AND ca.ad_id = {$ad_id}";
    // }

    public function getCompanyPosWithCounts($companyId) {
        // SQL query to get the position and the count of associated applications
        $query = "
            SELECT 
                ca.position, 
                COALESCE(COUNT(frd.ad_id), 0) AS application_count
            FROM 
                company_ad ca
            LEFT JOIN 
                first_round_data frd 
            ON 
                ca.ad_id = frd.ad_id AND frd.status = 1
            WHERE 
                ca.company_id = ?
            GROUP BY 
                ca.position
        ";
        
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('i', $companyId);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            // Fetch all results as an associative array
            $companyPositions = $result->fetch_all(MYSQLI_ASSOC);
    
            // Close the statement
            $stmt->close();
            
            return $companyPositions;
        } else {
            throw new Exception("Statement preparation failed: " . $this->conn->error);
        }
    }

    public function fetchShortlistedStuId($companyId){
        $query = "
            SELECT 
                s.id
            FROM 
                student AS s 
            JOIN 
                applyadvertisement AS aa 
            ON 
                s.id = aa.applied_by 
            JOIN 
                first_round_data as frd
            ON 
                frd.applied_id = aa.id 
            JOIN 
                company_ad as ca 
            ON 
                frd.ad_id = ca.ad_id
            WHERE 
                ca.company_id = ?  
                AND frd.status = 1
        ";

        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('i', $companyId);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            // Fetch all results as an associative array
            $students = $result->fetch_all(MYSQLI_ASSOC);
    
            // Close the statement
            $stmt->close();
            
            return $students;

        } else {
            throw new Exception("Statement preparation failed: " . $this->conn->error);
        }
    }

    public function fetchShortlistedStuByPos($companyId, $position){
        $query = "
            SELECT 
                s.*
            FROM 
                student AS s 
            JOIN 
                applyadvertisement AS aa 
            ON 
                s.id = aa.applied_by 
            JOIN 
                first_round_data as frd
            ON 
                frd.applied_id = aa.id 
            JOIN 
                company_ad as ca 
            ON 
                frd.ad_id = ca.ad_id
            WHERE 
                ca.company_id = ? 
                AND ca.position = ? 
                AND frd.status = 1
        ";

        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('is', $companyId, $position);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            // Fetch all results as an associative array
            $students = $result->fetch_all(MYSQLI_ASSOC);
    
            // Close the statement
            $stmt->close();
            
            return $students;

        } else {
            throw new Exception("Statement preparation failed: " . $this->conn->error);
        }

    }
    

    
}
