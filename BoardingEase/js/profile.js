document.addEventListener("DOMContentLoaded", () => {
    const profileDetails = document.querySelector(".profile-details");

    // Fetch user data from the PHP backend
    fetch("profile.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                profileDetails.innerHTML = `<p>${data.error}</p>`;
            } else {
                profileDetails.innerHTML = `
                    <p><strong>Name:</strong> ${data.username}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                `;
            }
        })
        .catch((error) => {
            profileDetails.innerHTML = `<p>Error fetching user data: ${error.message}</p>`;
        });
});
