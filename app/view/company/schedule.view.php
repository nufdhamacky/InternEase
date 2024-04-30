<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companySchedule.css">

<style>
.modal-backdrop{
    z-index: -1;
}

.modal {
    display: none; 
    position: fixed;
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0);  
    background-color: rgba(0,0,0,0.4); /
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

button {
    margin: 10px;
    padding: 10px;
}

</style>
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

                <section class="section">
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

                              
                            </tbody>
                        </table>

                    </div>

                    <div class="content content-2">
                        <div class = "cardHeader">
                            <h2>Tech-Talk Schedules</h2>
                        </div>
                        <div id="tech_talk_calendar"></div>
                        <div class="modal" id="techTalkModal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="techTalkModalLabel">Schedule Tech Talk</h5>
                                    <button type="button" class="close" onclick="close_techModal()">&times;</button>
                                </div>
                                <div>
                                    <form id="techTalkForm">
                                        <div class="form-group">
                                            <label for="techTalkTitle">Description</label>
                                            <input type="text" class="form-control" id="techTalkTitle" placeholder="Enter Description">
                                        </div>
                                        <div class="form-group">
                                            <label for="techTalkStart" id="start">Start Date and Time</label>
                                            <input type="datetime-local" class="form-control" id="techTalkStart" style="display:none" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="datetime-local" class="form-control" id="techTalkEnd" style="display:none" readonly>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="content content-3">
                            
                  
                        <table>
                            <thead>
                            <tr>
                                <td>Request Date</td>
                                <td>Request Time</td>
                                <td>Visit Date</td>
                                <td>Visit Time</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $r){?>
                                <tr>
                                    <td><?php echo $r['requested_date'];?></td>
                                    <td><?php echo $r['requested_time'];?></td>
                                    <td><?php echo $r['visit_date'];?></td>
                                    <td><?php echo $r['visit_time'];?></td>
                                    <td style="<?php if($r['status']=='Pending'){                                       
                                        echo "color:blue;" ;
                                    }else if($r['status']=='Approved'){
                                        echo "color:green;" ;
                                    }else{
                                        echo "color:red;" ;
                                    }     ?>"
                                    
                                    ><?php echo $r['status'];?></td>
                                    <td>
                                    <?php if($r['status']=='Pending'){ ?>
                                        <button onclick="openModal(this)"
                                            data-requested_date="<?php echo $r['requested_date'];?>"
                                            data-requested_time="<?php echo $r['requested_time'];?>">Take Action</button>

                                    <?php }?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>

                        </div>

                        <div id="actionModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <h4>Take Action</h4>
                                <button id="acceptBtn" onclick="submitAction('Accepted', '')">Accept</button>
                                <button id="rejectBtn" onclick="showReject()">Reject</button>
                                <div id="rejectReason" style="display:none;">
                                    <textarea id="reasonText" placeholder="Enter reason for rejection..."></textarea>
                                    <label for="rejectionDate">Date:</label>
                                    <input type="datetime-local" id="rejectionDate">
                                    <button onclick="submitAction('Rejected', document.getElementById('reasonText').value)">Submit Reason</button>
                                </div>
                            </div>
                        </div>


                    </div>
    

                </section>
            </div>
        </div>
            
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   


