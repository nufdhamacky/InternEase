<?php

class StudentCompanyModel extends Model{
    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function getCompanyById($companyId) {
        // Prepare the SQL query
        $query = "SELECT * FROM company WHERE user_id = ?";
        
        // Prepare the statement
        $stmt = $this->connection->prepare($query);
        
        // Bind parameters
        $stmt->bind_param('i', $companyId);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the company record
        $result = $stmt->get_result();

        $company = $result->fetch_all(MYSQLI_ASSOC);
        
        return $company;
    }
    
    // You can add more methods for company-related operations here
}
?>