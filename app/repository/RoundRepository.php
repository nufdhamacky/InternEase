<?php
include_once('../app/model/RoundModel.php');
class RoundRepository{


    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function save(RoundModel $request) : ?RoundModel{
        $sql="INSERT INTO round(id,advertisement_count,start_date,end_date,job_role_count) VALUES({$request->id}, {$request->advertisementCount},'{$request->startDate}', '{$request->endDate}',{$request->jobRoleCount})";
        $result = $this->conn->query($sql);
        
        if($result===TRUE){
            return $request;
        }
        return null;
    }


    

    public function findById(int $id) : ?RoundModel{
        $sql = "SELECT * FROM round where id = {$id}";

        $result = $this->conn->query($sql);
        if($result->num_rows==0){
            return null;
        }
        $row = $result->fetch_assoc();

        $value = new RoundModel(
            $row['id'],
            $row['advertisement_count'],
            $row['job_role_count'],
            $row['start_date'],
            $row['end_date']
        );
        return $value;

    }




    public function getAll() : array{
        $sql = "SELECT * FROM round";

        $result = $this->conn->query($sql);
        $list = []; 

        while ($row = $result->fetch_assoc()) {
           
            $value = new RoundModel(
                $row['id'],
                $row['advertisement_count'],
                $row['job_role_count'],
                $row['start_date'],
                $row['end_date']
            );

            $list[] = $value;
        }

        return $list;

    }

    
}