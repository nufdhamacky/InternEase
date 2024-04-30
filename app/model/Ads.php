
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

        if (!is_array($ad_ids) || empty($ad_ids)) {
            throw new InvalidArgumentException("Input must be a non-empty array of ad IDs");
        }
    

        $placeholders = implode(',', array_fill(0, count($ad_ids), '?'));
    
        $query = "SELECT company_ad.*, company.company_name, users.user_profile
                FROM company_ad 
                JOIN company ON company.user_id = company_ad.company_id
                JOIN users ON users.user_id = company_ad.company_id 
                WHERE company_ad.ad_id IN ($placeholders)";
    
        $stmt = $this->connection->prepare($query);
        
        if (!$stmt) {
            throw new RuntimeException("Failed to prepare the SQL statement.");
        }
    
        $types = str_repeat('i', count($ad_ids)); 
        $stmt->bind_param($types, ...$ad_ids);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            return [];
        }
    
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
