<?php

class InterviewModel extends Model {
    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function getAllInterviews(){
        $query = "SELECT i.*, t.*
                FROM interviews AS i
                JOIN time_slots AS t
                ON i.interview_id = t.interview_id";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $interviews = $result->fetch_all(MYSQLI_ASSOC);

        return $interviews;

    }

    public function addInterview($date, $startTime, $endTime, $title, $description, $candidateCount, $studentIds)
    {
        // Get the company ID from the session
        $company_id = $_SESSION['userId'];

        // Insert the interview record into the `interviews` table
        $query = "INSERT INTO interviews (company_id, title, description, candidate_count)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("issi", $company_id, $title, $description, $candidateCount);

        if ($stmt->execute()) {
            // Retrieve the ID of the inserted interview
            $interview_id = $this->connection->insert_id;

            // Insert into the `time_slots` table with the retrieved interview ID
            $query = "INSERT INTO time_slots (interview_id, interview_date, start_time, end_time)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("isss", $interview_id, $date, $startTime, $endTime);

            if ($stmt->execute()) {
                // Retrieve the slot_id of the inserted time slot
                $slot_id = $this->connection->insert_id;

                // Insert into the `student_interview_slots` table for each student ID
                $query = "INSERT INTO student_interview_slots (slot_id, student_id) VALUES (?, ?)";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("ii", $slot_id, $student_id);

                foreach ($studentIds as $student_id) {
                    // Insert a separate entry for each student ID
                    for ($i = 0; $i < $candidateCount; $i++) {
                        $stmt->execute();
                    }
                }

                return ['success' => true, 'interview_id' => $interview_id];
            } else {
                // Error inserting into `time_slots`
                return ['success' => false, 'error' => 'Failed to insert into time_slots'];
            }
        } else {
            // Error inserting into `interviews`
            return ['success' => false, 'error' => 'Failed to insert into interviews'];
        }
    }

    public function deleteInterview($interviewId)
    {
        // Start a transaction to ensure atomicity
        $this->connection->begin_transaction();

        try {
            // Fetch all slot IDs associated with this interview
            $query = "SELECT id FROM time_slots WHERE interview_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $interviewId);
            $stmt->execute();
            $slotIds = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Delete from student_interview_slots based on slot IDs
            foreach ($slotIds as $slot) {
                $query = "DELETE FROM student_interview_slots WHERE slot_id = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("i", $slot['id']);
                if (!$stmt->execute()) {
                    throw new Exception("Failed to delete from student_interview_slots");
                }
            }

            // Delete from time_slots
            $query = "DELETE FROM time_slots WHERE interview_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $interviewId);
            if (!$stmt->execute()) {
                throw new Exception("Failed to delete from time_slots");
            }

            // Delete from interviews
            $query = "DELETE FROM interviews WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $interviewId);
            if (!$stmt->execute()) {
                throw new Exception("Failed to delete from interviews");
            }

            // Commit the transaction if everything is successful
            $this->connection->commit();

            return ['success' => true, 'message' => 'Interview and related data deleted successfully'];
        } catch (Exception $e) {
            // Roll back in case of failure
            $this->connection->rollback();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }



}