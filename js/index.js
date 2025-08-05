//show menu bar
const nav = document.querySelector(".nav");
const toggle = document.querySelector(".nav-toggle");

toggle.onclick = () => {
  nav.classList.toggle("show-menu");
};

//remove menu bar
const navLink = document.querySelectorAll(".nav-link");
function linkaction() {
  const navMenu = Document.querySelector(".nav");
  nav.classList.remove("show-menu");
}
navLink.forEach((n) => n.addEventListener("click", linkaction));

//change color link
const linkcolor = document.querySelectorAll(".nav-link");
function colorlink() {
  if (colorlink) {
    linkcolor.forEach((l) => l.classList.remove("active"));
    this.classList.add("active");
  }
}
linkcolor.forEach((l) => l.addEventListener("click", colorlink));

//swipe home section
var swiper = new Swiper(".home-slider", {
  loop: true,
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

//swiper schedule section
var swiper = new Swiper(".time-imgs", {
  loop: true,
  spaceBetween: 0,
  grapCursor: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    640: {
      slidesPerView: 3,
    },
    768: {
      slidesPerView: 4,
    },
    1024: {
      slidesPerView: 5,
    },
  },
});

//change header background when scroll
const header = document.querySelector(".header");
window.addEventListener("scroll", () => {
  if (window.scrollY >= 70) {
    header.classList.add("header-shadow");
  } else header.classList.remove("header-show");
});

