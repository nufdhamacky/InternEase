const path = window.location.pathname;
const dashboard = document.getElementById('dashboard');
const advertisement = document.getElementById('advertisement');
const manageStudent = document.getElementById('manage_student');
const manageCompany = document.getElementById('manage_company');
const roundSelection = document.getElementById('round_selection');
const request = document.getElementById('request');
const schedule = document.getElementById('schedule');
const profile = document.getElementById('profile');
const firstround = document.getElementById('firstround');

const color = "#CFE3EA";
const startUrl = '/internease/public/pdc';


if (path.startsWith(`${startUrl}/index`) || path.startsWith(`${startUrl}/dashboard`)) {
    dashboard.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/advertisement`)) {
    advertisement.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/managestudent`)) {
    manageStudent.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/managecompany`)) {
    manageCompany.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/roundselection`) || path.startsWith(`${startUrl}/firstround`) || path.startsWith(`${startUrl}/secondround`)) {
    roundSelection.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/request`)) {
    request.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/schedule`) || path.startsWith(`${startUrl}/addschedule`)) {
    schedule.style.backgroundColor = color;
} else if (path.startsWith(`${startUrl}/profile.php`)) {
    profile.style.backgroundColor = color;
}

