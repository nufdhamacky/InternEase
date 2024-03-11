<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companySchedule.css">

    

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
                    <span><?php echo $_SESSION['companyName']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>
            
        <!--student data list-->
        <div class="details">
            <div class="studentdetails">
                <input type="radio" name="slider" id="intschedule" checked>
                <input type="radio" name="slider" id="techschedule">

                <nav>
                    <label for="intschedule" class="intschedule">Student Interview Schedule</label>
                    <label for="techschedule" class="techschedule">Tech-Talk Schedule</label>
                    <div class="slider"></div>
                </nav>

                <section>
                    <div class="content content-1">
                        <!-- <div class="title">Interview Schedules of Students</div>
                        <p>Interview schedule table included</p> -->

                        <div class = "cardHeader">
                            <h2>Interview Schedules</h2>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Student Name</td>
                                    <td>Registration No.</td>
                                    <td>Position</td>
                                    <td>Date Period</td>
                                    <td>Interview Duration</td>
                                    <td>Day</td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Hamsayini Senthilrasa</td>
                                    <td>2021/CS/065</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Nufdha Macky</td>
                                    <td>2021/CS/058</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Gien Gawesh</td>
                                    <td>2021/IS/024</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Shamah Lafir</td>
                                    <td>2021/IS/031</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Nufdha Macky</td>
                                    <td>2021/CS/014</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Hamsayini Senthilrasa</td>
                                    <td>2021/IS/027</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Gien Gawesh</td>
                                    <td>2021/IS/045</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Shamah Lafir</td>
                                    <td>2021/CS/085</td>
                                    <td>Software Engineer</td>
                                    <td>02/07/2024 - 09/07/2024</td>
                                    <td>40 mins</td>
                                    <td>Monday</td>
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="content content-2">
                        <div class = "cardHeader">
                            <h2>Tech-Talk Schedules</h2>
                        </div>
                        <div id="calendar"></div>
                    </div>
                </section>
            </div>
        </div>
            
        </div>
    </div>

    <script src="<?=ROOT?>/js/profile.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>