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
    <title>Company Profile Form</title>
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
                    <?php $companyDetails = $data['userDetails'] ?>
                    <span><?php echo $_SESSION['companyName']; ?></span>
                </div>
                
            </div>

            <form action="<?=ROOT?>/company/editProfile" method="POST" enctype="multipart/form-data">    
            <div class="details">
                <div class="heading-advertisement">
                        <h2>My Profile</h2>
                </div>
                
                <div class="profile-pic">
                    <img src="<?=ROOT?>/assets/profile/<?= $_SESSION['userProfile'] ?>" alt="Profile Picture" class="pro-img">
                    <label for="input-file">Upload Logo</label>
                    <input name="profilePic" type="file" accept="image/jpeg, image/png, image/jpg" id="input-file" value="<?= $_SESSION['userProfile'] ?>">
                </div>

                <div class="compdetails">
                    
                        <h4>Company Name: </h4>
                        <div class="col">
                            <input type="text" name="companyName" class="box1" value="<?= $companyDetails->companyname ?>">
                            <br>
                        </div>

                        <h4>Description: </h4>
                        <div class="col">
                            <input type="text" name="description" class="box1" value="<?= $companyDetails->description ?>">
                            <br>
                        </div>

                        <h4>Website: </h4>
                        <div class="col">
                            <input type="text" name="website" class="box1" value="<?= $companyDetails->website ?>">
                            <br>
                        </div>

                        <h4>Contact Person: </h4>
                        <div class="col">
                            <input type="text" name="contactPerson" class="box1" value="<?= $companyDetails->contactperson ?>">
                            <br>
                        </div>

                        <h4>Contact Number: </h4>
                        <div class="col">
                            <input type="text" name="contactNo" class="box1" value="<?= $companyDetails->contactno ?>">
                            <br>
                        </div>

                        <h4>Address: </h4>
                        <div class="col">
                            <input type="text" name="address" class="box1" value="<?= $companyDetails->address ?>">
                            <br>
                        </div>
                        
                        <div class="submit">
                            <button type="submit">SAVE</button>
                        </div>

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