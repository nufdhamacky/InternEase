<?php
include_once('../app/model/StudentModel.php');
class StudentRepository{


    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function save(StudentModel $student) : ?StudentModel{
        $sql="INSERT INTO student(user_id,email,first_name,last_name,index_no,reg_no) VALUES({$student->userId}, '{$student->email}','{$student->firstName}', '{$student->lastName}',{$student->indexNo},'{$student->regNo}')";
        $result = $this->conn->query($sql);
        
        if($result===TRUE){
            return $student;
        }
        return null;
    }


    public function getAll() : array{
        $sql = "SELECT * FROM student";

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
                $row['index_no']
            );

            // Add the CompanyModel instance to the array
            $list[] = $value;
        }

        return $list;

    }

    
}