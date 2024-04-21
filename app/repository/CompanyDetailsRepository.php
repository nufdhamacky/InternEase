<?php

include_once('../app/model/CompanyDetailsModel.php');
class CompanyDetailsRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getCompanyDetails($id) {
        $sql = "SELECT * FROM company WHERE user_id = $id";
        $result = $this->conn->query($sql);
    
        if (!$result) {
            // Handle query execution error
            echo "Error: " . $this->conn->error;
            return [];
        }
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $companyDetail = new CompanyDetailsModel(
                    $row['user_id'],
                    $row['company_name'],
                    $row['contact_person'],
                    $row['email'],
                    $row['company_site'],
                    $row['contact_no'],
                    $row['address'],
                    $row['description']
                );
            }
        }
        return $companyDetail;
    }

    public function editCompanyDetails(CompanyDetailsModel $CompanyModel) {

        $sql = "UPDATE company SET company_name = ?, contact_person = ?, email = ?, company_site = ?, contact_no = ?, address = ?, description = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssissi", $CompanyModel->companyname, $CompanyModel->contactperson, $CompanyModel->email, $CompanyModel->website, $CompanyModel->contactno, $CompanyModel->address, $CompanyModel->description, $CompanyModel->userId);
        $stmt->execute();
        $stmt->close();

        if (isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] == 0) {

            $target_dir = ROOT."/assets/profile/";
            $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
            $newFileName = $CompanyModel->userId . '.' . $imageFileType;
            $newFile = $target_dir . $newFileName;

            if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $newFile)) {
                $sql = "UPDATE users SET user_profile = ? WHERE user_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("si", $newFileName, $CompanyModel->userId);
                $stmt->execute();
                $stmt->close();
            }
        }

        return true;
    }
    
}