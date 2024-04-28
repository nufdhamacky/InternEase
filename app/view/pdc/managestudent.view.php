<?php
include_once('../app/controller/pdc.php');
$pdController = new Pdc();
$page = $_GET['page'] ?? 1;
if (isset($_GET['course'])) {
    $pageData = $pdController->filterByCourse($_GET['course'], $page);
} else {
    $pageData = $pdController->getAllStudent($page);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Manage Student</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/stu.css">
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
            <div class="studentList">
                <div class="cardHeader">
                    <h2>Students List</h2>
                    <form id="csvForm" action="<?= ROOT ?>/pdc/addBulkStudent" method="post"
                          enctype="multipart/form-data">
                        <input type="file" id="csv" name="csv" accept="text/csv" onchange="uploadCsvStudents()">

                        <span id="csvName"></span>
                    </form>
                    <a href="addstudent" class="btn">Add</a>
                </div>

                <form action="" method="GET" class="filter-form">
                    <div>
                        <select name="course" id="course">
                            <option value="all">All</option>
                            <option value="CS" <?php echo isset($_GET["course"]) ? $_GET["course"] == "CS" ? "selected" : "" : ""; ?>>
                                CS
                            </option>
                            <option value="IS" <?php echo isset($_GET["course"]) ? $_GET["course"] == "IS" ? "selected" : "" : ""; ?>>
                                IS
                            </option>
                            7
                        </select>
                        <button type="submit" class="btn">Filter</button>
                    </div>
                </form>

                <table>
                    <thead>
                    <tr>
                        <td>Student Name</td>
                        <td>Registration No</td>
                        <td>Email</td>
                        <td>Index no</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData->data as $student) { ?>
                        <tr>
                            <td><?php echo $student->firstName . " " . $student->lastName; ?></td>
                            <td><?php echo $student->regNo; ?></td>
                            <td><?php echo $student->email; ?></td>
                            <td><?php echo $student->indexNo; ?></td>
                            <td>
                                <a href="viewstudent?id=<?php echo $student->userId; ?>">view</a>
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
<script src="<?= ROOT ?>/js/managestudent.js"></script>
</body>
</html>