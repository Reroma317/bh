<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

$host = 'localhost';
$dbname = 'boardingease';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed:" . $e->getMessage();
}

if (isset($_GET['id'])) {
    $uploadId = $_GET['id'];

    try {
        $sql = 'SELECT * FROM uploads WHERE id = :id AND user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $uploadId,
            ':user_id' => $_SESSION['user_id']
        ]);
        $upload = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($upload) {
            // Display the edit form and pre-fill it with the current data
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Upload</title>
                <style>
                    body {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background-color: #f0f4f8;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        min-height: 100vh;
                        margin: 0;
                        padding: 20px;
                    }
                    .form-container {
                        background-color: #ffffff;
                        border-radius: 12px;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                        padding: 2rem;
                        width: 100%;
                        max-width: 600px;
                        overflow: hidden;
                        display: flex;
                        flex-direction: column;
                    }
                    .form-container h2 {
                        margin-bottom: 1rem;
                        color: #333;
                        text-align: center;
                    }
                    .form-group {
                        margin-bottom: 1rem;
                    }
                    .form-group label {
                        display: block;
                        margin-bottom: 0.5rem;
                        color: #555;
                        font-weight: 500;
                    }
                    .form-group input {
                        width: 100%;
                        padding: 0.5rem;
                        border: 1px solid #ccc;
                        border-radius: 8px;
                        font-size: 1rem;
                        outline: none;
                        transition: border-color 0.3s, box-shadow 0.3s;
                    }
                    .form-group input:focus {
                        border-color: #007bff;
                        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                    }
                    .form-group button {
                        background-color: #007bff;
                        color: #ffffff;
                        border: none;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        cursor: pointer;
                        font-size: 1rem;
                        transition: background-color 0.3s, transform 0.3s;
                    }
                    .form-group button:hover {
                        background-color: #0056b3;
                        transform: translateY(-2px);
                    }
                    .form-group .cancel-button {
                        background-color: #ccc;
                        margin-left: 1rem;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        text-decoration: none;
                        display: inline-block;
                        color: #333;
                        font-size: 1rem;
                        transition: background-color 0.3s, transform 0.3s;
                    }
                    .form-group .cancel-button:hover {
                        background-color: #aaa;
                        transform: translateY(-2px);
                    }
                </style>
            </head>
            <body>
                <div class="form-container">
                    <h2>Edit Upload</h2>
                    <form action="update_upload.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($upload['id']); ?>">
                        
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($upload['city']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="barangay">Barangay:</label>
                            <input type="text" name="barangay" id="barangay" value="<?php echo htmlspecialchars($upload['barangay']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="street">Street:</label>
                            <input type="text" name="street" id="street" value="<?php echo htmlspecialchars($upload['street']); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="rooms">Available Rooms:</label>
                            <input type="number" name="rooms" id="rooms" value="<?php echo htmlspecialchars($upload['rooms']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="payment">Monthly Payment:</label>
                            <input type="number" name="payment" id="payment" value="<?php echo htmlspecialchars($upload['payment']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit">Save Changes</button>
                            <a href="main.php" class="cancel-button">Cancel</a>
                        </div>
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Upload not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
