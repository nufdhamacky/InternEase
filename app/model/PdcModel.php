<?php

class PdcModel{

    function getCompanyCount($conn){
        $sql = "SELECT count(*) as count FROM company";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row['count'];
        }
        return 0;
    }

    function getStudentCount($conn){
        $sql = "SELECT count(*) as count FROM company_ad";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row['count'];
        }
        return 0;
    }
    function getBlackListCount($conn) {
        $sql = "SELECT count(c.user_id) as count FROM company as c join users as u on c.user_id = u.user_id where u.user_status=2";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row['count'];
        }
        return 0;
    }

    function getCompanyDetails($conn)
    {
        $sql="SELECT * FROM company";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            return $row;
        }
        return 0;
    }
}
