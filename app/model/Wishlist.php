<?php

class Wishlist extends Model {
    protected $table = 'wishlist';

    public function isInWishlist($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }

    public function addToWishlist($userId, $adId) {
        // Check if the entry already exists
        $existingEntry = $this->where('user_id', $userId);
        $existingEntry = $this->where('ad_id', $adId, $existingEntry);
    
        if ($existingEntry->num_rows > 0) {
            // Entry already exists, no need to insert again
            $existingEntry->free_result();
            return;
        }
    
        // Insert logic to add the job to the wishlist in the database
        $data = ['user_id' => $userId, 'ad_id' => $adId];
        $result = $this->insert($data);
    
        if ($result === false) {
            // Log an error if the insertion fails
            error_log('Error inserting into wishlist: ' . print_r($this->errors, true));
        }
    
        $existingEntry->free_result();
    }
}