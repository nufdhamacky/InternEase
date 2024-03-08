<?php

class Wishlist extends Model {
    protected $table = 'wishlist';

    public function isInWishlist($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }

    public function addToWishlist($userId, $adId) {
        // Check if the entry already exists
        $existingEntry = $this->where('user_id', $userId)->where('ad_id', $adId);
    
        if (!empty($existingEntry)) {
            // Entry already exists, no need to insert again
            return;
        }
    
        // Insert logic to add the job to the wishlist in the database
        $data = ['user_id' => $userId, 'ad_id' => $adId];
        $result = $this->insert($data);
    
        if ($result === false) {
            // Log an error if the insertion fails
            error_log('Error inserting into wishlist: ' . print_r($this->errors, true));
        }
    }
}