<?php

class CompanyModel {
    public function getTotalAd($conn, $userId) {
        // Ensure the prepared statement is used to avoid SQL injection
        $sql = "SELECT COUNT(*) AS count FROM company_ad WHERE company_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }

        return 0;
    }
    

    function getTotalStudents($conn ,$id){
        $sql = "SELECT count(*) as count FROM student as s join applyadvertisement as aa on s.id = aa.applied_by join first_round_data as frd on frd.applied_id= aa.id join company_ad as ca on ca.ad_id=frd.ad_id where ca.company_id =$id;
        ";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }
        return 0;
    }

    function getShortlistedStudents($conn ,$id){
        $sql = "SELECT count(*) as count FROM student as s join applyadvertisement as aa on s.id = aa.applied_by join first_round_data as frd on frd.applied_id= aa.id join company_ad as ca on ca.ad_id=frd.ad_id where ca.company_id =$id and frd.status=1;
        ";

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

        $sql = "INSERT INTO company_ad (position, qualifications, start_date, end_date, no_of_intern, working_mode) 
                VALUES ($position', '$qualifications', '$start_date', '$end_date', $no_of_intern, '$working_mode')";
        
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