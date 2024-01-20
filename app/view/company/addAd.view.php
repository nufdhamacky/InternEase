<?php 

    // $company_id = $_SESSION['id'];

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
        
    //     if(isset($_POST)){
    //         $position = $_POST['position'];
    //         $requirements = $_POST['requirement'];
    //         $qualifications = $_POST['qualifications'];
    //         $start_date = $_POST['start_date'];
    //         $end_date = $_POST['end_date'];
    //         $no_of_interns = $_POST['no_of_intern'];
    //         $working_mode = $_POST['working_mode']; 
    //         $company_id = $_SESSION['id'];

        
    //         $sql = "INSERT INTO `company_ad` (`company_id`, `position`, `requirements`, `qualification`, `from_date`, `to_date`, `no_of_intern`, `working_mode`) VALUES ('$company_id', '$position', '$requirements', '$qualifications', '$start_date', '$end_date', '$no_of_interns', '$working_mode')";

    //         $result = mysqli_query($conn, $sql);

    //         if($result){
    //             $_SESSION['ad_addition'] = "Advertisement successfully created";
    //             header('location:'.SITEURL.'ad.php');
    //         }   
    //         else{
    //             header('location:'.SITEURL.'ad.php');
    //         }
    //     }
    // }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Advertisements</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyAddAd.css">
</head>
<body>
    <div class="container">
    <?php require_once('../app/view/layout/companyMenubar.php') ?>
        
        <div class ="main">
            <div class = "topbar">
                
                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <span><?php //echo $_SESSION['company_name']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>
                
            </div>

        <form method="POST">    
            <div class="details">
                <div class="heading-advertisement">
                        <h2>Add Advertisements</h2>
                </div>
                <div class="compdetails">
                        <h4>Positions</h4>
                        <select name="position">
                            <option value = "se">Sofware Engineer</option>
                            <option value = "qa">Quality Assuarance</option>
                            <option value = "ba">Business Analyst</option>
                        </select>
                        
                        <h4>Requirements</h4>
                        <input name="requirement" type = "text" class = "bx1">
                    
                        <h4>Qualifications</h4>
                        <input name="qualifications" type = "text" class = "bx1">
                        
                        <h4>Internship Period</h4>
                        <div class = "card">
                            <input name="start_date" class="ad-date" type = "month" class = "bx1">
                            <h4 class = "h4">to</h4>
                            <input name="end_date" class="ad-date" type = "month" class = "bx1">
                        </div>

                        <div class = "card">
                            <h4>No. of Interns</h4>
                            <h4 class = "spaceleft" style="margin-left:150px">Working Mode</h4>
                        </div>
                        <div class = "card">
                            <input name="no_of_intern" type = "number" class = "bx1">
                            <select name="working_mode">
                                <option value = "Online">Online</option>
                                <option value = "Physical">Physical</option>
                                <option value = "Hybrid">Hybrid</option>
                            </select>
                        </div>
                        
                        <div class="submit">
                            <button type="submit">SAVE</button>
                        </div>
                </div>
            </div>
        </form>
        
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>