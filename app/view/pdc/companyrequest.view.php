<?php
include_once('../app/controller/pdc.php');
$pdController = new Pdc();
$page = $_GET['page'] ?? 1;
$pageData = $pdController->getPendingCompany($page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Request</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/ad.css">
</head>
<body>
<div class="details">
    <div class="internshipAds">
        <div class="cardHeader">
            <h2>Company Requests</h2>
        </div>
        <table>
            <thead>
            <tr>
                <td>Company Name</td>
                <td>Email</td>
                <td>Website</td>
                <td>Contact Person</td>
                <td>Contact No</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($pageData->data as $company) { ?>
                <tr>
                    <td><?php echo $company->name; ?></td>
                    <td><?php echo $company->email; ?></td>
                    <td>
                        <a href="<?php echo (strpos($company->website, 'http') === 0 ? '' : 'http://') . $company->website; ?>"><?php echo $company->website; ?></a>
                    </td>
                    <td><?php echo $company->contactPerson; ?></td>
                    <td><?php echo $company->contact; ?></td>
                    <td style="color: <?php echo $company->status == 0 ? "blue" : ($company->status == 1 ? "green" : "red"); ?>"><?php echo $company->status == 0 ? "Pending" : ($company->status == 1 ? "Approved" : "Rejected"); ?></td>
                    <td>
                        <a href="<?= ROOT ?>/pdc/acceptCompany?id=<?php echo $company->userId; ?>"
                           style="display: <?php echo $company->status == 0 || $company->status == 2 ? "inline" : "none" ?>;color: green;text-decoration: none">Accept</a>
                        <a href="#"
                           onclick="rejectCompany(<?php echo $company->userId; ?>)"
                           style="display: <?php echo $company->status == 0 || $company->status == 1 ? "inline" : "none" ?>;color: red;text-decoration: none">Reject</a>

                    </td>
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
<script src="<?= ROOT ?>/js/pdcCompany.js">


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

if (isset($pending) && $pending == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Company Accepted',
            text: 'Company is allowed to log in.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . ROOT . "/pdc/request'; // Correctly concatenated
            }
        });
    </script>";
} ?>
</body>
</html>