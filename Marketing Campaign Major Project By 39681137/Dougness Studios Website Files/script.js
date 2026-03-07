// script.js
let prevScrollPos = window.pageYOffset;
const navbar = document.getElementById("navbar");
// Get the navbar height dynamically
const navbarHeight = navbar.offsetHeight; 

window.addEventListener('scroll', () => {
    let currentScrollPos = window.pageYOffset;

    if (prevScrollPos > currentScrollPos) {
        // Scrolling up - show navbar
        navbar.classList.remove("navbar-hidden");
    } else {
        // Scrolling down - hide navbar, only if scrolled past the navbar height
        if (currentScrollPos > navbarHeight) {
           navbar.classList.add("navbar-hidden");
        }
    }
    
    // Update the previous scroll position
    prevScrollPos = currentScrollPos; 
});
