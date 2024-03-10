<?php
include_once('../app/controller/companyreport.php');
$reportController = new CompanyReport();
//$page = $_GET['page'] ?? 1;
//$pageData = $reportController->getAll($page);
$id = $_GET["id"];
$reports = $reportController->getReportsByCompany($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Reports</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/com.css">
</head>
<body>
<div class="details">
    <div class="companyList">

        <table>
            <thead>
            <tr>
                <td>Reg No</td>
                <td>Reported By</td>
                <td>Reason</td>
                <td>Date</td>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($reports as $report) { ?>
                <tr>
                    <td><?php echo $report->student->regNo; ?></td>
                    <td><?php echo $report->student->firstName . " " . $report->student->lastName; ?></td>
                    <td><?php echo $report->reason; ?></td>
                    <td><?php echo $report->date; ?></td>
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