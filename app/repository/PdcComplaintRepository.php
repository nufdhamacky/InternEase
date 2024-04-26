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

    public function getAll($order): array
    {
        $sql = "SELECT c.*,s.id as student_id,s.user_id, s.first_name,s.last_name , s.reg_no FROM complaint c JOIN student s ON c.student_id=s.id WHERE c.type = 'user_complaint' ORDER BY c.created_at $order";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $student = new StudentShortModel($row["student_id"], $row["user_id"], $row["first_name"], $row["last_name"], $row["reg_no"]);
            $complaint = new PdcComplaintModel($row["complaint_id"], $student, $row["type"], $row["title"], $row["description"], $row["reply"], $row["status"], $row["created_at"]);
            $list[] = $complaint;
        }
        return $list;
    }

    public function findById($id): PdcComplaintModel
    {
        $sql = "SELECT c.*,s.id as student_id,s.user_id, s.first_name,s.last_name , s.reg_no FROM complaint c JOIN student s ON c.student_id=s.id WHERE c.complaint_id = $id";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $student = new StudentShortModel($row["student_id"], $row["user_id"], $row["first_name"], $row["last_name"], $row["reg_no"]);
        $complaint = new PdcComplaintModel($row["complaint_id"], $student, $row["type"], $row["title"], $row["description"], $row["reply"], $row["status"], $row["created_at"]);
        return $complaint;
    }

    public function filter($status, $order): array
    {
        $statusNo = $status == "resolved" ? 1 : 0;
        $sql = "SELECT c.*,s.id as student_id,s.user_id, s.first_name,s.last_name , s.reg_no FROM complaint c JOIN student s ON c.student_id=s.id WHERE c.type = 'user_complaint' and c.status = '$statusNo' ORDER BY c.created_at $order";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $student = new StudentShortModel($row["student_id"], $row["user_id"], $row["first_name"], $row["last_name"], $row["reg_no"]);
            $complaint = new PdcComplaintModel($row["complaint_id"], $student, $row["type"], $row["title"], $row["description"], $row["reply"], $row["status"], $row["created_at"]);
            $list[] = $complaint;
        }
        return $list;
    }

    public function reply($id, $reply)
    {
        $sql = "UPDATE complaint SET reply = '$reply', status = 1 WHERE complaint_id = $id";
        $result = $this->conn->query($sql);
    }

    public function getCount(): int
    {
        $sql = "SELECT count(*) as count FROM complaint WHERE type = 'user_complaint' and user_type = 'student'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $row['count'];
        }
        return 0;
    }
}
