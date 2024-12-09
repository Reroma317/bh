document.addEventListener("DOMContentLoaded", () => {
    const rightContainer = document.querySelector(".right-container");
    const arrowButton = document.querySelector("#toggle-right-container");

    // Toggle the right container visibility
    arrowButton.addEventListener("click", () => {
        const isHidden = rightContainer.classList.toggle("hidden");
        arrowButton.innerHTML = isHidden ? "&larr;" : "&rarr;";
    });
});
