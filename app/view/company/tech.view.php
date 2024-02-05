<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Tech-Talks</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyTech.css">
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
                        <span></span>
                        <ion-icon class="personicon" name="person-circle-outline"></ion-icon>
                    </div>
            </div>

            <div class="submit">
                <a href="scheduleInt">
                    <button type="submit" class="sbtn">SCHEDULE INTERVIEW</button>
                </a>

                <a href="tech">
                    <button type="submit" class="sbtn">SCHEDULE TECH-TALK</button>
                </a>

                <a href="companyVisit">
                    <button type="submit"class="sbtn">SCHEDULE COMPANY VISIT</button>
                </a>
            </div>

            <div class="details">
                <div class="compdetails"> 
                    <div class = "cardHeader">
                        <h2>Schedule Tech-Talks</h2>
                    </div>   

                    <h4>Date:</h4>
                    <div class = "input-container">
                        <input type = "date" class = "bx1">
                    </div>

                    <h4>Duration:</h4>
                    <div>
                        <select>
                            <option value = "1hr">1 hour</option>
                            <option value = "2hr">2 hours</option>
                        </select>
                    </div>

                    <h4>Time Slot:</h4>
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
                    <div class="submit">
                            <button type="submit" class="btn">SAVE</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>