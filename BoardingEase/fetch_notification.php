<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    die("You must be logged in.");
}

$host = 'localhost';
$dbname = 'boardingease';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch notifications for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate HTML for notifications
$output = '';
if (count($notifications) > 0) {
    foreach ($notifications as $notification) {
        $output .= '<div class="notification-card">';
        $output .= '<div class="notification-content">';
        $output .= '<p class="notification-message">' . htmlspecialchars($notification['message']) . '</p>';
        $output .= '<span class="notification-date">' . htmlspecialchars($notification['created_at']) . '</span>';
        $output .= '</div>';
        $output .= '</div>';
    }
} else {
    $output = '<p>No notifications yet.</p>';
}

echo $output;
?>
