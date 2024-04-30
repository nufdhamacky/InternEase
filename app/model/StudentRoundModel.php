<?php


class STudentRoundModel extends Model{


    protected $table = 'company_ad';

    private $connection;

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function fetchRoundDates() {
        $sql = 'SELECT * FROM round';
        $result = mysqli_query($this->connection, $sql);
        $rounds = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $rounds;
    }

    public function countround2() {
        try {
            $query = "SELECT count FROM round WHERE id = 2";
            $stmt = $this->connection->prepare($query);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement.");
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            if (!$result) {
                throw new Exception("Failed to get result.");
            }
            
            $count = $result->fetch_assoc()['count'];
            if ($count === null) {
                throw new Exception("Count not found.");
            }
    
            return (int)$count;
        } catch (Exception $e) {
            // Handle or log the error
            // For simplicity, just returning 0 in case of an error
            return 0;
        }
    }

    public function applySecondRound($studentId){
        
    }
    
}