<?php
include_once('../app/model/CompanyModel.php');
include_once('../app/model/PageDataModel.php');

class CompanyRepository
{


    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getByUserId($userId): ?CompanyModel
    {
        return null;
    }


    public function getAll(): array
    {
        $sql = "SELECT c.*,u.user_status FROM company c JOIN users u ON c.user_id=u.user_id";

        $result = $this->conn->query($sql);
        $companies = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $company = new CompanyModel(
                $row['user_id'],
                $row['company_name'],
                $row['email'],
                $row['contact_no'],
                $row['contact_person'],
                $row['website'],
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
            $company = new CompanyModel(
                $row['user_id'],
                $row['company_name'],
                $row['email'],
                $row['contact_no'],
                $row['contact_person'],
                $row['website'],
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

    public function getCountByStatus($status): int
    {
        $countQuery = "SELECT count(c.user_id) as count FROM company c JOIN users u ON c.user_id=u.user_id where user_status=$status";
        $countResult = $this->conn->query($countQuery);
        $count = $countResult->fetch_assoc()["count"];
        return $count;
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