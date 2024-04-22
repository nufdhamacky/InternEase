<?php

class Applied extends Model {
    protected $table = 'applied';

    public function hasApplied($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }

    public function apply($userId, $adId){
        $query = "SELECT * FROM $this->table WHERE user_id = ? AND ad_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ii', $userId, $adId);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingEntry = $result->fetch_assoc();

        if ($existingEntry) {
            // Job is already applied to, return false
            return false;
        } else {
            // Insert a new entry into the applied table
            $query = "INSERT INTO $this->table (user_id, ad_id) VALUES (?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('ii', $userId, $adId);
            $success = $stmt->execute();

            return $success;
        }
    }

    public function fetchAppliedAdIds($userId){
        $query = "SELECT ad_id FROM $this->table WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $adIds = $result->fetch_all(MYSQLI_ASSOC);
    
        // Extract only the ad IDs from the associative arrays
        $adIdArray = array_column($adIds, 'ad_id');
    
        return $adIdArray;
    }
    

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