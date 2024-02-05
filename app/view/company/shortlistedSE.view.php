<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortlisted Students - SE</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyShortlistedStu.css">
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
                    <span></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>
            
        <!--student data list-->
        <div class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Shortlisted Students for Software Engineer</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Degree</td>
                            <td>Index No.</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>

                    <tr>
                            <td>Shamah Lafir</td>
                            <td>BSc. in Information Systems</td>
                            <td>21020586</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td><a href="#" span class = "view"></span>Schedule Interview</td>
                        </tr>

                        <tr>
                            <td>Hemadri Perera</td>
                            <td>BSc. in Information Systems</td>
                            <td>21020559</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td><a href="#" span class = "view"></span>Schedule Interview</td>
                        </tr>

                        <tr>
                            <td>Sathurshika Manoharajan</td>
                            <td>BSc. in Computer Science</td>
                            <td>21020369</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td><a href="#" span class = "view"></span>Schedule Interview</td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
            
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>