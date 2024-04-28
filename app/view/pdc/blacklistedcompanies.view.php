<?php
include_once('../app/controller/companyreport.php');
$reportController = new CompanyReport();
//$page = $_GET['page'] ?? 1;
//$pageData = $reportController->getAll($page);

$reports = $reportController->getAll();
$companies = $reportController->getBlackCompanies();

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
<div class="cardBox">
    <div class="card">
        <a style="text-decoration: none"
           href="<?php echo $reportController->getReportCount() > 0 ? "companyreportpercentage" : "#"; ?>">
            <div>
                <div class="number"><?php echo $reportController->getReportCount(); ?></div>

                <div class="cardName">Company Complaints</div>
            </div>
        </a>
        <div class="iconBx">
            <ion-icon name="bag-handle-outline"></ion-icon>
        </div>

    </div>
</div>
<div class="details">
    <div class="companyList">
        <!--        <div class="cardHeader">-->
        <!--            <h2>Company List</h2>-->
        <!--            <a href="addblacklist" class="btn">Add</a>-->

        <!--        </div>-->
        <div class="cardHeader">
            <h2>Blacklisted Companies</h2>
        </div>
        <table>
            <thead>
            <tr>
                <td>Company Name</td>
                <td>Contact Person</td>
                <td>Contact No</td>
                <td>Reason</td>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($companies as $company) { ?>
                <tr>
                    <td><?php echo $company->company->name; ?></td>
                    <td><?php echo $company->company->contactPerson; ?></td>
                    <td><?php echo $company->company->contact; ?></td>
                    <td><?php echo $company->reason; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

