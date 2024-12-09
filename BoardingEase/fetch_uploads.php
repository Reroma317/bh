<?php
session_start();

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

// Fetch uploads for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM uploads WHERE user_id = :user_id ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$uploads = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate HTML for uploads
$output = '';
if (count($uploads) > 0) {
    foreach ($uploads as $upload) {
        $photos = explode(',', $upload['photos']);
        $output .= '<div class="result-card" data-upload-id="' . htmlspecialchars($upload['id']) . '">';
$output .= '<div class="result-actions">';
$output .= '<button class="edit-btn" onclick="handleEdit(' . htmlspecialchars($upload['id']) . ')">Edit</button>';
$output .= '<button class="delete-btn" onclick="handleDelete(' . htmlspecialchars($upload['id']) . ')">Delete</button>';
$output .= '</div>';
$output .= '<div class="result-header">';
$output .= '<h4>' . htmlspecialchars($upload['city']) . ', ' . htmlspecialchars($upload['barangay']) . '</h4>';
$output .= '<p>' . htmlspecialchars($upload['street']) . '</p>';
$output .= '</div>';
$output .= '<div class="result-details">';
$output .= '<p><strong>Available:</strong> ' . htmlspecialchars($upload['rooms']) . '</p>';
$output .= '<p><strong>Monthly Payment:</strong> ₱' . htmlspecialchars($upload['payment']) . '</p>';
if (!empty($photos[0])) {
    $output .= '<div class="result-images">';
    foreach ($photos as $photo) {
        $output .= '<img src="' . htmlspecialchars($photo) . '" alt="Photo" class="result-image">';
    }
    $output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';


        

        $output .= '</div>';
    }
} else {
    $output = '<p>No uploads yet.</p>';
}

echo $output;
