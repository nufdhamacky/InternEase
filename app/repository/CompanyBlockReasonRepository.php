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
        $sql = "SELECT cbr.*,c.* ,u.user_status FROM company_block_reason cbr JOIN company c ON cbr.user_id=c.user_id JOIN users u ON c.user_id=u.user_id WHERE u.user_status=2";
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
        $sql = "UPDATE users SET user_status=3 WHERE user_id={$id}";
        $result = $this->conn->query($sql);
        $delSql = "DELETE FROM company_report WHERE company_id={$id}";
        $delResult = $this->conn->query($delSql);

        $reasonSql = "INSERT INTO company_block_reason (user_id,reason) VALUES ({$id},'{$reason}')";
        $reasonResult = $this->conn->query($reasonSql);
    }

    public function getBlockMail($id): string
    {
        $sql = "SELECT email FROM company WHERE user_id={$id}";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row["email"];
    }

    public function getCount(): int
    {
        $sql = "SELECT count(c.user_id) as count FROM company as c join users as u on c.user_id = u.user_id where u.user_status=3";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $row['count'];
        }
        return 0;
    }


}