<?php

session_start();

// If already logged in, go to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: admin-page.php');
    exit;
}

// Handle login form submission
$error = '';

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/../includes/' . $class . '.php';
    $filepath = str_replace("/", DIRECTORY_SEPARATOR, $filepath);
    require_once $filepath;
});

use Portfolio\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $users = $db->query("SELECT * FROM users WHERE username = :username", ['username' => $username]);

    if (!empty($users) && password_verify($password, $users[0]['password'])) {
        $_SESSION['user_id'] = $users[0]['id'];
        $_SESSION['username'] = $users[0]['username'];
        header('Location: admin-page.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../alex_logo-favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../alex_logo-favicon/favicon.svg" />
    <link rel="shortcut icon" href="../alex_logo-favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../alex_logo-favicon/apple-touch-icon.png" />
    <link rel="manifest" href="../alex_logo-favicon/site.webmanifest" />
</head>
<body class="login-page">
    <div class="login-box">
        <h1>Admin Login</h1>
        <p>Sign in to manage your portfolio</p>

        <?php if ($error) : ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form class="form-group" method="POST" action="login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button class="btn btn-primary" type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>