<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $city = $_POST['city'] ?? null;
    $barangay = $_POST['barangay'] ?? null;
    $street = $_POST['street'] ?? null;
    $rooms = $_POST['rooms'] ?? null;
    $payment = $_POST['payment'] ?? null;

    if ($id && $city && $barangay && $rooms !== null && $payment !== null) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=boardingease', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Update the upload details
            $sql = 'UPDATE uploads SET city = :city, barangay = :barangay, street = :street, rooms = :rooms, payment = :payment WHERE id = :id AND user_id = :user_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':city' => $city,
                ':barangay' => $barangay,
                ':street' => $street,
                ':rooms' => $rooms,
                ':payment' => $payment,
                ':id' => $id,
                ':user_id' => $_SESSION['user_id']
            ]);

            // Log notification
            $notificationMessage = "You successfully updated your upload: $city, $barangay.";
            logNotification($pdo, $_SESSION['user_id'], $notificationMessage);

            header('Location: main.php'); // Redirect to the main page
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
}

// Function to log notifications
function logNotification($pdo, $userId, $message) {
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)");
    $stmt->execute([
        ':user_id' => $userId,
        ':message' => $message
    ]);
}
?>
