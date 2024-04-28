<?php
include_once('../app/model/MyCompanyModel.php');
include_once('../app/model/PdcTechTalkModel.php');

class PDCTechTalkRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll(): array
    {
        $sql = "SELECT t.*,c.* ,u.user_status FROM tech_talk t JOIN company c ON t.company_id=c.user_id JOIN users u ON c.user_id=u.user_id where u.user_status=1";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $company = new MyCompanyModel($row["user_id"], $row["company_name"], $row["email"], $row["contact_no"], $row["contact_person"], $row["company_site"], $row["user_status"]);
            $techTalk = new PDCTechTalkModel($row["techtalk_id"], $company, $row["topic"], $row["from_date"], $row["to_date"], $row["status"]);
            $list[] = $techTalk;
        }
        return $list;
    }

    public function accept($id)
    {
        $sql = "UPDATE tech_talk SET status=1 WHERE techtalk_id=$id";
        $this->conn->query($sql);
    }

    public function reject($id)
    {
        $sql = "UPDATE tech_talk SET status=2 WHERE techtalk_id=$id";
        $this->conn->query($sql);
    }
}