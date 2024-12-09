
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoardingEase</title>
    <link rel="stylesheet" href="css/main.css">
    <script defer src="js/searchupload.js"></script>
    <script defer src="js/search.js"></script>
    <script defer src="js/notification.js"></script>
    <script defer src="js/upload.js"></script>
    <script defer src="js/home.js"></script>
    <script defer src="js/editdelete.js"></script>
    <script defer src="js/profile.js"></script>
    <script defer src="js/profile2.js"></script>
    <script defer src="js/edit-profile.js"></script>
    <script defer src="js/edit-profile2.js"></script>
    <script defer src="js/request.js"></script>
    <script defer src="js/menu.js"></script>
    <script defer src="js/showright.js"></script>
</head>

<body>
    <nav class="navbar">
        <button class="hamburger-btn">&#9776;</button>
        <menu class="menu-bar hidden">
            <ul class="logo-menu">BoardingEase</ul>
            <div class="profile-pic">
                <img src="uploads/default-profile.jpg" alt="Profile Picture">
            </div>
            <div class="profile-details2">
                <p>Loading user information...</p> <!-- Placeholder until data is loaded -->
            </div>
            <!-- Edit Profile Button -->
            <button id="edit-profile-btn2" class="edit-profile-btn2">Edit Profile</button>
            <div class="logout-btn-menu">
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit">Logout</button>
                </form>
            </div>
            <!-- Edit Profile Modal -->
            <div id="edit-profile-modal2" class="modal hidden">
    <div class="modal-content">
        <span id="close-modal2" class="close">&times;</span>
        <h2>Edit Profile</h2>
        <form id="edit-profile-form" method="POST" action="edit_profile_process.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">

            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="confirm_password">

            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>
</div>
        </menu>


        <div class="logo">BoardingEase</div>
        <ul class="nav-links">
    <li><a href="#home">Home</a></li>
    <li><a href="#request id="request-btn">Request</a></li>
    <li><a href="#notification" id="notification-btn">Notification</a></li>
</ul>

<div class="logout-btn">
            <form action="includes/logout.inc.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
        
    </nav>
<body>
<div class="main-container">
        <!-- Fixed Profile Container -->
        <div class="fixed-container">
            <div class="profile-pic">
                <img src="uploads/default-profile.jpg" alt="Profile Picture">
            </div>
            <div class="profile-details">
                <p>Loading user information...</p> <!-- Placeholder until data is loaded -->
            </div>
            <!-- Edit Profile Button -->
            <button id="edit-profile-btn" class="edit-profile-btn">Edit Profile</button>
            </div>
            <!-- Edit Profile Modal -->
        <div id="edit-profile-modal" class="modal hidden">
    <div class="modal-content">
        <span id="close-modal" class="close">&times;</span>
        <h2>Edit Profile</h2>
        <form id="edit-profile-form" method="POST" action="edit_profile_process.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">

            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="confirm_password">

            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>
</div>
    </div>

        <!-- Newsfeed Container (Middle Section) -->
        <div class="newsfeed-container" id="newsfeed-container">
            <p>No data to show. Use the search form to find available rooms.</p>
        </div>

    <!-- Arrow Button -->
    <button id="toggle-right-container" class="arrow-button">&rarr;</button>

    <!-- Right Container -->
    <div class="right-container">
        <!-- Toggle Buttons -->
        <div class="toggle-buttons">
            <button id="show-search" class="active">Search</button>
            <button id="show-upload">Upload</button>
        </div>

        <!-- Search Form -->
        <div id="search-form" class="form-section">
            <h3>Search</h3>
            <form id="searchForm" method="POST">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>

                <label for="barangay">Barangay:</label>
                <input type="text" id="barangay" name="barangay" required>

                <label for="street">Street:</label>
                <input type="text" id="street" name="street">

                <label for="rooms">Available:</label>
                <input type="number" id="rooms" name="rooms" min="1">

                <label for="payment">Monthly Payment:</label>
                <input type="number" id="payment" name="payment" min="0">

                <button type="submit" class="submit-btn">Search</button>
            </form>
        </div>

        <!-- Upload Form -->
        <div id="upload-form" class="form-section hidden">
            <h3>Upload</h3>
            <form action="upload_process.php" method="POST" enctype="multipart/form-data">
                <label for="upload-city">City:</label>
                <input type="text" id="upload-city" name="upload_city" required>

                <label for="upload-barangay">Barangay:</label>
                <input type="text" id="upload-barangay" name="upload_barangay" required>

                <label for="upload-street">Street:</label>
                <input type="text" id="upload-street" name="upload_street">

                <label for="upload-rooms">Available:</label>
                <input type="number" id="upload-rooms" name="upload_rooms" min="1" required>

                <label for="upload-payment">Monthly Payment:</label>
                <input type="number" id="upload-payment" name="upload_payment" min="0" required>

                <!-- Photo Uploader -->
                <label for="upload-photos">Upload Photos:</label>
                <input type="file" id="upload-photos" name="upload_photos[]" accept="image/*" multiple>

                <button type="submit" class="submit-btn">Upload</button>
            </form>
        </div>
    </div>



<!-- Hidden Notification Content -->
<div id="notification-container">
    <!-- Notifications will be dynamically loaded here -->
</div>


</body>

</html>
