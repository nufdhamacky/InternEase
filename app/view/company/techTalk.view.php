<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule_II</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyTechTalk.css">
</head>
<body>
    <div class="container">
    <?php require_once('../app/view/layout/companyMenubar.php') ?>

        <div class ="main">
            <div class = "topbar">
                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <span>WSO2</span>
                    <ion-icon name="person-circle-outline" class = "personicon"></ion-icon>
                </div>
            </div>

            <div class = "left-part">
                <div class="details">
                    <div class="compdetails"> 

                        <div>
                            <ion-icon name="information-circle-outline"></ion-icon>
                            <h3>Tech Talks</h3>
                        </div>
                        <div>Date:</div>
                        <div class = "input-container">
                            <input type = "text" class = "bx1">
                            <ion-icon name="calendar-outline" class = "calendar-icon"></ion-icon>
                        </div>

                        <div>Duration:</div>
                        <div>
                            <select>
                                <option value = "1hr">1 hour</option>
                                <option value = "2hr">2 hours</option>
                            </select>
                        </div>

                        <div>Time Slot:</div>
                        <div class = "timeslot">
                            <div class = "select">
                                <select>
                                    <option value = "9">09.00 AM</option>
                                    <option value = "10">10.00 AM</option>
                                    <option value = "1030">10.30 AM</option>
                                    <option value = "11">11.00 AM</option>
                                </select>
                            </div>
                            <div>
                                <select>
                                    <option value = "10">10.00 AM</option>
                                    <option value = "1030">10.30 AM</option>
                                    <option value = "11">11.00 AM</option>
                                    <option value = "1130">11.30 AM</option>
                                </select>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>

            <div class = "right-part">
                <div class="detaiils">
                    <div class="compdetails">
                        <div>
                            <ion-icon name="information-circle-outline"></ion-icon>
                            <h3>Tech Talks</h3>
                        </div>
                        <div>Date:</div>
                        <div class = "input-container">
                            <input type = "text" class = "bx1">
                            <ion-icon name="calendar-outline" class = "calendar-icon"></ion-icon>
                        </div>

                        <div>Duration:</div>
                        <div>
                            <select>
                                <option value = "1hr">1 hour</option>
                                <option value = "2hr">2 hours</option>
                            </select>
                        </div>

                        <div>Time Slot:</div>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>