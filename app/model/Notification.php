<?php

class Notification extends Model{
    protected $table = 'notifications';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function fetchNotifs($userId){
        $query = "SELECT * FROM notifications WHERE user_id = ?";
    
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $notifications = $result->fetch_all(MYSQLI_ASSOC);
        
        return $notifications;
    }
}