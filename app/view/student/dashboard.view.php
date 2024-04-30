<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>
            
            <div class="cards">
                <div class="card">
                    <div class="info"><?php echo isset($data['appliedAdsCount']) ? $data['appliedAdsCount'] : '0'; ?></div>
                    <div class="descr">
                        Jobs Applied
                    </div>
                    <div class="icon"><i class="fa-solid fa-briefcase"></i></div>
                </div>
                <div class="card">
                    <div class="info">4</div>
                    <div class="descr">
                        Interviews Scheduled
                    </div>
                    <div class="icon"><i class="fa-regular fa-handshake"></i></div>
                </div>
                <div class="card">
                    <div class="info"></div>
                    <div class="descr">
                        
                    </div>
                    <div class="icon"><i class="fa-solid fa-briefcase"></i></div>
                </div>
            </div>

            <div class="container-calendar">
                <div id="left">
                    <h1>Undergraduate Calendar</h1>
                    <!-- <div id="event-section">
                        <h3>Add Event</h3>
                        <input type="date" id="eventDate">
                        <input type="text"
                            id="eventTitle"
                            placeholder="Event Title">
                        <input type="text"
                            id="eventDescription"
                            placeholder="Event Description">
                        <button id="addEvent" onclick="addEvent()">
                            Add
                        </button>
                    </div> -->
                    <div id="reminder-section">
                        <h3>Scheduled Interviews</h3>
                        <!-- List to display reminders -->
                        <ul id="reminderList">
                            <li data-event-id="1">
                                <strong>Event Title</strong>
                                - Event Description on Event Date
                                <button class="delete-event"
                                    onclick="deleteEvent(1)">
                                    Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="right">
                    <h3 id="monthAndYear"></h3>
                    <div class="button-container-calendar">
                        <button id="previous"
                                onclick="previous()">
                            ‹
                        </button>
                        <button id="next"
                                onclick="next()">
                            ›
                        </button>
                    </div>
                    <table class="table-calendar"
                        id="calendar"
                        data-lang="en">
                        <thead id="thead-month"></thead>
                        <!-- Table body for displaying the calendar -->
                        <tbody id="calendar-body"></tbody>
                    </table>
                    <div class="footer-container-calendar">
                        <label for="month">Jump To: </label>
                        <!-- Dropdowns to select a specific month and year -->
                        <select id="month" onchange="jump()">
                            <option value=0>Jan</option>
                            <option value=1>Feb</option>
                            <option value=2>Mar</option>
                            <option value=3>Apr</option>
                            <option value=4>May</option>
                            <option value=5>Jun</option>
                            <option value=6>Jul</option>
                            <option value=7>Aug</option>
                            <option value=8>Sep</option>
                            <option value=9>Oct</option>
                            <option value=10>Nov</option>
                            <option value=11>Dec</option>
                        </select>
                        <!-- Dropdown to select a specific year -->
                        <select id="year" onchange="jump()"></select>
                    </div>
                </div>
            </div>


            <div class="details">
            <div class="internshipAds">
                <div class="cardHeader">

                    <h2>Internship Applications</h2>
                    <a style="text-decoration: none" href="advertisement.php">
                        <a href="applied" class="btn">View All</a>
                    </a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Job</td>
                        <td>Mode of Work</td>
                        <td>Status</td>
                    </tr>
                    </thead>
                    <tbody>
                   
                    <?php
                    if (isset($data['appliedAds']) && is_array($data['appliedAds'])) {
                        foreach ($data['appliedAds'] as $ad) {
                            echo '<tr>';
                            echo '<td>' . $ad['company_name'] . '</td>';
                            echo '<td>' . $ad['position'] . '</td>';
                            echo '<td>' . $ad['working_mode'] . '</td>';
                            echo '<td><span style="display: inline-block; border-radius: 10px; padding: 2px 10px; color: white; background-color:' . ($ad['applicationStatus'] == 0 ? "rgba(40, 36, 215, 0.84)" : ($ad['applicationStatus'] == 1 ? "rgba(25, 178, 59, 1)" : "red")) . '; width: 100px; text-align: center;">' . ($ad['applicationStatus'] == 0 ? "Pending" : ($ad['applicationStatus'] == 1 ? "Shortlisted" : ($ad['applicationStatus'] == 2 ? "Rejected" : "Recruited"))) . '</span></td>';
                            echo '</tr>';
                        }
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>




        </div>
</div>

<script>
    // JavaScript function to fetch and display scheduled interviews
    function fetchScheduledInterviews() {
        fetch("<?=ROOT?>/student/viewScheduledInterviews", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Failed to fetch scheduled interviews");
            }
            return response.json();
        })
        .then((data) => {
            // Clear existing list items
            const reminderList = document.getElementById("reminderList");
            reminderList.innerHTML = "";

            // Iterate through scheduled interviews and create list items
            data.scheduledInterviews.forEach((interview) => {
                const listItem = document.createElement("li");
                listItem.dataset.eventId = interview.id;
                listItem.innerHTML = `<strong>${interview.title}</strong> - ${interview.description} on ${interview.interview_date} from ${interview.start_time} to ${interview.end_time}`;
                reminderList.appendChild(listItem);
            });
        })
        .catch((error) => {
            console.error("Error fetching scheduled interviews:", error);
        });
    }

    // Call the function on page load
    window.onload = fetchScheduledInterviews;

</script>

<script src="<?=ROOT?>/js/calendar.js"></script>

<?php require_once("../app/view/inc/footer.php"); ?>