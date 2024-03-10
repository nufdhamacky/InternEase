<?php
include_once('../app/model/StudentModel.php');
include_once('../app/model/CompanyModel.php');
include_once('../app/model/CompanyAdModel.php');
include_once('../app/model/PageDataModel.php');


class StudentRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function save(StudentModel $student): ?StudentModel
    {
        $password = password_hash($student->password, PASSWORD_DEFAULT);
        $userSql = "INSERT INTO users(user_name,user_role,user_status,password) VALUES('{$student->email}','student',1,'{$password}')";
        $userResult = $this->conn->query($userSql);
        if ($userResult) {
            $userId = $this->conn->insert_id;
            $sql = "INSERT INTO student(user_id,email,first_name,last_name,index_no,reg_no) VALUES({$userId},'{$student->email}','{$student->firstName}', '{$student->lastName}',{$student->indexNo},'{$student->regNo}')";
            $result = $this->conn->query($sql);

            if ($result) {
                return $student;
            }
        }

        return null;
    }

    public function update(StudentModel $student): void
    {
        $sql = "UPDATE student SET email='{$student->email}',first_name='{$student->firstName}',last_name='{$student->lastName}',index_no={$student->indexNo},reg_no='{$student->regNo}' WHERE user_id={$student->userId}";
        $result = $this->conn->query($sql);
    }

    public function getCount(): int
    {
        $sql = "SELECT count(*) as count FROM student";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $row['count'];
        }
        return 0;
    }

    public function filter($roundId, $companyId): array
    {
        $sql = "SELECT distinct s.* FROM student s JOIN applyadvertisement a ON s.id = a.applied_by JOIN firstrounddata f ON f.applied_id=a.id JOIN company_ad c ON c.ad_id=f.ad_id WHERE a.round_id = $roundId and c.company_id=$companyId";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];

            $companySql = "SELECT c.*,co.* FROM firstrounddata f join applyadvertisement a on a.id=f.applied_id JOIN company_ad c on c.ad_id=f.ad_id JOIN company co on co.user_id=c.company_id WHERE a.applied_by=$id and a.round_id=$roundId";
            $companyResult = $this->conn->query($companySql);
            $adList = [];

            while ($r = $companyResult->fetch_assoc()) {
                $company = new CompanyModel($r["user_id"], $r["company_name"], $r["email"], $r["contact_no"], $r["contact_person"], $r['website'],
                    1);
                $ad = new CompanyAdModel($r["ad_id"], $r["position"], $r["requirements"], $r["no_of_intern"], $r["working_mode"], $r["from_date"], $r["to_date"], $r["company_id"], $r["qualification"], $company, $r["status"]);
                $adList[] = $ad;
            }

            $value = new StudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],

                $adList
            );

            $list[] = $value;
        }
        return $list;
    }

    public function findAllByRoundId($roundId): array
    {
        $sql = "SELECT distinct s.* FROM student s 
                JOIN applyadvertisement a ON s.id = a.applied_by WHERE a.round_id = $roundId";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];

            $companySql = "SELECT c.*,co.* FROM firstrounddata f join applyadvertisement a on a.id=f.applied_id JOIN company_ad c on c.ad_id=f.ad_id JOIN company co on co.user_id=c.company_id WHERE a.applied_by=$id and a.round_id=$roundId";
            $companyResult = $this->conn->query($companySql);
            $adList = [];

            while ($r = $companyResult->fetch_assoc()) {
                $company = new CompanyModel($r["user_id"], $r["company_name"], $r["email"], $r["contact_no"], $r["contact_person"], $r['website'],
                    1);
                $ad = new CompanyAdModel($r["ad_id"], $r["position"], $r["requirements"], $r["no_of_intern"], $r["working_mode"], $r["from_date"], $r["to_date"], $r["company_id"], $r["qualification"], $company, $r["status"]);
                $adList[] = $ad;
            }

            $value = new StudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],

                $adList
            );

            $list[] = $value;
        }
        return $list;
    }

    public function getAll($page): PageDataModel
    {
        $limit = 10;
        $start = ($page - 1) * $limit;
        $sql = "SELECT * FROM student limit $limit offset $start";

        $result = $this->conn->query($sql);
        $list = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $value = new StudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],

                null
            );

            // Add the CompanyModel instance to the array
            $list[] = $value;
        }
        $countQuery = "SELECT count(*) as count FROM student";
        $countResult = $this->conn->query($countQuery);
        $count = $countResult->fetch_assoc()["count"];
        $totalPage = ceil($count / $limit);
        return new PageDataModel($page, $totalPage, $list);
    }

    public function findById($id): ?StudentModel
    {

        $sql = "SELECT * FROM student where user_id=$id";

        $result = $this->conn->query($sql);


        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $value = new StudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],

                null
            );

            // Add the CompanyModel instance to the array
            return $value;
        }

        return null;
    }


    public function delete($id): void
    {
        $sql = "DELETE FROM users where user_id=$id";
        $result = $this->conn->query($sql);
    }

    public function filterByCourse($course, $page): PageDataModel
    {
        $limit = 10;
        $start = ($page - 1) * $limit;
        $sql = "SELECT * FROM student where reg_no like CONCAT('%/', '{$course}', '/%') limit $limit offset $start";

        $result = $this->conn->query($sql);
        $list = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $value = new StudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],

                null
            );

            // Add the CompanyModel instance to the array
            $list[] = $value;
        }
        $countQuery = "SELECT count(*) as count FROM student where reg_no like CONCAT('%/', '{$course}', '/%')";
        $countResult = $this->conn->query($countQuery);
        $count = $countResult->fetch_assoc()["count"];
        $totalPage = ceil($count / $limit);
        return new PageDataModel($page, $totalPage, $list);
    }


}