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
        $count = $this->conn->query("SELECT count(cv.id) as count FROM company c JOIN company_visit cv ON c.user_id=cv.company_id")->fetch_assoc()["count"];
        $totalPage = ceil($count / $limit);
        $pageData = new PageDataModel($page, $totalPage, $list);
        return $pageData;
    }

    public function search($query, $page): PageDataModel
    {
        $limit = 10;
        $start = ($page - 1) * $limit;
        $sql = "SELECT c.company_name,cv.* FROM company c JOIN company_visit cv ON c.user_id=cv.company_id WHERE c.company_name like CONCAT('%', '{$query}', '%') LIMIT $start, $limit";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $companyVisit = new CompanyVisitModel($row["id"], $row["company_id"], $row["company_name"], $row["request_date"], $row["visit_date"], $row["reason"], $row["status"]);
            $list[] = $companyVisit;
        }
        $count = $this->conn->query("SELECT count(cv.id) as count FROM company c JOIN company_visit cv ON c.user_id=cv.company_id WHERE c.company_name like CONCAT('%', '{$query}', '%')")->fetch_assoc()["count"];
        $totalPage = ceil($count / $limit);
        $pageData = new PageDataModel($page, $totalPage, $list);

        return $pageData;
    }


    public function accept(int $id)
    {
        $sql = "UPDATE company_visit SET status=1 WHERE id=$id";
        $this->conn->query($sql);
    }

    public function reject(int $id)
    {
        $sql = "UPDATE company_visit SET status=2 WHERE id=$id";
        $this->conn->query($sql);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM company_visit WHERE id=$id";
        $this->conn->query($sql);
    }

    public function getByStatus($status): array
    {
        $sql = "SELECT c.company_name,cv.* , u.user_status FROM company c JOIN company_visit cv ON c.user_id=cv.company_id JOIN users u on u.user_id = c.user_id WHERE cv.status!=$status AND u.user_status=1";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $companyVisit = new CompanyVisitModel($row["id"], $row["company_id"], $row["company_name"], $row["request_date"], $row["visit_date"], $row["reason"], $row["status"]);
            $list[] = $companyVisit;
        }
        return $list;
    }
}