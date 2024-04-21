// const path = window.location.pathname;
// const home = document.querySelector('a[href="index"]');
// const about = document.querySelector('a[href="aboutus"]');
// const service = document.querySelector('a[href="services"]');
// const contactus = document.querySelector('a[href="contactus"]');

// const color = "#0B5A6F";
// const startUrl3 = '/internease/public/home';

// if (path.startsWith(startUrl3 + '/index') || path === startUrl3 + '/index') {
//     home.style.backgroundColor = color;
// } 

// else if (path.startsWith(startUrl3 + '/index') || path === startUrl3 + '/aboutus') {
//     about.style.backgroundColor = color;
// } 

// else if (path.startsWith(startUrl3 + '/index') || path === startUrl3 + '/services') {
//     service.style.backgroundColor = color;
// } 

// else if (path.startsWith(startUrl3 + '/index') || path === startUrl3 + '/contactus') {
//     contactus.style.backgroundColor = color;
// }

// const path = window.location.pathname;
// const home = document.querySelector('a[href="/internease/public/index"]');
// const about = document.querySelector('a[href="/internease/public/home/about"]');
// const service = document.querySelector('a[href="/internease/public/home/service"]');
// const contactus = document.querySelector('a[href="/internease/public/home/contact"]');

// const color = "#0B5A6F";

// if (path === '/internease/public/home/index' || path === '/internease/public/home/') {
//     home.style.backgroundColor = color;
// } else if (path === '/internease/public/home/about') {
//     about.style.backgroundColor = color;
// } else if (path === '/internease/public/home/service') {
//     service.style.backgroundColor = color;
// } else if (path === '/internease/public/home/contact') {
//     contactus.style.backgroundColor = color;
// }


    const path = window.location.pathname;
    const home = document.querySelector('a[href="home"]');
    const aboutus = document.querySelector('a[href="aboutus"]');
    const services = document.querySelector('a[href="services"]');
    const contactus = document.querySelector('a[href="contactus"]');

    const color = "#0B5A6F";
    const startUrl3 = '/internease/public/home';

    if (path.startsWith(startUrl3 + '/index' || path === startUrl2 + '/home')) {
        home.style.backgroundColor = color;
    }

    else if (path.startsWith(startUrl3 + '/index') || path === startUrl2 + '/aboutus') {
        aboutus.style.backgroundColor = color;
    } 

    else if (path.startsWith(startUrl3 + '/index') || path === startUrl2 + '/services') {
        services.style.backgroundColor = color;
    }

    else if (path.startsWith(startUrl3 + '/index') || path === startUrl2 + '/contactus') {
        contactus.style.backgroundColor = color;
    }