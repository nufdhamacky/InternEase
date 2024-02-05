<?php

class CompanyModel {
    public function getTotalAd($conn){
        $sql = "SELECT count(*) as count FROM company_ad";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }
        return 0;
    }

    function getTotalStudents($conn){
        $sql = "SELECT count(*) as count FROM student";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }
        return 0;
    }

    public function addAdvertisement($conn, $position, $requirements, $qualifications, $start_date, $end_date, $no_of_intern, $working_mode) {
        $requirements = implode(", ", $requirements);
        $qualifications = implode(", ", $qualifications);

        $sql = "INSERT INTO company_ad (position, requirements, qualifications, start_date, end_date, no_of_intern, working_mode) 
                VALUES ('$position', '$requirements', '$qualifications', '$start_date', '$end_date', $no_of_intern, '$working_mode')";
        
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // function getAddAd($conn){
    //     if(isset($_POST['submit'])){
    //         $position = $_POST['position'];

    //         $sql = "INSERT INTO company_ad(position) VALUES('$position')";
    //         $query_run = mysqli_query($conn, $sql);

    //         if($query_run)
    //         {
    //             $_SESSION['status'] = "Inserted Successfully";
    //             header("Location: addAdd.view.php");
    //         }
    //         else
    //         {
    //             $_SESSION['status'] = "Not Inserted";
    //             header("Location: addAdd.view.php");
    //         }
    //     }

    //     // $position = $_POST['position'];

        
    // }

}