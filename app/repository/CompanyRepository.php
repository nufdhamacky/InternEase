<?php
include_once('../app/model/CompanyModel.php');
class CompanyRepository{


    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getByUserId($userId) : ?CompanyModel{
        return null;
    }


    public function getAll() : array{
        $sql = "SELECT * FROM company";

        $result = $this->conn->query($sql);
        $companies = []; // Initialize an array to store CompanyModel instances

        while ($row = $result->fetch_assoc()) {
            // Create a new CompanyModel instance for each row
            $company = new CompanyModel(
                $row['user_id'],
                $row['company_name'],
                $row['email'],
                $row['contact_no'],
                $row['contact_person']
            );

            // Add the CompanyModel instance to the array
            $companies[] = $company;
        }

        return $companies;

    }

    public function getCount():int{
        $sql = "SELECT count(*) as count FROM company";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row['count'];
        }
        return 0;
    }

   public  function getBlackListCount():int{
        $sql = "SELECT count(c.user_id) as count FROM company as c join users as u on c.user_id = u.user_id where u.user_status=2";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row['count'];
        }
        return 0;
    }
}