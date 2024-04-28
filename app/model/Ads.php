
<?php


class Ads extends Model{


    protected $table = 'company_ad';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function fetchAds(){
        $sql = 'SELECT company_ad.*, company.company_name, users.user_profile
                FROM company_ad 
                JOIN company ON company.user_id = company_ad.company_id
                JOIN users ON users.user_id = company_ad.company_id
                WHERE company_ad.status = 1';
        $result = mysqli_query($this->connection, $sql);
        $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $ads;
    }

    public function fetchAdsWithId($ad_ids){
        // Ensure $ad_ids is an array and not empty
        if (!is_array($ad_ids) || empty($ad_ids)) {
            throw new InvalidArgumentException("Input must be a non-empty array of ad IDs");
        }
    
        // Prepare the placeholders for the ad IDs in the SQL query
        $placeholders = implode(',', array_fill(0, count($ad_ids), '?'));
    
        // Construct the SQL query
        $query = "SELECT company_ad.*, company.company_name, users.user_profile
                FROM company_ad 
                JOIN company ON company.user_id = company_ad.company_id
                JOIN users ON users.user_id = company_ad.company_id 
                WHERE company_ad.ad_id IN ($placeholders)";
    
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
        

        $query = "SELECT * FROM $this->table";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $ads = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($ads as &$ad) {
            $appliedModel = new Applied();
            $wishlistModel = new Wishlist();

            $ad['applied'] = $appliedModel->hasApplied($userId, $ad['id']);
            $ad['wishlist'] = $wishlistModel->isInWishlist($userId, $ad['id']);
        }

        return $ads;
    }
}
