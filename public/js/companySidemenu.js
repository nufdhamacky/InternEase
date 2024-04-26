const path = window.location.pathname;
const dashboard = document.querySelector('a[href="dashboard"]');
const ad = document.querySelector('a[href="ad"]');
const studentReq = document.querySelector('a[href="studentReq"]');
const shortlistedStu = document.querySelector('a[href="shortlistedStu"]');
const schedule = document.querySelector('a[href="schedule"]');
const recruitedStu = document.querySelector('a[href="recruitedStu"]');
const profile = document.querySelector('a[href="profile"]');

const color = "#CFE3EA";
const startUrl2 = '/internease/public/company';

if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/dashboard' || path === startUrl2 + '/totStudents') {
    dashboard.style.backgroundColor = color;
} 

// Highlight "Advertisements" for both ad and addAd
else if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/ad' || path === startUrl2 + '/addAd') {
    ad.style.backgroundColor = color;
}

else if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/studentReq') {
    studentReq.style.backgroundColor = color;
} 

else if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/shortlistedStu' || path === startUrl2 + '/shortlistedQA' || path === startUrl2 + '/shortlistedSE' || path === startUrl2 + '/shortlistedBA' || path === startUrl2 + '/scheduleInt') {
    shortlistedStu.style.backgroundColor = color;
} 

else if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/schedule' || path === startUrl2 + '/tech' || path === startUrl2 + '/companyVisit') {
    schedule.style.backgroundColor = color;
} 

else if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/recruitedStu' || path === startUrl2 + '/recruitedQA' || path === startUrl2 + '/recruitedSE' || path === startUrl2 + '/recruitedBA') {
    recruitedStu.style.backgroundColor = color;
}  

else if (path.startsWith(startUrl2 + '/index') || path === startUrl2 + '/profile') {
    profile.style.backgroundColor = color;
}