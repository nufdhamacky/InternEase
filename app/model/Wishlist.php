<?php

class Wishlist extends Model {
    protected $table = 'wishlist';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function addToWishlist($userId, $adId) {
        $query = "SELECT * FROM $this->table WHERE user_id = ? AND ad_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ii', $userId, $adId);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingEntry = $result->fetch_assoc();

        if ($existingEntry) {
            // Job is already in the wishlist, return false
            return false;
        } else {
            // Insert a new entry into the wishlist table
            $query = "INSERT INTO $this->table (user_id, ad_id) VALUES (?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('ii', $userId, $adId);
            $success = $stmt->execute();

            return $success;
        }
    }

    public function fetchWishlistedAdIds($userId){
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

}
?>