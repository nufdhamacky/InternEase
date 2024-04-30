<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruited Students</title>

    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyShortlistedStu.css">
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyRecruitedStu.css">
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
            
        <!--student data list-->
        <div class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Recruited Student List</h2>
                </div>
                

                <section>

                        
                        <table>
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Registration No.</th>
                        <th>Position</th>
                    </tr>
                    </thead>

                    <tbody>
                    
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                         <tr>
                            <td colspan="5">No student applications found.</td>
                        </tr>
                    </tbody>
                </table>

                    </div>
                </section>

            </div>
        </div>
            
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>