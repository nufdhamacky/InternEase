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
                    <span><?php echo $_SESSION['companyName']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>

   
            <div class="details">
                <div class="heading-advertisement">
                        <h2>Add Advertisements</h2>
                </div>
    
                    <div class="compdetails">
                            <h4>Positions</h4>
                            <input value="" name="position" class = "bx1" disabled>
                            
                            <h4>Requirements</h4>
                            <input name="requirement" value="" type = "text" class = "bx1" disabled>
                        
                            <h4>Qualifications</h4>
                            <input name="qualifications" value="" type = "text" class = "bx1" disabled>
                            
                            <h4>Internship Period</h4>
                            <div class = "card">
                                <input name="start_date" value="" class="ad-date" type = "month" class = "bx1" disabled>
                                <h4 class = "h4">to</h4>
                                <input name="end_date" value=""  class="ad-date" type = "month" class = "bx1" disabled>
                            </div>

                            <div class = "card">
                                <h4>No. of Interns</h4>
                                <h4 class = "spaceleft" style="margin-left:150px">Working Mode</h4>
                            </div>
                            <div class = "card">
                                <input name="no_of_intern" value="" type = "number" class = "bx1" style="margin-right:15px;" disabled>
                                <input value="" name="working_mode" class = "bx1" disabled>

                            </div>
                            <div class="submit">
                            <a href="editAd.php?id=">
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