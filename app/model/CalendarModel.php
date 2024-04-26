<?php

class CalendarModel extends Model {

    protected $table = 'events';

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function addEvent()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the JSON request body
        $requestBody = file_get_contents('php://input');
        $requestData = json_decode($requestBody, true);

        if (isset($requestData["date"]) && isset($requestData["title"]) && isset($requestData["description"])) {
            $date = $requestData["date"];
            $title = $requestData["title"];
            $description = $requestData["description"];

            // Insert event into database
            $sql = "INSERT INTO events (date, title, description) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("sss", $date, $title, $description);
            $stmt->execute();

            // Check if the query was successful
            if ($stmt->affected_rows > 0) {
                echo json_encode(["message" => "Event added successfully"]);
            } else {
                echo json_encode(["error" => "Failed to add event"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Missing POST parameters"]);
        }
    }
}

public function deleteEvent()
{
    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        // Retrieve event ID from URL
        $eventId = $_GET["id"];

        // Delete event from database
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $eventId);
        $stmt->execute();

        // Send response based on the result
        if ($stmt->affected_rows > 0) {
            echo json_encode(["message" => "Event deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete event"]);
        }

        $stmt->close();
    }
}
}