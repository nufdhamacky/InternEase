<?php

include_once('../app/model/AdvertisementModel.php');

class AdvertisementRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    } 

    // public function save(AdvertisementModel $advertisement) : ?AdvertisementModel{
    //     $sql = "INSERT INTO company_ad(ad_id, position, requirements, no_of_intern, working_mode, from_date, to_date, company_id, qualification) VALUES({$advertisement->adId}, '{$advertisement->position}','{$advertisement->req}', {$advertisement->interns}, '{$advertisement->workMode}', '{$advertisement->fromDate}', '{$advertisement->toDate}', {$advertisement->companyId}, '{$advertisement->qualification}')";
    //     $result = $this->conn->query($sql);

    //     if($result == TRUE){
    //         return $advertisement;
    //     }
    //     else{
    //         return null;
    //     }

    // } 

    public function save(AdvertisementModel $advertisement): ?AdvertisementModel {
        $sql = "INSERT INTO company_ad (position, no_of_intern, working_mode, from_date, to_date, company_id, qualification) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            // Handle the error, return null or throw an exception
            return null;
        }
    
        // Bind parameters with data types
        $stmt->bind_param('sisssis', $advertisement->position, $advertisement->interns, $advertisement->workMode, $advertisement->fromDate, $advertisement->toDate, $advertisement->companyId, $advertisement->qualification);
    
        // Execute the statement
        $result = $stmt->execute();
    
        if ($result) {
            return $advertisement;
        } else {
            // Handle the error, return null or throw an exception
            return null;
        }
    }
    
    
}