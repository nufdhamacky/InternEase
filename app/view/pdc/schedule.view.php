<?php
include_once('../app/controller/pdc.php');
$pdcController = new Pdc();
$page = $_GET['page'] ?? 1;
$pageData = $pdcController->getAllCompanyVisits($page);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Visit</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/schedule.css">
</head>
<body>
<div class="container">
    <?php require_once('../app/view/layout/pdcSidemenu.php') ?>

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <span></span>
                <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
            </div>
        </div>
        <div class="secondbar">
            <div class="search">
                <ion-icon name="search-outline"></ion-icon>
                <input type="text" placeholder="Search Company" class="box1">
            </div>
        </div>
        
        <div id="seTable" class="details">
            <div class="studentdetails">
                <div class="cardHeader">
                    <h2>Company Visit Schedule</h2>
                    <a href="addschedule" class="btn">Add</a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Request Date</td>
                        <td>Visit Date</td>
                        <td>Reason</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData->data as $v) { ?>
                        <tr>
                            <td><?php echo $v->companyName; ?></td>
                            <td><?php echo $v->requestDate; ?></td>
                            <td><?php echo $v->visitDate ?? "Not Set"; ?></td>
                            <td><?php echo $v->reason; ?></td>
                            <td style="color: <?php echo $v->status == 0 ? "blue" : ($v->status == 1 ? "green" : "red"); ?>"><?php echo $v->status == 0 ? "Pending" : ($v->status == 1 ? "Approved" : "Rejected"); ?></td>
                            <td>
                                <!--                        <a href="viewstudent?id=-->
                                <?php //echo $v->id; ?><!--">view</a>-->
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div>
            <a href="?course=<?php echo $_GET["course"] ?? "all"; ?>&page=<?php echo $pageData->currentPage - 1; ?>"
               style="display: <?php echo $pageData->currentPage > 1 ? "inline" : "none"; ?>"
               class="btn">Previous</a>
            <a href="?course=<?php echo $_GET["course"] ?? "all"; ?>&page=<?php echo $pageData->currentPage + 1; ?>"
               style="display: <?php echo $pageData->currentPage > 0 && $pageData->currentPage < $pageData->totalPages ? "inline" : "none"; ?>"
               class="btn">Next</a>
        </div>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>