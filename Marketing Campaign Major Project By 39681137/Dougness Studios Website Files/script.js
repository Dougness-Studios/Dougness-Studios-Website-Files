// script.js
document.addEventListener("DOMContentLoaded", function () {

    // NAVBAR SHOW/HIDE ON SCROLL
    let prevScrollPos = window.pageYOffset;
    const navbar = document.getElementById("navbar");
    const navbarHeight = navbar.offsetHeight; // dynamic navbar height

    window.addEventListener("scroll", () => {
        const currentScrollPos = window.pageYOffset;

        if (prevScrollPos > currentScrollPos) {
            // Scrolling up - show navbar
            navbar.classList.remove("navbar-hidden");
        } else if (currentScrollPos > navbarHeight) {
            // Scrolling down past navbar - hide navbar
            navbar.classList.add("navbar-hidden");
        }

        prevScrollPos = currentScrollPos;
    });

    // ACTIVE PAGE DETECTION
    const links = document.querySelectorAll(".top-nav a");
    const currentPage = window.location.pathname.split("/").pop();

    links.forEach(link => {
        const linkPage = link.getAttribute("href");
        if (linkPage === currentPage) {
            link.classList.add("active");
        } else {
            link.classList.remove("active"); // optional: remove active from others
        }
    });

});