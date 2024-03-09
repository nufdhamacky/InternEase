<?php
include_once('../app/model/AddCompanyVisitModel.php');
include_once('../app/model/CompanyVisitModel.php');


class CompanyVisitRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function save(AddCompanyVisitModel $companyVisit)
    {
        $companyId = $companyVisit->companyId;
        $requestDate = $companyVisit->requestDate;
        $reason = $companyVisit->reason;

        $sql = "INSERT INTO company_visit (company_id, request_date, reason) VALUES ('$companyId', '$requestDate', '$reason')";
        $this->conn->query($sql);
    }

    public function getAll($page): PageDataModel
    {
        $limit = 10;
        $start = ($page - 1) * $limit;
        $sql = "SELECT c.company_name,cv.* FROM company c JOIN company_visit cv ON c.user_id=cv.company_id LIMIT $start, $limit";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $companyVisit = new CompanyVisitModel($row["id"], $row["company_id"], $row["company_name"], $row["request_date"], $row["visit_date"], $row["reason"], $row["status"]);
            $list[] = $companyVisit;
        }
        $total = $this->conn->query("SELECT count(*) as count FROM company_visit")->fetch_assoc()["count"];
        $pageData = new PageDataModel($page, $total, $list);
        return $pageData;
    }
}