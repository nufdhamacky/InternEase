<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Request</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/pdc/req.css">
</head>
<body>
    <div class="container">
        <?php include_once('../app/view/layout/pdcSidemenu.php') ?>
        <div class ="main">
            <div class = "topbar">
                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <ion-icon name="notifications-circle-outline"></ion-icon>
                    <span>Hamsayini</span>
                    <ion-icon name="person-circle-outline"></ion-icon>
                    
                </div>

            </div>
            <div class ="cardBox">
                <div class ="card">
                    <div>
                        <div class="number">2023.11.04</div>
                        <div class="cardName">Ending period of First Round</div>
                    </div>
                    <div class="iconBx">
                    <ion-icon name="alert-circle-outline"></ion-icon>   
                </div>
                    
                </div>
                <div class ="card">
                    <div>
                        <div class="number"></div>
                        <div class="cardName">Set Second Round</div>
                    </div>
                    <div class="iconBx">
                    <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                    
                </div>
               
            </div>

        <!--order data list-->
        <div class="details">
            <div class="internshipAds">
                <div class = "cardHeader">
                    <h2>Applied Advertisements Status</h2>
                    <a href="advertisement.php" class="btn">View All</a> 
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Company Name</td>
                            <td>Job</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>WSO2</td>
                            <td>Software Engineering</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>99X</td>
                            <td>QA</td>
                            <td><span class="status approved">Approved</span></td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>Web Development</td>
                            <td><span class="status rejected">Rejected</span></td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>Software Engineering</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>IFS</td>
                            <td>QA</td>
                            <td><span class="status approved">Approved</span></td>
                        </tr>

                        <tr>
                            <td>99X</td>
                            <td>Software Engineering</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>Web Development</td>
                            <td><span class="status rejected">Rejected</span></td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>QA</td>
                            <td><span class="status pending">Pending</span></td>
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