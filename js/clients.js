let navbar = document.querySelector('.header .flex1 .navbar1');
let profile = document.querySelector('.header .flex1 .profile');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () => {
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

//Demandes

var rter1 = document.querySelector('.rter1');
var rter2 = document.querySelector('.rter2');
var lessons = document.querySelector('.lesson-block');
var nv = document.querySelector('.nv-block');

if (rter1 != null && rter2 != null) {
    rter1.addEventListener("click", () => {
        rter1.classList.add("active-router");
        lessons.classList.remove("disabled-block");
        rter2.classList.remove("active-router");
        nv.classList.add("disabled-block");
    });

    rter2.addEventListener("click", () => {
        rter2.classList.add("active-router");
        nv.classList.remove("disabled-block");
        rter1.classList.remove("active-router");
        lessons.classList.add("disabled-block");
    });
}

//Messages

var rter3 = document.querySelector('.rter3');
var rter4 = document.querySelector('.rter4');
var lessons2 = document.querySelector('.lessons-block');
var nv2 = document.querySelector('.nv-block2');

if (rter3 != null && rter4 != null) {
    rter3.addEventListener("click", () => {
        rter3.classList.add("active-router");
        lessons2.classList.remove("disabled-block");
        rter4.classList.remove("active-router");
        nv2.classList.add("disabled-block");
    });

    rter4.addEventListener("click", () => {
        rter4.classList.add("active-router");
        nv2.classList.remove("disabled-block");
        rter3.classList.remove("active-router");
        lessons2.classList.add("disabled-block");
    });
}