<?php
include_once('../app/model/PdcStudentModel.php');
include_once('../app/model/MyCompanyModel.php');
include_once('../app/model/CompanyAdModel.php');
include_once('../app/model/PageDataModel.php');


class StudentRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function save(PdcStudentModel $student): ?PdcStudentModel
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

    public function update(PdcStudentModel $student): void
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
        $sql = "SELECT distinct s.* FROM student s JOIN applyadvertisement a ON s.id = a.applied_by JOIN first_round_data f ON f.applied_id=a.id JOIN company_ad c ON c.ad_id=f.ad_id WHERE a.round_id = $roundId and c.company_id=$companyId";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];

            $companySql = "SELECT c.*,co.*,f.status as apply_status FROM first_round_data f join applyadvertisement a on a.id=f.applied_id JOIN company_ad c on c.ad_id=f.ad_id JOIN company co on co.user_id=c.company_id WHERE a.applied_by=$id and a.round_id=$roundId";
            $companyResult = $this->conn->query($companySql);
            $adList = [];

            while ($r = $companyResult->fetch_assoc()) {
                $company = new MyCompanyModel($r["user_id"], $r["company_name"], $r["email"], $r["contact_no"], $r["contact_person"], $r['company_site'],
                    1);
                $ad = new CompanyAdModel($r["ad_id"], $r["position"], $r["requirements"], $r["no_of_intern"], $r["working_mode"], $r["from_date"], $r["to_date"], $r["company_id"], $r["qualification"], $company, $r["status"], $r["no_of_cvs_required"]);
                $ad->firstRoundData = new FirstRoundDataModel($r["apply_status"]);
                $adList[] = $ad;
            }

            $value = new PdcStudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],
                $adList,
                array()
            );

            $list[] = $value;
        }
        return $list;
    }

    public function findAllByFirstRound(): array
    {
        $sql = "SELECT distinct s.* FROM student s 
                JOIN applyadvertisement a ON s.id = a.applied_by WHERE a.round_id = 1";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];

            $companySql = "SELECT c.*,co.*,f.status as apply_status FROM first_round_data f join applyadvertisement a on a.id=f.applied_id JOIN company_ad c on c.ad_id=f.ad_id JOIN company co on co.user_id=c.company_id WHERE a.applied_by=$id and a.round_id=1";
            $companyResult = $this->conn->query($companySql);
            $adList = [];

            while ($r = $companyResult->fetch_assoc()) {
                $company = new MyCompanyModel($r["user_id"], $r["company_name"], $r["email"], $r["contact_no"], $r["contact_person"], $r['company_site'],
                    1);
                $ad = new CompanyAdModel($r["ad_id"], $r["position"], $r["requirements"], $r["no_of_intern"], $r["working_mode"], $r["from_date"], $r["to_date"], $r["company_id"], $r["qualification"], $company, $r["status"]);
                $ad->firstRoundData = new FirstRoundDataModel($r["apply_status"]);
                $adList[] = $ad;
            }

            $value = new PdcStudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],
                $adList,
                null
            );

            $list[] = $value;
        }
        return $list;
    }

    public function findAllBySecondRound(): array
    {
        $sql = "SELECT distinct s.* FROM student s JOIN applyadvertisement a ON s.id = a.applied_by WHERE a.round_id = 2";
        $result = $this->conn->query($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];

            $jobSql = "SELECT s.job_role FROM second_round_data s join applyadvertisement a on a.id=s.applied_id WHERE a.applied_by=$id and a.round_id=2";
            $jobResult = $this->conn->query($jobSql);
            $jobList = [];

            while ($r = $jobResult->fetch_assoc()) {
                $jobList[] = $r["job_role"];
            }

            $value = new PdcStudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],
                null,
                $jobList
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
            $value = new PdcStudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],
                null,
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

    public function findById($id): ?PdcStudentModel
    {

        $sql = "SELECT * FROM student where user_id=$id";

        $result = $this->conn->query($sql);


        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $value = new PdcStudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],
                null,
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
            $value = new PdcStudentModel(
                $row['user_id'],
                $row['email'],
                $row['first_name'],
                $row['last_name'],
                null,
                $row['reg_no'],
                $row['index_no'],

                null,
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