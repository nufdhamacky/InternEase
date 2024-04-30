<?php
    include_once('../app/controller/Company.php');
    $companyController = new Company();
    $students = $data['students'];
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
                    <span><?php echo $_SESSION['companyName']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>
            <div class ="cardBox">
                <!-- <div class ="card">
                    <div>
                        <div class="number">23-Nov 2024</div>
                        <div class="cardName">Final Date for Applications</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div> -->
                
                <div class ="card">
                <a href="studentReq">
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
                        <div class="number"><?php echo $companyController->getShortlistedStudents(); ?></div>
                        <div class="cardName">Total Students Shortlisted</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="person-remove-outline"></ion-icon>
                    </div>
                    </a>    
                </div>

                <div class ="card">
                <a href="ad">
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
                    <h2>Student Applications</h2>
                    <a href="studentReq" class="btn">View All</a> 
                </div>
                

                <table>
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Registration No.</th>
                        <th>Position</th>
                        
                    </tr>
                    </thead>

                    <tbody>
                    <?php if ($students): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                                <td><?= htmlspecialchars($student['reg_no']) ?></td>
                                <td><?= htmlspecialchars($student['position']) ?></td>                                
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5">No student applications found.</td>
                        </tr>
                    <?php endif; ?>
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