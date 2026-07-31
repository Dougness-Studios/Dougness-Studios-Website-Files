// script.js
document.addEventListener("DOMContentLoaded", function () {

    // --- 1. NAVBAR SHOW/HIDE ON SCROLL ---
    let prevScrollPos = window.pageYOffset;
    const navbar = document.getElementById("navbar");
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
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active"); 
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

    // --- 4. FORM STATUS NOTIFICATIONS ---
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const statusDiv = document.getElementById('form-status');

    if (status && statusDiv) {
        statusDiv.className = ""; 
        statusDiv.style.padding = "10px";
        statusDiv.style.marginBottom = "15px";
        statusDiv.style.borderRadius = "5px";
        statusDiv.style.fontWeight = "bold";
        statusDiv.style.textAlign = "center"; // Optional: centers the status text

        switch (status) {
            case 'success':
                statusDiv.innerText = "Message sent successfully!";
                statusDiv.style.backgroundColor = "#d4edda";
                statusDiv.style.color = "#155724";
                break;
            case 'empty':
                statusDiv.innerText = "Please fill in all fields.";
                statusDiv.style.backgroundColor = "#f8d7da";
                statusDiv.style.color = "#721c24";
                break;
            case 'invalidemail':
                statusDiv.innerText = "Please enter a valid email address.";
                statusDiv.style.backgroundColor = "#f8d7da";
                statusDiv.style.color = "#721c24";
                break;
            case 'error':
                statusDiv.innerText = "A database error occurred. Please try again later.";
                statusDiv.style.backgroundColor = "#f8d7da";
                statusDiv.style.color = "#721c24";
                break;
        }
    }
});
