<?php

// include_once('../app/model/CompanyDetailsModel.php');
class CompanyDetailsRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getCompanyDetails($id): array {
        $sql = "SELECT company_name, website, logo, address, website FROM company INNER JOIN users ON users.user = company.email";
        $result = $this->conn->query($sql);
    
        if (!$result) {
            // Handle query execution error
            echo "Error: " . $this->conn->error;
            return [];
        }
    
        $companyDetails = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $companyDetail = new CompanyDetailsModel(
                    $row['userId'],
                    $row['companyname'],
                    $row['contactperson'],
                    $row['email'],
                    $row['website'],
                    $row['contactno'],
                    $row['logo'],
                    $row['address'],
                    $row['description']
                );
    
                $companyDetails[] = $companyDetail;
            }
        }
    
        return $companyDetails;
    }
    
}