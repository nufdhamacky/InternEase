const togglePassword = document.querySelector('.eye-icon');
const password = document.querySelector('.box2');

togglePassword.addEventListener('click', function (e) {
    
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    togglePassword.classList.toggle('bxs-hide');
    togglePassword.classList.toggle('bxs-show');
});

// var modal = document.getElementById("myModal");
// var btn = document.getElementById("signupBtn");
// var span = document.getElementByClassName("close")[0];

// btn.onclick = function(){
//     modal.style.display = "block";
// }

// span.onclick = function() {
//     modal.style.display = "none";
// }
// window.onclick = function(event) {
//     if (event.target == modal){
//         modal.style.displayj = "none";
//     }
// }