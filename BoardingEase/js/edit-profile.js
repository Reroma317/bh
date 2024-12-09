document.addEventListener("DOMContentLoaded", () => {
    // Select modal-related elements
    const modal = document.getElementById("edit-profile-modal");
    const openModalBtn = document.getElementById("edit-profile-btn");
    const closeModalBtn = document.getElementById("close-modal");

    // Open the modal when the edit button is clicked
    openModalBtn.addEventListener("click", () => {
        modal.classList.remove("hidden"); // Show the modal by removing the 'hidden' class
    });

    // Close the modal when the close button is clicked
    closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden"); // Hide the modal by adding the 'hidden' class
    });

    // Close the modal when clicking outside the modal content
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });
});
