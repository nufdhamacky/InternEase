<?php
    include_once('../app/controller/Company.php');
    $companyController = new Company();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyProfile.css">
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
                        <h2>My Profile</h2>
                </div>
                
                <div class="profile-pic">
                    <img src="<?=ROOT?>/assets/images/profile.png" alt="Profile Picture" class="pro-img">
                    <label for="input-file">Upload Logo</label>
                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file">
                </div>

                <div class="compdetails">
                    <form action="" method="POST">
                        <h4>Company Name: </h4>
                        <div class="col">
                            <input type="text" name="companyName" class="box1" value="">
                            <br>
                        </div>

                        <h4>Email: </h4>
                        <div class="col">
                            <input type="text" name="companyName" class="box1" value="">
                            <br>
                        </div>

                        <h4>Company Website: </h4>
                        <div class="col">
                            <input type="text" name="companyName" class="box1" value="">
                            <br>
                        </div>

                        <h4>Contact No: </h4>
                        <div class="col">
                            <input type="text" name="companyName" class="box1" value="">
                            <br>
                        </div>

                        <h4>Address: </h4>
                        <div class="col">
                            <input type="text" name="companyName" class="box1" value="">
                            <br>
                        </div>
                        
                        <div class="submit">
                            <button type="submit">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div>
                   
    </div>
    
    <script src="<?=ROOT?>/js/profile.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>