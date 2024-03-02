<?php
include_once('../app/model/CompanyAdModel.php');

class CompanyAdRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getCount(): int
    {
        $sql = "SELECT count(*) as count FROM company_ad";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $row['count'];
        }
        return 0;
    }


    public function getAll(): array
    {
        $sql = "SELECT c.*,ca.* FROM company c JOIN company_ad ca ON c.user_id=ca.company_id";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $company = new CompanyModel($row["user_id"], $row["company_name"], $row["email"], $row["contact_no"], $row["contact_person"]);
            $ad = new CompanyAdModel($row["ad_id"], $row["position"], $row["requirements"], $row["no_of_intern"], $row["working_mode"], $row["from_date"], $row["to_date"], $row["company_id"], $row["qualification"], $company, $row["status"]);

            $value = $ad;
            $list[] = $value;
        }
        return $list;
    }

    public function accept(int $id)
    {
        $sql = "UPDATE company_ad SET status=1 WHERE ad_id={$id}";
        $result = $this->conn->query($sql);

    }

    public function reject(int $id)
    {
        $sql = "UPDATE company_ad SET status=2 WHERE ad_id={$id}";
        $result = $this->conn->query($sql);

    }

}