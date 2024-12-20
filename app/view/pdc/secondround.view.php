<?php
include_once('../app/controller/round.php');
include_once('../app/controller/pdc.php');
$pdcController = new Pdc();
$roundController = new Round();

$secondRound = $roundController->getSecondRound();
$students = $roundController->getSecondRoundStudents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Round</title>
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
                    <h2>Second Round</h2>
                </div>


                <div id="viewSection">
                    <h4> Start Date : <span
                                id="startDate"><?php echo $secondRound == null ? "" : $secondRound->startDate; ?></span>
                    </h4>
                    <br/>
                    <h4> End Date : <span
                                id="endDate"><?php echo $secondRound == null ? "" : $secondRound->endDate; ?></span>
                    </h4>
                    <br/>
                    <h4>No of jobroles students can
                        apply: <?php echo $secondRound == null ? "" : $secondRound->count; ?></span></h4>

                    <div class="submit">
                        <button onclick="editSection()">EDIT</button>
                    </div>
                </div>

                <div id="editSection" style="display: none;">
                    <h4>Date Period:</h4>
                    <form action="<?= ROOT ?>/round/secondAddOrUpdate" method="POST">

                        <div class="card">
                            <input type="hidden" name="id" value="2">
                            <label for="editStartDate">Start Date:</label>
                            <div class="input-container">
                                <input type="date" id="editStartDate"
                                       name="start_date"
                                       value="<?php echo $secondRound == null ? "" : $secondRound->startDate; ?>"
                                       onchange="validateSaveBtn()"
                                       class="bx1">
                            </div>
                            <h4 class="h4">to</h4>
                            <label for="editEndDate">End Date:</label>
                            <div class="input-container">
                                <input type="date" id="editEndDate"
                                       name="end_date"
                                       value="<?php echo $secondRound == null ? "" : $secondRound->endDate; ?>"
                                       onchange="validateSaveBtn()"
                                       class="bx1">
                            </div>
                        </div>
                        <h4>No of job roles students can apply:</h4>
                        <div class="card">
                            <select id="editAdvertisementCount" name="job_role_count">
                                <?php
                                for ($i = 1; $i <= 10; $i++) { ?>
                                    <option <?php echo $secondRound == null ? "" : ($secondRound->count == $i ? "selected" : ""); ?>
                                            value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="submit" id="saveBtn">
                            <button onclick="saveChanges()">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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

                            <td>
                                <?php foreach ($student->jobRoles as $r) {
                                    echo $r; ?> <br> <?php } ?>
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
        }
    </script>
</body>
</html>
