<?php
include_once('../app/controller/companyad.php');
$companyAdController = new CompanyAd();
$ads = $companyAdController->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Advertisement</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/ad.css">
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

        <!--order data list-->
        <div class="details">
            <div class="internshipAds">
                <div class="cardHeader">
                    <h2>Internship Advertisements</h2>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>No of Interns</td>
                        <td>Job</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($ads as $a) { ?>

                        <tr>
                            <td><?php echo $a->company->name; ?></td>
                            <td><?php echo $a->noOfIntern; ?></td>
                            <td><?php echo $a->position; ?></td>
                            <td style="color: <?php echo $a->status == 0 ? "blue" : ($a->status == 1 ? "green" : "red"); ?>"><?php echo $a->status == 0 ? "Pending" : ($a->status == 1 ? "Approved" : "Rejected"); ?></td>
                            <td>
                                <a href="<?= ROOT ?>/companyad/accept?id=<?php echo $a->adId; ?>"
                                   style="display: <?php echo $a->status == 0 ? "inline" : "none" ?>;color: green;text-decoration: none">Accept</a>
                                <a href="#"
                                   onclick="rejectAd(<?php echo $a->adId; ?>)"
                                   style="display: <?php echo $a->status == 0 ? "inline" : "none" ?>;color: red;text-decoration: none">Reject</a>
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
<script src="<?= ROOT ?>/js/advertisement.js"></script>
</body>
</html>