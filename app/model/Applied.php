<?php

class Applied extends Model {
    protected $table = 'first_round_data';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function hasApplied($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }

    // public function apply($userId, $adId)
    // {
    //     // Check if the user has already applied for the job
    //     $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('i', $userId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $existingEntry = $result->fetch_assoc();

    //     if ($existingEntry) {
    //         // User has already applied for a job
    //         $appliedId = $existingEntry['id'];

    //         // Check if the user has already applied for the same ad
    //         $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
    //         $stmt2 = $this->connection->prepare($query2);
    //         $stmt2->bind_param('i', $appliedId);
    //         $stmt2->execute();
    //         $result2 = $stmt2->get_result();
    //         $existingAdEntry = $result2->fetch_assoc();

    //         if ($existingAdEntry && $existingAdEntry['ad_id'] == $adId) {
    //             // User has already applied for this ad, return false
    //             return false;
    //         }
    //     } else {
    //         // User hasn't applied for any job yet
    //         // Insert a new entry into the applyadvertisement table
    //         $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 1)";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param('ii', $userId, 1);
    //         $success = $stmt->execute();

    //         if (!$success) {
    //             // Failed to insert into the applyadvertisement table
    //             return false;
    //         }

    //         // Get the inserted id
    //         $appliedId = $stmt->insert_id;
    //     }

    //     // Insert a new entry into the first_round_data table
    //     $query = "INSERT INTO first_round_data (ad_id, applied_id) VALUES (?, ?)";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('ii', $adId, $appliedId);
    //     $success = $stmt->execute();

    //     return $success;
    // }

    public function apply($studentId, $adId)
    {
        // Check if the user has already applied for any job
        $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
        $stmt = $this->connection->prepare($query);
        
        $stmt->bind_param('i', $studentId);
        $stmt->execute();
        
        $result = $stmt->get_result();

    
        $existingEntries = $result->fetch_all(MYSQLI_ASSOC);
    
        foreach ($existingEntries as $existingEntry) {
            $appliedId = $existingEntry['id'];
    
            // Check if the user has already applied for the same ad
            $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
            $stmt2 = $this->connection->prepare($query2);
            
            if (!$stmt2) {
                // Handle the error if prepare() fails
                return false;
            }
    
            $stmt2->bind_param('i', $appliedId);
            $stmt2->execute();
            
            $result2 = $stmt2->get_result();
    
            if (!$result2) {
                // Handle the error if get_result() fails
                return false;
            }
    
            $existingAdEntry = $result2->fetch_assoc();
    
            if ($existingAdEntry && $existingAdEntry['ad_id'] == $adId) {
                // User has already applied for this ad, return false
                return false;
            }
        }
    
        // If the loop completes without finding a match, insert new entries
        $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 1)";
        $stmt = $this->connection->prepare($query);
        
        if (!$stmt) {
            // Handle the error if prepare() fails
            return false;
        }
        
        $stmt->bind_param('i', $studentId);
        $success = $stmt->execute();
    
        if (!$success) {
            // Failed to insert into the applyadvertisement table
            return false;
        }
    
        // Get the inserted id
        $appliedId = $stmt->insert_id;
    
        // Insert a new entry into the first_round_data table
        $query = "INSERT INTO first_round_data (ad_id, applied_id) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        
        if (!$stmt) {
            // Handle the error if prepare() fails
            return false;
        }
        
        $stmt->bind_param('ii', $adId, $appliedId);
        $success = $stmt->execute();
    
        return $success;
    }
    


    

    // public function apply($userId, $adId){
    //     $query = "SELECT * FROM $this->table WHERE applied_by = ? AND ad_id = ?";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('ii', $userId, $adId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $existingEntry = $result->fetch_assoc();

    //     if($existingEntry){
    //         return false;
    //     }
    //     else {
    //         $query = "INSERT INTO $this->table (applied_by, ad_id) VALUES (?, ?)";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param('ii', $userId, $adId);
    //         $success = $stmt->execute();

    //         return $success;
    //     }
    // }

    public function fetchAppliedAdIds($studentId){

        $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $existingEntries = $result->fetch_all(MYSQLI_ASSOC);
        $appliedAdIds = [];

        foreach($existingEntries as $existingEntry){
            $appliedId = $existingEntry['id'];

            $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
            $stmt2 = $this->connection->prepare($query2);
            
    
            $stmt2->bind_param('i', $appliedId);
            $stmt2->execute();
            
            $result2 = $stmt2->get_result();
    
    
            $appliedAdEntry = $result2->fetch_assoc();

            if ($appliedAdEntry) {
                $appliedAdIds[] = $appliedAdEntry['ad_id'];
            }
    
        }
    
        return $appliedAdIds;
    }
    

    

    public function fetchAppliedAdsCount($studentId){

        $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $existingEntries = $result->fetch_all(MYSQLI_ASSOC);

        foreach($existingEntries as $existingEntry){
            $appliedId = $existingEntry['id'];

            $query2 = "SELECT COUNT(DISTINCT ad_id) AS count FROM first_round_data WHERE applied_id = ?";
            $stmt2 = $this->connection->prepare($query2);
            
    
            $stmt2->bind_param('i', $appliedId);
            $stmt2->execute();
            
            $result2 = $stmt2->get_result();
    
    
            $appliedAdsCount = $result2->fetch_assoc();

            
    
        }

        return $appliedAdsCount['count'];
    }
    
    
}