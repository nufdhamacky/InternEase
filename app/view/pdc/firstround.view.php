<?php
include_once('../app/controller/round.php');
include_once('../app/controller/pdc.php');
$roundController = new Round();
$pdcController = new Pdc();

$companies = $pdcController->getFullApprovedCompany();
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
                    <h4> Start Date : <span id="startDate">2024.01.03</span></h4>
                    <h4> End Date : <span id="endDate">2024.01.31</span></h4>
                    <br/>
                    <h4>No of advertisements students can apply: <span id="advertisementCount">4</span></h4>
                </div>

                <div class="submit">
                    <button onclick="editSection()">EDIT</button>
                </div>

                <div id="editSection" style="display: none;">
                    <h4>Date Period:</h4>
                    <div class="card">
                        <label for="editStartDate">Start Date:</label>
                        <div class="input-container">
                            <input type="date" id="editStartDate" name="start_date" class="bx1">
                        </div>
                        <h4 class="h4">to</h4>
                        <label for="editEndDate">End Date:</label>
                        <div class="input-container">
                            <input type="date" id="editEndDate" name="end_date" class="bx1">
                        </div>
                    </div>
                    <h4>No of advertisements students can apply:</h4>
                    <div class="card">
                        <label for="editAdvertisementCount">Select Count:</label>
                        <div class="input-container">
                            <select id="editAdvertisementCount" name="advertisement_count">
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="submit">
                            <button onclick="saveChanges()">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="" method="GET" class="filter-form">
            <div>
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

                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($students as $student) { ?>
                        <tr>
                            <td><?php echo $student->firstName . " " . $student->lastName; ?></td>
                            <td><?php echo $student->indexNo; ?></td>
                            <td><?php echo $student->email; ?></td>
                            <td><?php foreach ($student->ads as $r) {
                                    echo $r->company->name; ?> <br> <?php } ?></td>
                            <td>
                                <?php foreach ($student->ads as $r) {
                                    echo $r->position; ?> <br> <?php } ?>
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
        function editSection() {
            document.getElementById('viewSection').style.display = 'none';
            document.getElementById('editSection').style.display = 'block';
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
        }
    </script>
</body>
</html>
