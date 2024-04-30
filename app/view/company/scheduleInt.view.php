<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Interview</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyScheduleInt.css">
    <link rel="stylesheet" href="<?=ROOT?>/css/student/dashboard.css">
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

            <div class="submit">

                <a href="scheduleInt">
                    <button type="submit" class="sbtn">SCHEDULE INTERVIEW</button>
                </a>

                <!-- <a href="tech">
                    <button type="submit" class="sbtn">SCHEDULE TECH-TALK</button>
                </a>

                <a href="companyVisit">
                    <button type="submit"class="sbtn">SCHEDULE COMPANY VISIT</button>
                </a> -->
                
            </div>
        
            <div class="details">
                <!-- <div class="compdetails"> 
                    <div class = "cardHeader">
                        <h2>Create Interview Schedule</h2>
                    </div>   

                        <h4>Date Period:</h4>
                        <div class = "card">
                            <div class = "input-container">
                                <input type = "date" class = "bx1">
                            </div>
                            <h4 class = "h4">to</h4>
                            <div class = "input-container">
                                <input type = "date" class = "bx1">
                            </div>
                        </div>

                        <h4>Interview Duration:</h4>
                        <div class = "card">
                            <select>
                                
                                <option value = "30">40 min</option>
                                
                            </select>
                        </div>
        
                        

                        <div class="submit">
                            <a href="schedule"><button type="submit" class="btn">SAVE</button></a>
                        </div>

                        
                </div> -->
                <div class="container-calendar">
                    <div id="left">
                        <h1>Company Calendar - Interview Scheduler</h1>
                        <div id="event-section">
                            <h3>Schedule an Interview</h3>
                            <input type="date" id="interviewDate" placeholder="Interview Date">
                            <input type="time" id="startTime" placeholder="Start Time">
                            <input type="time" id="endTime" placeholder="End Time">
                            <input type="text" id="interviewTitle" placeholder="Interview Title">
                            <input type="text" id="interviewDescription" placeholder="Interview Description">
                            <input type="number" id="candidateCount" placeholder="No of candidates">
                            <button id="addInterview" onclick="addInterview()">
                                Schedule
                            </button>
                        </div>
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
            </div>
        
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    <script>
        // Array to hold existing interviews
let existingEvents = [];

// Initialize inputs and variables
let interviewDateInput = document.getElementById("interviewDate");
let startTimeInput = document.getElementById("startTime");
let endTimeInput = document.getElementById("endTime");
let interviewTitleInput = document.getElementById("interviewTitle");
let interviewDescriptionInput = document.getElementById("interviewDescription");
let candidateCountInput = document.getElementById("candidateCount");

let interviewIdCounter = 1; // Unique ID for interviews

// Fetch existing interviews from the server
function fetchEvents() {
    fetch("/InternEase/public/company/getScheduledInterviews") // Adjust the endpoint to your backend
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            existingEvents = data; // Store existing interviews
            showCalendar(currentMonth, currentYear); // Update calendar with events
            displayReminders(); // Show scheduled interviews
        })
        .catch((error) => {
            console.error("Error fetching interviews:", error);
        });
}

// Function to schedule a new interview
function addInterview() {
    let date = interviewDateInput.value;
    let startTime = startTimeInput.value;
    let endTime = endTimeInput.value;
    let title = interviewTitleInput.value;
    let description = interviewDescriptionInput.value;
    let candidateCount = candidateCountInput.value;

    if (!date || !startTime || !endTime || !title || !candidateCount) {
        alert("All fields must be filled");
        return;
    }

    // Ensure start time is before end time
    if (new Date(`${date}T${startTime}`) >= new Date(`${date}T${endTime}`)) {
        alert("Start time must be before end time");
        return;
    }

    // Check if the time slot is available
    if (!isTimeSlotAvailable(`${date}T${startTime}`, `${date}T${endTime}`)) {
        alert("The selected time slot is already booked.");
        return;
    }

    let newInterview = {
        date: interviewDateInput.value,
        startTime: startTimeInput.value,
        endTime: endTimeInput.value,
        title: interviewTitleInput.value,
        description: interviewDescriptionInput.value,
        candidateCount: candidateCountInput.value,
    };

    console.log(newInterview);
    fetch("/InternEase/public/company/addInterview", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            newInterview
        }),
    })

        .then((response) => {
            if (!response.ok) {
                throw new Error("Error scheduling interview");
            }
            return response.json();
        })
        .then((data) => {
            existingEvents.push(newInterview); // Add the interview to the array
            showCalendar(currentMonth, currentYear); // Refresh the calendar
            displayReminders(); // Refresh the list of interviews
            clearInputFields(); // Clear form inputs
            alert("Interview Scheduled");
        })
        .catch((error) => {
            console.error("Error scheduling interview:", error);
        });
}

// Function to clear input fields after scheduling
function clearInputFields() {
    interviewDateInput.value = "";
    startTimeInput.value = "";
    endTimeInput.value = "";
    interviewTitleInput.value = "";
    interviewDescriptionInput.value = "";
    candidateCountInput.value = "";
}

// Function to check if a time slot is available
function isTimeSlotAvailable(start, end) {
    let startMoment = new Date(start);
    let endMoment = new Date(end);

    return !existingEvents.some((event) => {
        let eventStart = new Date(`${event.date}T${event.startTime}`);
        let eventEnd = new Date(`${event.date}T${event.endTime}`);

        let startsDuringEvent = startMoment >= eventStart && startMoment <= eventEnd;
        let endsDuringEvent = endMoment >= eventStart && endMoment <= eventEnd;
        let wrapsEvent = eventStart >= startMoment && eventStart <= endMoment ||
                         eventEnd >= startMoment && eventEnd <= endMoment;

        return startsDuringEvent || endsDuringEvent || wrapsEvent;
    });
}

console.log(existingEvents);

// Function to display scheduled interviews as reminders
function displayReminders() {
    let reminderList = document.getElementById("reminderList");
    reminderList.innerHTML = ""; // Clear existing reminders

    existingEvents.forEach((event) => {
        let listItem = document.createElement("li");
        listItem.innerHTML = `<strong>${event.title}</strong> - 
        ${event.description} with ${event.candidateCount} candidate(s) 
        from ${event.startTime} to ${event.endTime} on ${event.date}`;

        let deleteButton = document.createElement("button");
        deleteButton.className = "delete-event";
        deleteButton.textContent = "Delete";
        deleteButton.onclick = function () {
            deleteEvent(event.id);
        };

        listItem.appendChild(deleteButton);
        reminderList.appendChild(listItem);
    });
}

// Function to delete an interview
function deleteEvent(eventId) {
    fetch(`/InternEase/public/company/deleteInterview?id=${eventId}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (response.ok) {
            existingEvents = existingEvents.filter(event => event.id !== eventId); // Remove the event from the array
            showCalendar(currentMonth, currentYear); // Refresh the calendar
            displayReminders(); // Update the reminders list
        } else {
            throw new Error('Failed to delete event');
        }
    })
    .catch(error => {
        console.error('Error deleting event:', error);
    });
}

// Initialize the calendar with existing interviews
fetchEvents();

    </script>
    <script src="<?=ROOT?>/js/calendar.js"></script>
</body>
</html>