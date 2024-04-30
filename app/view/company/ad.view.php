<?php
include_once('../app/controller/Company.php');

$allAdvertisements = $data['advertisements'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Advertisements</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/company/companyAd.css">
</head>
<body>

<div class="container">
    <?php require_once('../app/view/layout/companyMenubar.php') ?>

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <span><?php echo $_SESSION['companyName']; ?></span>
                <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
            </div>

        </div>

        <div class="details">
            <div class="heading-advertisement">
                <h2>Advertisements</h2>
                <a href="addAd">
                    <button class="add-advertisement">+ Add</button>
                </a>
            </div>
            <br>
            <div class="filter-details">
                <div class="secondbar">
                    <div class="search">
                        <ion-icon name="search-outline"></ion-icon>
                        <input type="text" placeholder="Search Position" class="box1">
                    </div>
                </div>
            </div>
            <br>


            <div class="studentdetails">
                <table>
                    <thead>
                    <tr>
                        <td>Position</td>
                        <td>Requirements</td>
                        <td>Qualification</td>
                        <td>Other Qualifications</td>
                        <td colspan="2">Internship Period</td>
                        <td>No. of Interns</td>
                        <td>No. of CVs Required</td>
                        <td>Working Mode</td>
                        <td>Scale</td>
                        <td>Status</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($allAdvertisements as $ad) { ?>
                        <tr>
                            <td><?php echo $ad->position; ?> </td>
                            <td><?php echo $ad->requirements; ?> </td>
                            <td><?php echo $ad->qualification; ?> </td>
                            <td><?php echo $ad->other_qualifications; ?> </td>
                            <td><?php echo $ad->fromDate; ?> </td>
                            <td><?php echo $ad->toDate; ?> </td>
                            <td><?php echo $ad->interns; ?> </td>
                            <td><?php echo $ad->no_of_cvs_required; ?> </td>
                            <td><?php echo $ad->workingMode; ?> </td>
                            <td><?php echo $ad->scale; ?></td>
                            <td style="color: <?php echo $ad->status == 0 ? "blue" : ($ad->status == 1 ? "green" : "red"); ?>"><?php echo $ad->status == 0 ? "Pending" : ($ad->status == 1 ? "Approved" : "Rejected"); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

</div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>