<?php
include_once('../app/controller/pdc.php');
$pdController = new Pdc();
$page = $_GET['page'] ?? 1;
$pageData = $pdController->getApprovedCompany($page);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Manage Company</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/com.css">
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
                   href="blacklistedcompanies">

                    <div>
                        <div class="number"><?php echo $pdController->getBlackListCompanyCount() ?></div>
                        <div class="cardName">Black listed Companies</div>
                    </div>
                </a>
                <div class="iconBx">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                </div>

            </div>
        </div>


        <!--order data list-->
        <div class="details">
            <div class="companyList">
                <div class="cardHeader">
                    <h2>Company List</h2>
                    <a href="companyrequest" class="btn">Add</a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Contact person</td>
                        <td>Email</td>
                        <td>Contact no</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($pageData->data as $company) { ?>
                        <tr>
                            <td><?php echo $company->name; ?></td>
                            <td><?php echo $company->contactPerson; ?></td>
                            <td><?php echo $company->email; ?></td>
                            <td><?php echo $company->contact; ?></td>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div align="center">
                    <a href="?page=<?php echo $pageData->currentPage - 1; ?>"
                       style="display: <?php echo $pageData->currentPage > 1 ? "inline" : "none"; ?>"
                       class="btn">Previous</a>
                    <a href="?page=<?php echo $pageData->currentPage + 1; ?>"
                       style="display: <?php echo $pageData->currentPage > 0 && $pageData->currentPage < $pageData->totalPages ? "inline" : "none"; ?>"
                       class="btn">Next</a>
                </div>
            </div>
        </div>


    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>