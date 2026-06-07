// script.js
document.addEventListener("DOMContentLoaded", function () {

    // --- 1. NAVBAR SHOW/HIDE ON SCROLL ---
    let prevScrollPos = window.pageYOffset;
    const navbar = document.getElementById("navbar");
    // Ensure navbar exists before accessing offsetHeight
    if (navbar) {
        const navbarHeight = navbar.offsetHeight;

        window.addEventListener("scroll", () => {
            const currentScrollPos = window.pageYOffset;
            if (prevScrollPos > currentScrollPos) {
                navbar.style.top = "0"; // Show
            } else if (currentScrollPos > navbarHeight) {
                navbar.style.top = "-80px"; // Hide
            }
            prevScrollPos = currentScrollPos;
        });
    }

    // --- 2. ACTIVE PAGE DETECTION ---
    const links = document.querySelectorAll(".top-nav a");
    const currentPage = window.location.pathname.split("/").pop();

    links.forEach(link => {
        // Ensure link attributes match the current page
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active"); // Changed to 'active' to match CSS
        }
    });
    
    // --- 3. MOBILE MENU TOGGLE ---
    const menuToggle = document.getElementById('menu-toggle');
    const navLinks = document.getElementById('nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
});