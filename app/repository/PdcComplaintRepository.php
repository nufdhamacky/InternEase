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
        $sql = "SELECT c.*,s.id, s.first_name,s.last_name , s.reg_no FROM complaint c JOIN student s ON c.student_id=s.id WHERE c.type = 'user_complaint'";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $student = new StudentShortModel($row["id"], $row["first_name"], $row["last_name"], $row["reg_no"]);
            $complaint = new PdcComplaintModel($row["id"], $student, $row["type"], $row["title"], $row["description"], $row["reply"], $row["status"], $row["date"]);
            $list[] = $complaint;
        }
        return $list;
    }

}
