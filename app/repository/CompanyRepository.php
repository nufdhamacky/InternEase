<?php
include_once('../app/model/MyCompanyModel.php');
include_once('../app/model/ReportModel.php');
include_once('../app/model/StudentShortModel.php');
include_once('../app/model/BlackCompanyModel.php');
include_once('../app/model/PageDataModel.php');

class CompanyRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getByUserId($userId): ?MyCompanyModel
    {
        return null;
    }


    public function getReportsByCompany($id): array
    {
        $reportSql = "SELECT r.*,s.id as student_id,s.user_id,s.first_name,s.last_name,s.reg_no FROM company_report r join student s on s.user_id=r.reported_by where r.company_id=$id";
        $reportResult = $this->conn->query($reportSql);
        $list = [];
        while ($r = $reportResult->fetch_assoc()) {
            $student = new StudentShortModel($r["student_id"], $r["user_id"], $r["first_name"], $r["last_name"], $r["reg_no"]);
            $report = new ReportModel($r["id"], $student, $r["reason"], $r["date"]);
            $list[] = $report;
        }
        return $list;
    }

    public function getBlackCompanies(): array
    {
        $sql = "SELECT distinct c.* FROM company as c JOIN company_report as r on c.user_id = r.company_id";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $companyId = $row["user_id"];
            $reportSql = "SELECT r.*,s.id as student_id,s.user_id,s.first_name,s.last_name,s.reg_no FROM company_report r join student s on s.user_id=r.reported_by where r.company_id=$companyId";
            $reportResult = $this->conn->query($reportSql);
            $totalRecruitmentsSql = "SELECT count(ca.ad_id) as count FROM first_round_data f JOIN company_ad ca ON f.ad_id = ca.ad_id WHERE f.status =1  AND ca.company_id=$companyId";
            $totalRecruitmentsResult = $this->conn->query($totalRecruitmentsSql);
            $totalRecruitments = $totalRecruitmentsResult->fetch_assoc()["count"];
            $reports = [];
            while ($r = $reportResult->fetch_assoc()) {
                $student = new StudentShortModel($r["student_id"], $r["user_id"], $r["first_name"], $r["last_name"], $r["reg_no"]);
                $report = new ReportModel($r["id"], $student, $r["reason"], $r["date"]);
                $reports[] = $report;
            }

            $company = new BlackCompanyModel($row["user_id"], $row["company_name"], $reports, $totalRecruitments);
            $list[] = $company;
        }
        return $list;
    }


    public function deleteReport($id)
    {
        $sql = "DELETE FROM company_report WHERE id=$id";
        $result = $this->conn->query($sql);
    }

    public function getAll(): array
    {
        $sql = "SELECT c.*,u.user_status FROM company c JOIN users u ON c.user_id=u.user_id";

        $result = $this->conn->query($sql);
        $companies = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $company = new MyCompanyModel(
                $row['user_id'],
                $row['company_name'],
                $row['email'],
                $row['contact_no'],
                $row['contact_person'],
                $row['company_site'],
                $row['user_status']
            );

            // Add the CompanyModel instance to the array
            $companies[] = $company;
        }

        return $companies;

    }

    public function getByStatus($page, $status): PageDataModel
    {
        $limit = 10;
        $start = ($page - 1) * $limit;
        $sql = "SELECT c.*,u.user_status FROM company c JOIN users u ON c.user_id=u.user_id where user_status=$status limit $limit offset $start";

        $result = $this->conn->query($sql);
        $companies = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $company = new MyCompanyModel(
                $row['user_id'],
                $row['company_name'],
                $row['email'],
                $row['contact_no'],
                $row['contact_person'],
                $row['company_site'],
                $row['user_status']
            );

            // Add the CompanyModel instance to the array
            $companies[] = $company;
        }

        $countQuery = "SELECT count(c.user_id) as count FROM company c JOIN users u ON c.user_id=u.user_id where user_status=$status";
        $countResult = $this->conn->query($countQuery);
        $count = $countResult->fetch_assoc()["count"];
        $totalPage = ceil($count / $limit);
        return new PageDataModel($page, $totalPage, $companies);

    }

    public function getFullByStatus($status): array
    {

        $sql = "SELECT c.*,u.user_status FROM company c JOIN users u ON c.user_id=u.user_id where user_status=$status";

        $result = $this->conn->query($sql);
        $companies = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $company = new MyCompanyModel(
                $row['user_id'],
                $row['company_name'],
                $row['email'],
                $row['contact_no'],
                $row['contact_person'],
                $row['company_site'],
                $row['user_status']
            );

            // Add the CompanyModel instance to the array
            $companies[] = $company;
        }

        return $companies;
    }

    public function getCountByStatus($status): int
    {
        $countQuery = "SELECT count(c.user_id) as count FROM company c JOIN users u ON c.user_id=u.user_id where user_status=$status";
        $countResult = $this->conn->query($countQuery);
        $count = $countResult->fetch_assoc()["count"];
        return $count;
    }

    public function blockCompany(int $id)
    {
        $sql = "UPDATE users SET user_status=2 WHERE user_id={$id}";
        $result = $this->conn->query($sql);
        $delSql = "DELETE FROM company_report WHERE company_id={$id}";
        $delResult = $this->conn->query($delSql);
    }

    public function getBlackListCount(): int
    {
        $sql = "SELECT count(c.user_id) as count FROM company as c join users as u on c.user_id = u.user_id where u.user_status=2";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $row['count'];
        }
        return 0;
    }

    public function getBlackListComplaintCount(): int
    {
        $sql = "SELECT count (distinct reported_by) as count FROM company_report";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $row['count'];
        }
        return 0;
    }

    public function accept(int $id)
    {
        $sql = "UPDATE users SET user_status=1 WHERE user_id={$id}";
        $result = $this->conn->query($sql);

    }

    public function reject(int $id)
    {
        $sql = "UPDATE users SET user_status=2 WHERE user_id={$id}";
        $result = $this->conn->query($sql);

    }
}