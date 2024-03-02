<?php
include_once('../app/controller/pdc.php');
include_once('../app/controller/companyad.php');
$pdController = new Pdc();
$companyAdController = new CompanyAd();
$ads = $companyAdController->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/dashboard.css">
</head>
<body>
<div class="container">
    <?php
    include_once('../app/view/layout/pdcSidemenu.php');

    ?>

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <ion-icon name="notifications-circle-outline"></ion-icon>
                <span><?php echo $_SESSION['userRole']; ?></span>
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>

        </div>
        <div class="cardBox">
            <div class="card">
                <a style="text-decoration: none" href="companylist">
                    <div>
                        <div class="number"><?php echo $pdController->getCompanyCount(); ?></div>
                        <div class="cardName">Registered Companies</div>
                    </div>
                </a>
                <div class="iconBx">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                </div>

            </div>
            <div class="card">
                <a style="text-decoration: none" href="managestudent">
                    <div>
                        <div class="number"><?php echo $pdController->getStudentCount(); ?></div>
                        <div class="cardName">Registered Students</div>
                    </div>
                </a>
                <div class="iconBx">
                    <ion-icon name="people-outline"></ion-icon>
                </div>

            </div>
            <!-- <div class ="card">
                <div>
                    <div class="number">1<sup>st</sup> & 2<sup>nd</sup></div>
                    <div class="cardName">Round Selection</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="folder-outline"></ion-icon>
                </div>

            </div> -->
            <div class="card">
                <a style="text-decoration: none" href="blacklistedcompanies">
                    <div>
                        <div class="number"><?php echo $pdController->getBlackListCompanyCount(); ?></div>
                        <div class="cardName">Black listed Companies</div>
                    </div>
                </a>
                <div class="iconBx">
                    <ion-icon name="bag-remove-outline"></ion-icon>
                </div>

            </div>

        </div>

        <!--order data list-->
        <div class="details">
            <div class="internshipAds">
                <div class="cardHeader">

                    <h2>Internship Advertisements</h2>
                    <a style="text-decoration: none" href="advertisement.php">
                        <a href="advertisement" class="btn">View All</a>
                    </a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>No of Interns</td>
                        <td>Job</td>
                        <td>Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($ads as $a) { ?>
                        <tr>
                            <td><?php echo $a->company->name; ?></td>
                            <td><?php echo $a->noOfIntern; ?></td>
                            <td><?php echo $a->position; ?></td>
                            <td style="padding: 10px">
                                <span style="border-radius: 10px;padding: 2px 10px;color: white;background-color: <?php echo $a->status == 0 ? "blue" : ($a->status == 1 ? "green" : "red"); ?>"><?php echo $a->status == 0 ? "Pending" : ($a->status == 1 ? "Approved" : "Rejected"); ?></span>
                            </td>

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