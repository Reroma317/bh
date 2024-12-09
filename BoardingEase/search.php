<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

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

// Fetch search criteria
$city = $_POST['city'] ?? '';
$barangay = $_POST['barangay'] ?? '';
$street = $_POST['street'] ?? '';
$rooms = $_POST['rooms'] ?? null;
$payment = $_POST['payment'] ?? null;

// Build query with placeholders
$sql = "SELECT * FROM uploads WHERE city LIKE :city AND barangay LIKE :barangay";
$params = [
    ':city' => '%' . $city . '%',
    ':barangay' => '%' . $barangay . '%',
];

if (!empty($street)) {
    $sql .= " AND street LIKE :street";
    $params[':street'] = '%' . $street . '%';
}

if (!empty($rooms)) {
    $sql .= " AND rooms >= :rooms";
    $params[':rooms'] = (int) $rooms;
}

if (!empty($payment)) {
    $sql .= " AND payment <= :payment";
    $params[':payment'] = (float) $payment;
}


$sql .= " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate HTML for search results
$output = '';
if (count($results) > 0) {
    foreach ($results as $result) {
        $photos = explode(',', $result['photos']);
        $output .= '<div class="search-result-card" data-upload-id="' . htmlspecialchars($result['id']) . '">';
        $output .= '<div class="result-header">';
        $output .= '<h4>' . htmlspecialchars($result['city']) . ', ' . htmlspecialchars($result['barangay']) . '</h4>';
        $output .= '<p>' . htmlspecialchars($result['street']) . '</p>';
        $output .= '</div>';
        $output .= '<div class="result-details">';
        $output .= '<p><strong>Available:</strong> ' . htmlspecialchars($result['rooms']) . '</p>';
        $output .= '<p><strong>Monthly Payment:</strong> ₱' . htmlspecialchars($result['payment']) . '</p>';
        if (!empty($photos[0])) {
            $output .= '<div class="result-images">';
            foreach ($photos as $photo) {
                $output .= '<img src="' . htmlspecialchars($photo) . '" alt="Photo" class="result-image">';
            }
            $output .= '</div>';
        }
        $output .= '</div>';
        $output .= '<div class="action-buttons">';
        $output .= '<button class="request-btn" data-upload-id="' . htmlspecialchars($result['id']) . '">Send Request</button>';
        $output .= '</div>';
        $output .= '</div>';
    } 
    
} else {
    $output = '<p>No results found.</p>';
}

echo $output;
?>

<style>
    .search-result-card {
        position: relative;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        max-height: 500px;
        overflow-y: auto;
    }

    .action-buttons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        gap: 10px;
    }

    .request-btn,
    .cancelrequest-btn {
        background-color: #2ecc71;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9em;
        transition: background-color 0.3s;
    }

    .cancelrequest-btn {
        background-color: #e74c3c;
    }

    .request-btn:hover {
        background-color: #27ae60;
    }

    .cancelrequest-btn:hover {
        background-color: #c0392b;
    }
</style>


