<?php include("../../controllers/constant.php") ?>
<?php include("../../controllers/loginAccess.php") ?>

<?php

        if (isset($_GET['id'])) {
        
            $record_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $sql = "SELECT * FROM company_ad WHERE ad_id = $record_id";
            $result = mysqli_query($conn, $sql);
            $record = mysqli_fetch_assoc($result);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Advertisement</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyAdView.css">
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

   
            <div class="details">
                <div class="heading-advertisement">
                        <h2>Add Advertisements</h2>
                </div>
    
                    <div class="compdetails">
                            <h4>Positions</h4>
                            <input value="<?php 
                                            if($record['position']=="se"){
                                                echo "Software Engineer";
                                            }else if($record['position']=="ba"){
                                                echo "Business Analyst";
                                            }else if($record['position']=="qa"){
                                                echo "Quality Assurance";
                                            }
                                        ?>" name="position" class = "bx1" disabled>
                            
                            <h4>Requirements</h4>
                            <input name="requirement" value="<?php echo $record['requirements'] ?>" type = "text" class = "bx1" disabled>
                        
                            <h4>Qualifications</h4>
                            <input name="qualifications" value="<?php echo $record['qualification'] ?>" type = "text" class = "bx1" disabled>
                            
                            <h4>Internship Period</h4>
                            <div class = "card">
                                <input name="start_date" value="<?php echo $record['from_date'] ?>" class="ad-date" type = "month" class = "bx1" disabled>
                                <h4 class = "h4">to</h4>
                                <input name="end_date" value="<?php echo $record['to_date'] ?>"  class="ad-date" type = "month" class = "bx1" disabled>
                            </div>

                            <div class = "card">
                                <h4>No. of Interns</h4>
                                <h4 class = "spaceleft" style="margin-left:150px">Working Mode</h4>
                            </div>
                            <div class = "card">
                                <input name="no_of_intern" value="<?php echo $record['no_of_intern'] ?>" type = "number" class = "bx1" style="margin-right:15px;" disabled>
                                <input value="<?php echo $record['working_mode'] ?>" name="working_mode" class = "bx1" disabled>

                            </div>
                            <div class="submit">
                            <a href="editAd.php?id=<?php echo $record['ad_id']; ?>">
                                <button type="button">Edit</button>
                            </a>
                            </div>
                    </div>              
                
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>