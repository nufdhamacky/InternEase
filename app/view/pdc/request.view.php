<?php
include_once('../app/controller/pdc.php');
include_once('../app/controller/companyad.php');
$pdcController = new Pdc();
$companyAdController = new CompanyAd();
$ads = $companyAdController->getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Request</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/req.css">
</head>
<body>
<div class="container">
    <?php include_once('../app/view/layout/pdcSidemenu.php') ?>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <ion-icon name="notifications-circle-outline"></ion-icon>
                <span>Hamsayini</span>
                <ion-icon name="person-circle-outline"></ion-icon>

            </div>

        </div>
        <div class="cardBox">
            <div class="card">
                <a style="text-decoration: none"
                   href="<?php echo $pdcController->getPendingCompanyCount() > 0 ? "companyrequest" : "#"; ?>">
                    <div>
                        <div class="number"><?php echo $pdcController->getPendingCompanyCount(); ?></div>
                        <div class="cardName">Company Request</div>
                    </div>
                </a>
                <div class="iconBx">
                    <ion-icon name="bag-handle-outline"></ion-icon>


                </div>

            </div>
            <div class="card">
                <a style="text-decoration: none" href="studentrequest">
                    <div>
                        <div class="number"><?php echo $pdcController->getStudentRequestCount(); ?></div>
                        <div class="cardName">Student Request</div>
                    </div>
                </a>
                <div class="iconBx">
                    <ion-icon name="people-outline"></ion-icon>

                </div>

            </div>

        </div>

        <!--order data list-->
        <div class="details">
            <div class="internshipAds">
                <div class="cardHeader">
                    <h2>Applied Advertisements Status</h2>
                    <a href="advertisement" class="btn view-btn">View All</a>
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
                    <?php
                    foreach ($ads as $a) { ?>

                        <tr>
                            <td><?php echo $a->company->name; ?></td>
                            <td><?php echo $a->position; ?></td>
                            <td style="color: <?php echo $a->status == 0 ? "blue" : ($a->status == 1 ? "green" : "red"); ?>"><?php echo $a->status == 0 ? "Pending" : ($a->status == 1 ? "Approved" : "Rejected"); ?></td>

                        </tr>
                    <?php } ?>
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