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
                    <span><?php echo $_SESSION['companyName']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
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
                            <img src="--company logo--" alt="Company Logo"><br>
                            <h2>Welcome to <?php echo $_SESSION['companyName']; ?></h2><br>
                            <span class="icon"><ion-icon name="location-outline"></ion-icon>--company address--</span>
                        </div>

                        <div class="description">
                            <p>--company description--</p><br>
                            <div class="link">
                                <a href="--company website--">
                                    <button type="submit" name="submit">Visit Website</button>
                                </a>
                            </div>
                            
                            

                            <div class="submit">
                                <a href="profile">
                                    <button type="submit" name="submit">EDIT</button>
                                </a>
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