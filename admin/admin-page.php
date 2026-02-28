<?php
session_start();

// I use this for auth check
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/../includes/' . $class . '.php';
    $filepath = str_replace("/", DIRECTORY_SEPARATOR, $filepath);
    require_once $filepath;
});

use Portfolio\Database;

$db = new Database();
$projects = $db->query("SELECT * FROM projects ORDER BY id ASC");

// I use this to check for success/error messages
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../alex_logo-favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../alex_logo-favicon/favicon.svg" />
    <link rel="shortcut icon" href="../alex_logo-favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../alex_logo-favicon/apple-touch-icon.png" />
    <link rel="manifest" href="../alex_logo-favicon/site.webmanifest" />
</head>
<body>
    <div class="admin-header">
        <h1>Portfolio Admin</h1>
        <div>
            <a href="../index.php">View Site</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message) : ?>
            <div class="admin-message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="admin-top-bar">
            <h2>Projects (<?= count($projects) ?>)</h2>
            <a href="add-project.php" class="btn btn-primary">+ Add Project</a>
        </div>

        <table class="project-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- The foreach will loop help me populate the projects if I want to add more -->
                <?php foreach ($projects as $project) : ?>
                <tr>
                    <td><?= $project['id'] ?></td>
                    <td><?= htmlspecialchars($project['title']) ?></td>
                    <td><?= htmlspecialchars($project['slug']) ?></td>
                    <td><?= htmlspecialchars($project['duration_value']) ?></td>
                    <td>
                        <div class="actions">
                            <a href="edit-project.php?id=<?= $project['id'] ?>" class="btn btn-secondary">Edit</a>
                            <form class="delete-form" method="POST" action="delete-project.php" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                <input type="hidden" name="id" value="<?= $project['id'] ?>">
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>