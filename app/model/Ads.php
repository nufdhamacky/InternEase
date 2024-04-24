<?php


class Ads extends Model{


    protected $table = 'company_ad';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function fetchAds(){
        return $this->findall();
    }

    public function fetchAdsWithId($ad_ids){
        // Ensure $ad_ids is an array
        if (!is_array($ad_ids)) {
            throw new InvalidArgumentException("Input must be an array of ad IDs");
        }
    
        // Prepare the placeholders for the ad IDs in the SQL query
        $placeholders = implode(',', array_fill(0, count($ad_ids), '?'));
    
        // Construct the SQL query
        $query = "SELECT * FROM $this->table WHERE ad_id IN ($placeholders)";
    
        // Prepare the statement
        $stmt = $this->connection->prepare($query);
    
        // Bind the ad IDs as parameters
        $types = str_repeat('i', count($ad_ids)); // Assuming ad IDs are integers
        $stmt->bind_param($types, ...$ad_ids);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result set
        $result = $stmt->get_result();
    
        // Fetch all rows
        $ads = $result->fetch_all(MYSQLI_ASSOC);
    
        return $ads;
    }
    
    

    public function fetchAdsWithStatus($userId) {
        $ads = $this->findall();

        foreach ($ads as &$ad) {
            $appliedModel = new Applied();
            $wishlistModel = new Wishlist();

            $ad['applied'] = $appliedModel->hasApplied($userId, $ad['id']);
            $ad['wishlist'] = $wishlistModel->isInWishlist($userId, $ad['id']);
        }

        return $ads;
    }
}