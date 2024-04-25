<?php

include_once('../app/model/AdvertisementModel.php');

class AdvertisementRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    } 


    public function save(AdvertisementModel $advertisement) {
        // Corrected SQL with 11 placeholders
        $sql = "INSERT INTO company_ad (position, requirements, no_of_intern, working_mode, from_date, to_date, company_id, qualification, status, image_url, no_of_cvs_required) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            // Handle the error
            return null;
        }
    
        // Corrected bind_param with 11 variables and type definition string
        $stmt->bind_param(
            'ssisssisiii',  // This should match the types of your fields
            $advertisement->position,
            $advertisement->req, 
            $advertisement->interns,
            $advertisement->workMode,
            $advertisement->fromDate,
            $advertisement->toDate,
            $advertisement->companyId,
            $advertisement->qualification,
            $advertisement->status,
            $advertisement->image_url,
            $advertisement->no_of_cvs_required
        );
    
        // Execute the statement
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
            return null;
        }
    }
    

    public function getAllAdvertisements(): array {
        $companyId = $_SESSION['userId']; 
        $sql = "SELECT * FROM company_ad WHERE company_id='$companyId'";
        $result = $this->conn->query($sql);

        $advertisements = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $advertisement = new AdvertisementModel(
                    $row['position'],
                    $row['requirements'],  // Adjust this based on your database schema
                    $row['no_of_intern'],
                    $row['working_mode'],
                    $row['from_date'],
                    $row['to_date'],
                    $row['company_id'],
                    $row['qualification'],
                    $row['status'],
                    $row['image_url'],
                    $row['no_of_cvs_required']
                );

                $advertisements[] = $advertisement;
            }
        }

        return $advertisements;
    }
    
    
}