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
    <title>Company Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyDashboard.css">
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
            <div class ="cardBox">
                <div class ="card">
                    <div>
                        <div class="number">23-Nov 2023</div>
                        <div class="cardName">Ending Date of Recruitment Period </div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div>
                
                <div class ="card">
                <a href="totStudents">
                    <div>
                        <div class="number"><?php echo $companyController->getTotalStudents(); ?></div>
                        <div class="cardName">Total Students Applied</div>
                        
                    </div>
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </a>
                </div>
           
                <div class ="card">
                <a href="shortlistedStu">
                    <div>
                        <div class="number">35</div>
                        <div class="cardName">Total Students Shortlisted</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="person-remove-outline"></ion-icon>
                    </div>
                    </a>    
                </div>

                <div class ="card">
                <a href="totAd">
                    <div>
                        <div class="number"><?php echo $companyController->getTotalAd(); ?></div>
                        <div class="cardName">Total Advertisements</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                </a>   
                </div>
                
            </div>

        <!--student data list-->
        <div class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Student Requests</h2>
                    <a href="studentReq" class="btn">View All</a> 
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Student Degree</td>
                            <td>Job</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>CS</td>
                            <td>Software Engineering</td>
                            <td><span class="status pending">Pending</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>IS</td>
                            <td>QA</td>
                            <td><span class="status recruited">Recruited</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>CS</td>
                            <td>Web Development</td>
                            <td><span class="status rejected">Rejected</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>IS</td>
                            <td>Software Engineering</td>
                            <td><span class="status pending">Pending</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>IS</td>
                            <td>QA</td>
                            <td><span class="status recruited">Recruited</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>CS</td>
                            <td>Software Engineering</td>
                            <td><span class="status pending">Pending</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>CS</td>
                            <td>Web Development</td>
                            <td><span class="status rejected">Rejected</span></td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>IS</td>
                            <td>Web Development</td>
                            <td><span class="status rejected">Rejected</span></td>
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