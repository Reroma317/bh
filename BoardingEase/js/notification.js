document.addEventListener('DOMContentLoaded', () => {
    const notificationBtn = document.getElementById('notification-btn');
    const newsfeedContainer = document.getElementById('newsfeed-container');

    // Function to fetch and display notifications
    function loadNotifications() {
        fetch('fetch_notification.php')
            .then(response => response.text())
            .then(data => {
                newsfeedContainer.innerHTML = data; // Display the fetched notifications in the newsfeed
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Attach click event to the notification button
    notificationBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default navigation
        loadNotifications();
    });
});