<script>

    let currentRequestedDate = '';
    let currentRequestedTime = '';
    let start = '';
    let end = '';

    function openModal(element) {
        currentRequestedDate = element.getAttribute('data-requested_date');
        currentRequestedTime = element.getAttribute('data-requested_time');
        document.getElementById('actionModal').style.display = 'block';
    }
   

    function closeModal() {
        document.getElementById('actionModal').style.display = 'none';
        document.getElementById('rejectReason').style.display = 'none'; 
        }


    function showReject() {
        document.getElementById('rejectReason').style.display = 'block';
    }

    function techModal() {
            document.getElementById('techTalkModal').style.display = 'block';
        }


    function close_techModal() {
        document.getElementById('techTalkModal').style.display = 'none';
    }


    document.getElementById('techTalkForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var title = document.getElementById('techTalkTitle').value;
        sendScheduleData(start, end, title);
        close_techModal();
    });


    function submitAction(status, reason) {
            var rejectionDate = '';
            if (status === 'Rejected') {
                rejectionDate = document.getElementById('rejectionDate').value;
                if (!rejectionDate) {
                    alert('Please select a possible date for a visit');
                    return;
                }
            }

            let data = {
                status: status,
                reason: reason,
                rejectedDate: rejectionDate,
                requestedDate: currentRequestedDate, 
                requestedTime: currentRequestedTime  
            };

            sendDataToServer(data);
        }


    function sendDataToServer(data) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?=ROOT?>/company/send_action", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Response from server:', xhr.responseText);
                alert("Data submitted successfully.");
                closeModal(); 
            }
        };
        xhr.send(JSON.stringify(data));
    }

    function sendScheduleData(startDate, endDate, title) {

        var formattedStartDate = startDate.replace('A', ' ').split('.')[0] + ':00';
        var formattedEndDate = endDate.replace('A', ' ').split('.')[0] + ':00'

        console.log('Formatted Start', formattedStartDate);
        console.log('Formatted End', formattedEndDate);
        console.log('start', startDate);
        console.log('end', endDate);
        console.log('title', title);;

        $.ajax({
            url: '<?=ROOT?>/company/schedule_tech_talk',
            data: {
                title: title,
                start: formattedStartDate,
                end: formattedEndDate,
            },
            type: 'POST',
            success: function(response) {
                console.log(response); 
                setevent();
            },
            error: function(xhr, status, error) {
                console.error('Error sending schedule data: ' + error);
            }
        });
    }


    $(document).ready(function(){
        var existingEvents = []; 
        var selectedStart;
        var selectedEnd;

        function fetchEvents() {
                return $.ajax({
                    url: '<?=ROOT?>/company/request_techtalks',
                    type: 'GET',
                    dataType: 'json'
                }).then(function(response) {
                    existingEvents = response;
                }).fail(function() {
                    alert('There was an error while fetching events!');
                });
            }


        fetchEvents().then(function() {
                setupCalendar();
            });

        
        function setupCalendar() {
            var today = moment().format('YYYY-MM-DD');
            $('#calendar').fullCalendar();
            $('#tech_talk_calendar').fullCalendar({
                defaultView: 'agendaWeek',
                height: 600,
                aspectRatio: 2,
                contentHeight: 500,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'agendaMonth,agendaWeek,agendaDay'
                    },
                    validRange: {
                        start: today
                    },
                    dayClick: function(date, jsEvent, view) {
                    if (date.day() === 5 && date.hour() >= 8
                     && date.hour() <= 10) {    
                        selectedStart = date.format('YYYY-MM-DDTHH:mm');

                        selectedEnd = date.clone().add(2, 'hour').format('YYYY-MM-DDTHH:mm');

                        start=selectedStart;
                        end=selectedEnd;

                        startdate = selectedStart.split('A')[0];
                        starttime = selectedStart.split('A')[1];

                        enddate = selectedEnd.split('A')[0];
                        endtime = selectedEnd.split('A')[1];
                   

                        console.log("events",existingEvents);
                        if (isTimeSlotAvailable(selectedStart, selectedEnd)) {
                            $('#start').text("Scheduling for the date: "+startdate+"  From:"+starttime+"  To:"+endtime);

                           techModal();
                        } else {
                           slottaken();
                        }
                        
                    } else {
                            wrong_datetime();
                        }
                    },
                    events: {
                        url: '<?=ROOT?>/company/request_techtalks',
                        type: 'GET',
                        error: function() {
                            alert('There was an error while fetching events!');
                        },
                        eventClick: function(calEvent, jsEvent, view) {
                            alert('Event: ' + calEvent.title + '\nCompany: ' + calEvent.company );
                        }
                    }
                });
            }



            
            function isTimeSlotAvailable(start, end) {

                var formattedStart = start.replace('A', 'T');
                var formattedEnd = end.replace('A', 'T');

                console.log('Formatted start:', formattedStart);
                console.log('Formatted end:', formattedEnd);

                var startMoment = moment(formattedStart);
                var endMoment = moment(formattedEnd);

                if (!startMoment.isValid()) {
                    console.error('Invalid start date:', formattedStart);
                }

                if (!endMoment.isValid()) {
                    console.error('Invalid end date:', formattedEnd);
                }

                console.log('Start moment:', startMoment.format());
                console.log('End moment:', endMoment.format());

                return !existingEvents.some(function(event) {
                    var eventStart = moment(event.start);
                    var eventEnd = moment(event.end);

                    console.log('eventStart', eventStart.format());
                    console.log('eventEnd:', eventEnd.format());

                    var startsDuringEvent = startMoment.isBetween(eventStart, eventEnd, null, '[]');
                    var endsDuringEvent = endMoment.isBetween(eventStart, eventEnd, null, '[]');
                    var wrapsEvent = eventStart.isBetween(startMoment, endMoment, null, '[]') || 
                    eventEnd.isBetween(startMoment, endMoment, null, '[]');

                    return startsDuringEvent || endsDuringEvent || wrapsEvent;
                });
            }

       

       

    });

    function setevent(){
            Swal.fire({
                title: 'Tech Talk scheduled and set for confirmation',
                text: 'Time slot and date will reviewed and confirmed.',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?=ROOT?>/company/schedule'; 
                }
            });
        }

        function wrong_datetime(){
            Swal.fire({
                title: 'Invalid Date and Time',
                text: 'You can only schedule Tech-Talks on Fridays between 8 AM to 10 AM.',
                icon: 'warning',
                confirmButtonText: 'Close'
            });;
        }

        function slottaken(){
            Swal.fire({
                title: 'Slot already taken',
                text: 'Please choose another slot',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }

        // Listen for changes to the radio buttons
        $('input[name="slider"]').change(function() {
            // If the techschedule radio button is checked, render the calendar
            if ($('#techschedule').is(':checked')) {
                setTimeout(function() { // timeout for transition
                    $('#tech_talk_calendar').fullCalendar('render');
                }, 10);
            }
        });



   
       

</script>
</body>
</html>