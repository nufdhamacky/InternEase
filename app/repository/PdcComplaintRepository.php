<?php
include_once('../app/model/StudentShortModel.php');
include_once('../app/model/PdcComplaintModel.php');


class PdcComplaintRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll(): array
    {
        $sql = "SELECT c.*,s.id as student_id,s.user_id, s.first_name,s.last_name , s.reg_no FROM complaint c JOIN student s ON c.student_id=s.id WHERE c.type = 'user_complaint'";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $student = new StudentShortModel($row["student_id"], $row["user_id"], $row["first_name"], $row["last_name"], $row["reg_no"]);
            $complaint = new PdcComplaintModel($row["complaint_id"], $student, $row["type"], $row["title"], $row["description"], $row["reply"], $row["status"], $row["created_at"]);
            $list[] = $complaint;
        }
        return $list;
    }

}
