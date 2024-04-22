<?php

include_once('../app/model/AdvertisementModel.php');

class AdvertisementRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    } 


    public function save(AdvertisementModel $advertisement) {

        $sql = "INSERT INTO company_ad (position, requirements, no_of_intern, working_mode, from_date, to_date, company_id, qualification) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            // Handle the error, return null or throw an exception
            return null;
        }
    
        // Bind parameters with data types
        $stmt->bind_param('ssisssis',$advertisement->position,$advertisement->req, $advertisement->interns, $advertisement->workMode, $advertisement->fromDate, $advertisement->toDate, $advertisement->companyId, $advertisement->qualification);
        // Execute the statement
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        } else {
            // Handle the error, return null or throw an exception
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
                    $row['qualification']
                );

                $advertisements[] = $advertisement;
            }
        }

        return $advertisements;
    }
    
    
}