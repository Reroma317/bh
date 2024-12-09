<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized access.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $uploadId = $input['id'] ?? null;

    if ($uploadId) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=boardingease', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch the city and barangay before deleting
            $stmt = $pdo->prepare('SELECT city, barangay FROM uploads WHERE id = :id AND user_id = :user_id');
            $stmt->execute([
                ':id' => $uploadId,
                ':user_id' => $_SESSION['user_id']
            ]);
            $upload = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($upload) {
                $city = $upload['city'];
                $barangay = $upload['barangay'];

                // Delete the upload
                $stmt = $pdo->prepare('DELETE FROM uploads WHERE id = :id AND user_id = :user_id');
                $stmt->execute([
                    ':id' => $uploadId,
                    ':user_id' => $_SESSION['user_id']
                ]);

                // Log notification
                $notificationMessage = "$city,  $barangay was deleted.";
                logNotification($pdo, $_SESSION['user_id'], $notificationMessage);

                echo json_encode([
                    'success' => true,
                    'message' => " $city,  $barangay was successfully deleted.",
                    'city' => $city,
                    'barangay' => $barangay
                ]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Upload not found.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No upload ID provided.']);
    }
}

// Function to log notification
function logNotification($pdo, $userId, $message) {
    $stmt = $pdo->prepare('INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)');
    $stmt->execute([
        ':user_id' => $userId,
        ':message' => $message
    ]);
}
?>
