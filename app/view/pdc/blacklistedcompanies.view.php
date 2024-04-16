<?php
include_once('../app/controller/companyreport.php');
$reportController = new CompanyReport();
//$page = $_GET['page'] ?? 1;
//$pageData = $reportController->getAll($page);

$reports = $reportController->getAll();

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
<div class="details">
    <div class="companyList">
        <!--        <div class="cardHeader">-->
        <!--            <h2>Company List</h2>-->
        <!--            <a href="addblacklist" class="btn">Add</a>-->

        <!--        </div>-->
        <div class="cardHeader">
            <h2>Company Blacklist Report</h2>
        </div>
        <table>
            <thead>
            <tr>
                <td>Company Name</td>
                <td>Total Report</td>
                <td>Action</td>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($reports as $report) { ?>
                <tr>
                    <td><?php echo $report->name; ?></td>
                    <td><?php echo round((count($report->reports) / $report->totalRecruitments) * 100.0) . "%"; ?></td>
                    <td><a href="companyreport?id=<?php echo $report->userId; ?>">view</a></td>
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