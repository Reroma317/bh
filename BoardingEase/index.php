<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script defer src="js/index.js"></script>
    <title>BoardingEase - Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="form-container">
            <!-- Login Form -->
            <div class="form-box login">
                <h1>Login</h1>
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="username" placeholder="Username" required><br>
                    <input type="password" name="pwd" placeholder="Password" required><br>
                    <button type="submit">Login</button>
                </form>
                <div class="link">
                    <p>Don't have an account? <a href="#" class="toggle-signup">Signup</a></p>
                </div>
                <div class="errors">
                    <?php check_login_errors(); ?>
                </div>
            </div>

            <!-- Signup Form -->
            <div class="form-box signup">
                <h1>Signup</h1>
                <form action="includes/signup.inc.php" method="post">
                    <?php signup_inputs(); echo '<br>'; ?>
                    <button type="submit">Signup</button>
                </form>
                <div class="link">
                    <p>Already have an account? <a href="#" class="toggle-login">Login</a></p>
                </div>
                <div class="errors">
                    <?php check_signup_errors(); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
