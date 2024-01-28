<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortlisted Students</title>
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
                    <h2>Shortlisted Students List</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Job Role</td>
                            <td>Degree</td>
                            <td>No. of Shortlisted Students</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Quality Assuarance</td>
                            <td>CS</td>
                            <td>3</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Quality Assuarance</td>
                            <td>IS</td>
                            <td>5</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Business Analyst</td>
                            <td>CS</td>
                            <td>2</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Business Analyst</td>
                            <td>IS</td>
                            <td>2</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Software Enginner</td>
                            <td>CS</td>
                            <td>4</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Software Enginner</td>
                            <td>IS</td>
                            <td>3</td>
                            <td><a href="#" span class = "view"></span>View</td>
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