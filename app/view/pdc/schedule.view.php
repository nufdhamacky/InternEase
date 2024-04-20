<?php
include_once('../app/controller/pdc.php');
$pdcController = new Pdc();
$page = $_GET['page'] ?? 1;

if (isset($_GET['query'])) {
    $pageData = $pdcController->searchAllCompanyVisits($_GET['query'], $page);
} else {
    $pageData = $pdcController->getAllCompanyVisits($page);
}

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
                <form action="" id="searchForm" method="get">
                    <ion-icon name="search-outline"></ion-icon>
                    <input type="text" name="query" id="searchField" value="<?php echo $_GET["query"] ?? ""; ?>"
                           placeholder="Search Company" class="box1">
                    <button type="submit">Search</button>
                </form>

            </div>
        </div>
        <a href="<?= ROOT ?>/pdc/sendEmail">Send</a>
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
                            <td>
                                <a href="<?= ROOT ?>/pdc/acceptVisit?id=<?php echo $v->id; ?>"
                                   style="display: <?php echo $v->status == 0 && $v->visitDate != null ? "inline" : "none" ?>;color: green;text-decoration: none">Accept</a>
                                <a href="<?= ROOT ?>/pdc/rejectVisit?id=<?php echo $v->id; ?>"
                                   style="display: <?php echo $v->status == 0 && $v->visitDate != null ? "inline" : "none" ?>;color: red;text-decoration: none">Reject</a>
                                <a href="<?= ROOT ?>/pdc/deleteVisit?id=<?php echo $v->id; ?>"
                                   style="display: <?php echo $v->status == 0 && $v->visitDate == null ? "inline" : "none" ?>;color: red;text-decoration: none">Delete</a>
                            </td>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div>
            <a href="?page=<?php echo $pageData->currentPage - 1; ?>"
               style="display: <?php echo $pageData->currentPage > 1 ? "inline" : "none"; ?>"
               class="btn">Previous</a>
            <a href="?page=<?php echo $pageData->currentPage + 1; ?>"
               style="display: <?php echo $pageData->currentPage > 0 && $pageData->currentPage < $pageData->totalPages ? "inline" : "none"; ?>"
               class="btn">Next</a>
        </div>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="<?= ROOT ?>/js/schedule.js"></script>
</body>
</html>