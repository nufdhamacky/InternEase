const path=window.location.pathname;
const dashboard=document.getElementById('dashboard');
const advertisement=document.getElementById('advertisement');
const manageStudent=document.getElementById('manage_student');
const manageCompany=document.getElementById('manage_company');
const roundSelection=document.getElementById('round_selection');
const request=document.getElementById('request');
const schedule=document.getElementById('schedule');
const profile=document.getElementById('profile');
const color="#CFE3EA";
if(path.startsWith('/PDC/index.php'))
{
    dashboard.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/advertisement.php'))
{
    advertisement.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/managestudent.php'))
{
    manageStudent.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/managecompany.php'))
{
    manageCompany.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/roundselection.php'))
{
    roundSelection.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/request.php'))
{
    request.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/schedule.php'))
{
    schedule.style.backgroundColor=color;
}
else if(path.startsWith('/PDC/profile.php'))
{
    profile.style.backgroundColor=color;
}