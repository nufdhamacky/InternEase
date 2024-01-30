const path=window.location.pathname;
const dashboard=document.getElementById('dashboard');
const ad=document.getElementById('ad');
const studentReq=document.getElementById('studentReq');
const shortlistedStu=document.getElementById('shortlistedStu');
const scheduleInt=document.getElementById('scheduleInt');
const profile=document.getElementById('profile');

const color="#CFE3EA";
const startUrl2 = '/internease/public/company';

if(path.startsWith('${startUrl2}/index')||path.startsWith('${startUrl2}/dashboard'))
{
    dashboard.style.backgroundColor=color;
}
else if(path.startsWith('${startUrl2}/index')||path.startsWith('${startUrl2}/ad'))
{
    ad.style.backgroundColor=color;
}
else if(path.startsWith('${startUrl2}/index')||path.startsWith('${startUrl2}/studentReq'))
{
    studentReq.style.backgroundColor=color;
}
else if(path.startsWith('${startUrl2}/index')||path.startsWith('${startUrl2}/shortlistedStu'))
{
    shortlistedStu.style.backgroundColor=color;
}
else if(path.startsWith('${startUrl2}/index')||path.startsWith('${startUrl2}/scheduleInt'))
{
    scheduleInt.style.backgroundColor=color;
}
else if(path.startsWith('${startUrl2}/index')||path.startsWith('${startUrl2}/profile'))
{
    profile.style.backgroundColor=color;
}