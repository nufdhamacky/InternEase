<?php
include_once('../app/controller/round.php');
include_once('../app/controller/pdc.php');
$roundController = new Round();
$pdcController = new Pdc();

$companies = $pdcController->getFullApprovedCompany();
$firstRound = $roundController->getFirstRound();
if (isset($_GET["company"]) && $_GET["company"] != "all") {
    $students = $roundController->filterFirstRoundStudents($_GET["company"]);
} else {
    $students = $roundController->getFirstRoundStudents();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Round</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/firstround.css">
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
                <span></span>
                <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
            </div>
        </div>
        <div class="details">
            <div class="compdetails">
                <div class="cardHeader">
                    <h2>First Round</h2>
                </div>

                <div id="viewSection">
                    <h4> Start Date : <span
                                id="startDate"><?php echo $firstRound == null ? "" : $firstRound->startDate; ?></span>
                    </h4>
                    <h4> End Date : <span
                                id="endDate"><?php echo $firstRound == null ? "" : $firstRound->endDate; ?></span></h4>
                    <br/>
                    <h4>No of advertisements students can apply: <span
                                id="advertisementCount"><?php echo $firstRound == null ? "" : $firstRound->count; ?></span>
                    </h4>
                </div>

                <div class="submit" id="editBtn">
                    <button onclick="editSection()">EDIT</button>
                </div>

                <div id="editSection" style="display: none;">
                    <h4>Date Period:</h4>
                    <form action="<?= ROOT ?>/round/addOrUpdate" method="POST">

                        <div class="card">
                            <input type="hidden" name="id" value="1">
                            <label for="editStartDate">Start Date:</label>
                            <div class="input-container">
                                <input type="date" id="editStartDate"
                                       value="<?php echo $firstRound == null ? "" : $firstRound->startDate; ?>"
                                       onchange="validateSaveBtn()"
                                       name="start_date" class="bx1">
                            </div>
                            <h4 class="h4">to</h4>
                            <label for="editEndDate">End Date:</label>
                            <div class="input-container">
                                <input type="date" id="editEndDate" name="end_date"
                                       value="<?php echo $firstRound == null ? "" : $firstRound->endDate; ?>"
                                       onchange="validateSaveBtn()"
                                       class="bx1">
                            </div>
                        </div>
                        <h4>No of advertisements students can apply:</h4>
                        <div class="card">
                            <!--                            <label for="editAdvertisementCount">Select Count:</label>-->
                            <div class="input-container">
                                <select id="editAdvertisementCount"
                                        name="advertisement_count">
                                    <?php
                                    for ($i = 1; $i <= 10; $i++) { ?>
                                        <option <?php echo $firstRound == null ? "" : ($firstRound->count == $i ? "selected" : ""); ?>
                                                value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="submit" id="saveBtn">
                                <button onclick="saveChanges()">SAVE</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <form action="" method="GET" class="filter-form">
            <div class="filter-container">
                <select name="company" id="company">
                    <option value="all">All</option>
                    <?php
                    foreach ($companies as $c) { ?>
                        <option <?php echo isset($_GET["company"]) ? $_GET["company"] == $c->userId ? "selected" : "" : ""; ?>
                                value='<?php echo $c->userId; ?>'><?php echo $c->name; ?></option>
                    <?php } ?>

                </select>
                <button type="submit" class="btn">Filter</button>
            </div>
        </form>
        <div class="details">
            <div class="internshipAds">
                <div class="cardHeader">
                    <h2>Applied Students</h2>
                </div>

                <table>
                    <thead>
                    <tr>
                        <td>Student Name</td>
                        <td>Index No</td>
                        <td>Email</td>
                        <td>Applied Companies</td>
                        <td>Job Roles</td>
                        <td>Status</td>
                        <td class="filter-column">

                        </td>

                    </tr>
                    <tr>
                        <td colspan="4">

                        </td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($students as $student) { ?>
                        <tr>
                            <td><?php echo $student->firstName . " " . $student->lastName; ?></td>
                            <td><?php echo $student->indexNo; ?></td>
                            <td><?php echo $student->email; ?></td>
                            <td><?php foreach ($student->ads as $r) { ?>
                                    <div>
                                        <span><?php echo $r->company->name; ?>  </span>
                                    </div>

                                <?php } ?>
                            </td>

                            <td>
                                <?php foreach ($student->ads as $r) {
                                    echo $r->position; ?> <br> <?php } ?>
                            </td>
                            <td>
                                <?php foreach ($student->ads as $r) { ?>

                                    <span style="color: <?php echo $r->firstRoundData->status == 1 ? "blue" : ($r->firstRoundData->status == 3 ? "green" : "transparent"); ?>"><?php echo $r->firstRoundData->status == 1 ? "SHORT-LISTED" : ($r->firstRoundData->status == 3 ? "RECRUITED" : ""); ?>  </span>
                                    <br>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        let oldStartDate;
        let oldEndDate;

        function editSection() {
            document.getElementById('saveBtn').style.display = 'none';
            document.getElementById('viewSection').style.display = 'none';
            document.getElementById('editSection').style.display = 'block';
            document.getElementById('editBtn').style.display = 'none';
            oldStartDate = document.getElementById('editStartDate').value;
            oldEndDate = document.getElementById('editEndDate').value;
        }

        function validateSaveBtn() {
            const startDate = document.getElementById('editStartDate').value;
            const endDate = document.getElementById('editEndDate').value;
            const advertisementCount = document.getElementById('editAdvertisementCount').value;

            if (startDate === "" || endDate === "" || advertisementCount === "") {
                document.getElementById('saveBtn').style.display = 'none';
            } else {
                if (new Date(startDate) < new Date()) {
                    alert("Start date should be greater than current date");
                    document.getElementById('saveBtn').style.display = 'none';
                    document.getElementById('editStartDate').value = oldStartDate;
                    return;
                }
                if (new Date(endDate) < new Date()) {
                    alert("End date should be greater than current date");
                    document.getElementById('saveBtn').style.display = 'none';
                    document.getElementById('editEndDate').value = oldEndDate;
                    return;
                }
                if (new Date(startDate) > new Date(endDate)) {
                    alert("Start date should be less than end date");
                    document.getElementById('saveBtn').style.display = 'none';
                    return;
                }
                document.getElementById('saveBtn').style.display = 'block';
                oldStartDate = startDate;
                oldEndDate = endDate;
            }
        }

        function saveChanges() {
            // You can use AJAX to send the edited values to the server and update the database
            // For simplicity, I'm updating the values directly on the client side
            document.getElementById('startDate').innerText = document.getElementById('editStartDate').value;
            document.getElementById('endDate').innerText = document.getElementById('editEndDate').value;
            document.getElementById('advertisementCount').innerText = document.getElementById('editAdvertisementCount').value;

            // Show the original values and hide the edit section
            document.getElementById('viewSection').style.display = 'block';
            document.getElementById('editSection').style.display = 'none';
            document.getElementById('editBtn').style.display = 'block';

        }
    </script>
</body>
</html>
