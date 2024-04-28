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
        $sql = "SELECT t.*,c.* FROM tech_talk t JOIN company c ON t.company_id=c.user_id";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $company = new MyCompanyModel($row["company_id"], $row["name"], $row["email"], $row["contact"], $row["contact_person"], $row["website"], $row["status"]);
            $techTalk = new PDCTechTalkModel($row["tech_talk_id"], $company, $row["topic"], $row["from_date"], $row["to_date"], $row["status"]);
            $list[] = $techTalk;
        }
        return $list;
    }
}