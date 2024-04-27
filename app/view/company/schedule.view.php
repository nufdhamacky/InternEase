<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Schedule</title>

    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companySchedule.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> 

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
                <input type="radio" name="slider" id="companyvisit">

                <nav>
                    <label for="intschedule" class="intschedule">Student Interview Schedule</label>
                    <label for="techschedule" class="techschedule">Tech-Talk Schedule</label>
                    <label for="companyvisit" class="companyvisit">Schedule Company Visit</label>
                    <div class="slider"></div>
                </nav>

                <section>
                    <div class="content content-1">
                        <!-- <div class="title">Interview Schedules of Students</div>
                        <p>Interview schedule table included</p> -->

                        <div class = "cardHeader">
                            <h2>Interview Schedule</h2>
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

                    <div class="content content-3">
                        
                        <div class="compdetails"> 
                            <div class = "cardHeader">
                                <h2>Schedule Company Visit</h2>
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

                </section>
            </div>
        </div>
            
        </div>
    </div>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
   $(document).ready(function() {
   $('#calendar').fullCalendar();
});
</script>
</body>
</html>