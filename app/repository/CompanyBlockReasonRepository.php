<?php

include_once('../app/model/MyCompanyModel.php');
include_once('../app/model/CompanyBlockReasonModel.php');

class CompanyBlockReasonRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll(): array
    {
        $sql = "SELECT cbr.*,c.* FROM company_block_reason cbr JOIN company c ON cbr.user_id=c.user_id";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $company = new MyCompanyModel($row["user_id"], $row["company_name"], $row["email"], $row["contact_no"], $row["contact_person"], $row["company_site"], $row["user_status"]);
            $blockReason = new CompanyBlockReasonModel($row["id"], $company, $row["reason"], $row["date"]);
            $list[] = $blockReason;
        }
        return $list;
    }

    public function blockCompany(int $id, string $reason)
    {
        $sql = "UPDATE users SET user_status=2 WHERE user_id={$id}";
        $result = $this->conn->query($sql);
        $delSql = "DELETE FROM company_report WHERE company_id={$id}";
        $delResult = $this->conn->query($delSql);

        $reasonSql = "INSERT INTO company_block_reason (user_id,reason) VALUES ({$id},'{$reason}')";
        $reasonResult = $this->conn->query($reasonSql);
    }
}