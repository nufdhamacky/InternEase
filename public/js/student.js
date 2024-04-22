let sidebar = document.querySelector('.navigation');
let topbar = document.querySelector('.top-bar');
let main = document.querySelector('.main');
let menubtn = document.querySelector('#menu');

document.querySelector('#menu').onclick = () => {
    sidebar.classList.toggle('active');
    topbar.classList.toggle('active');
    main.classList.toggle('active');

    if (sidebar.classList.contains('active')) {
        menubtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
    } else {
        // Reset menu button inner HTML when sidebar is not active
        menubtn.innerHTML = '<i class="fa-solid fa-xmark"></i>'; 
    }
}