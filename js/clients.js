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

//module

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

// let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
// let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

// subImages.forEach(images => {
//     images.onclick = () => {
//         src = images.getAttribute('src');
//         mainImage.src = src;
//     }
// });