<?php

class Applied extends Model {
    protected $table = 'applyadvertisement';

    public function hasApplied($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }

    public function apply($userId, $adId)
    {
        // Check if the user has already applied for the job
        $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingEntry = $result->fetch_assoc();

        if ($existingEntry) {
            // User has already applied for a job
            $appliedId = $existingEntry['id'];

            // Check if the user has already applied for the same ad
            $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
            $stmt2 = $this->connection->prepare($query2);
            $stmt2->bind_param('i', $appliedId);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $existingAdEntry = $result2->fetch_assoc();

            if ($existingAdEntry && $existingAdEntry['ad_id'] == $adId) {
                // User has already applied for this ad, return false
                return false;
            }
        } else {
            // User hasn't applied for any job yet
            // Insert a new entry into the applyadvertisement table
            $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 1)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('ii', $userId, 1);
            $success = $stmt->execute();

            if (!$success) {
                // Failed to insert into the applyadvertisement table
                return false;
            }

            // Get the inserted id
            $appliedId = $stmt->insert_id;
        }

        // Insert a new entry into the first_round_data table
        $query = "INSERT INTO first_round_data (ad_id, applied_id) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ii', $adId, $appliedId);
        $success = $stmt->execute();

        return $success;
    }

    // public function fetchAppliedAdIds($userId){
    //     $query = "SELECT ad_id FROM $this->table WHERE user_id = ?";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('i', $userId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    
    //     $adIds = $result->fetch_all(MYSQLI_ASSOC);
    
    //     // Extract only the ad IDs from the associative arrays
    //     $adIdArray = array_column($adIds, 'ad_id');
    
    //     return $adIdArray;
    // }
    

    public function fetchAppliedAdsCount($userId) {
        $query = "SELECT COUNT(*) AS count FROM $this->table WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        // Return the count value
        return $row['count'];
    }
    
}