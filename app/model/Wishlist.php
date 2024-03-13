<?php

class Wishlist extends Model {
    protected $table = 'wishlist';

    public function isInWishlist($userId, $adId) {
        $result = $this->where('user_id', $userId)->where('ad_id', $adId);
        return !empty($result);
    }

    public function addToWishlist($userId, $adId) {
        try {
            // Check if the entry already exists
            $existingEntryQuery = $this->where('user_id', $userId)->where('ad_id', $adId);
            $existingEntry = $existingEntryQuery->fetch_all(MYSQLI_ASSOC);
            $existingEntryQuery->free();
    
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
                throw new Exception('Error inserting into wishlist');
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log or display error message)
            error_log('Exception in addToWishlist: ' . $e->getMessage());
            // You might want to re-throw the exception to let the caller handle it
            throw $e;
        }
    }
    
    
    
    
    
}
?>
