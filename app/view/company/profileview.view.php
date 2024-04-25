<?php
    include_once('../app/controller/Company.php');
    $companyController = new Company();
    // $compdetails = $companyController->getCompDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyProfileView.css">
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
                    <?php 
                        $companyDetails = $data['userDetails'];
                        $imagePath = ROOT."/assets/profile/".$_SESSION['userProfile']; ?>
                    <div class="profilepic"><img src="<?php echo $imagePath ?>" alt=""></div>
                    <span><?php echo $_SESSION['companyName']; ?></span>
                </div> 
                
            </div>

            <form method="POST">    
            <div class="details">
                <div class="heading-advertisement">
                        <h2>My Profile</h2>
                </div>

                <form method="POST">
                    <div class="compdetails">   
                        
                        <div class="name">
                            <div class="imagedisplay">
                                <img src="<?php echo $imagePath ?>" alt="Company Logo"><br>
                            </div>
                            <h1>Welcome to <?php echo $_SESSION['companyName']; ?></h1><br>
                            <span class="icon"><ion-icon name="location-outline"></ion-icon><h5><?php echo $companyDetails->address ?></h5></span>
                        </div>

                        <div class="description">
                            <p><?php echo isset($companyDetails->description) ? $companyDetails->description : " "; ?></p><br>
                            
                            <a href="https://<?php echo $companyDetails->company_site ?>">
                                <div class="link">                              
                                        Visit Website
                                </div>
                            </a>

                            <a href="profile">
                                <div class="submit">
                                        EDIT
                                </div>
                            </a>
                            <div class="image-container">
                                <img src="<?=ROOT?>/assets/images/pro1.png">
                            </div>

                        </div>
                    </div>
                </form>
                
            </div>
            </form>
        </div>
                   
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>