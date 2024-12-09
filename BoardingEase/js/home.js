
    document.addEventListener('DOMContentLoaded', () => {
        const homeBtn = document.querySelector('.nav-links a[href="#home"]');
        const newsfeedContainer = document.getElementById('newsfeed-container');

        // Function to fetch and display uploads
        function loadUploads() {
            fetch('fetch_uploads.php')
                .then(response => response.text())
                .then(data => {
                    newsfeedContainer.innerHTML = data; // Display the fetched uploads in the newsfeed
                })
                .catch(error => console.error('Error fetching uploads:', error));
        }

        // Attach click event to the "Home" button
        homeBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default navigation
            loadUploads();
        });

        // Optionally, load uploads on page load
        loadUploads();
    });


