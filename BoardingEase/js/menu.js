document.addEventListener("DOMContentLoaded", () => {
    const menuButton = document.querySelector(".hamburger-btn");
    const menuBar = document.querySelector(".menu-bar");

    menuButton.addEventListener("click", () => {
        menuBar.classList.toggle("visible");
    });
});
