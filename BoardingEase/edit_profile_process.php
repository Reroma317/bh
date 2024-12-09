<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;


    // Validate inputs
    if ($username && $email) {
        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
            exit();
        }

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=boardingease', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Update user details
            $sql = 'UPDATE users SET username = :username, email = :email';
            
            $params = [
                ':username' => $username,
                ':email' => $email,
                ':user_id' => $_SESSION['user_id']
            ];

            // Include password update if provided
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql .= ', pwd = :password';
                $params[':password'] = $hashedPassword;
            }
            
            $sql .= ' WHERE id = :user_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            // Log notification
            $notificationMessage = "You successfully updated your profile.";
            logNotification($pdo, $_SESSION['user_id'], $notificationMessage);
            
            header("Location: main.php");

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Username and email are required.";
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
