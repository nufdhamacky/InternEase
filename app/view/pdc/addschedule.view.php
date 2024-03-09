<?php
include_once('../app/controller/pdc.php');
$pdcController = new Pdc();
$companies = $pdcController->getFullApprovedCompany();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Visit</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/addschedule.css">
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


        <form method="POST" action="<?= ROOT ?>/pdc/addVisitRequest">

            <div class="details">
                <div class="compdetails">
                    <div class="cardHeader">
                        <h2>Schedule Company Visit</h2>
                    </div>

                    <div class="form-container">
                        <h4>Company:</h4>
                        <div class="input-container">
                            <select id='testSelect1' name="company[]" multiple>
                                <?php
                                foreach ($companies as $c) { ?>
                                    <option value='<?php echo $c->userId; ?>'><?php echo $c->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <h4>Duration:</h4>
                        <div class="timeslot">
                            <input type="datetime-local" name="request_date"/>
                        </div>

                        <h4>Reason:</h4>
                        <div>
                            <textarea name="reason" rows="4" cols="50"></textarea>
                        </div>

                        <div class="submit">
                            <button id="signup_btn" name="submit" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

