<?php
session_start();

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $connection = $db->connect();

    $stmt = $connection->prepare("INSERT INTO projects (title, slug, short_desc, description, problem, research, solution, duration_value, duration_desc, video_src, video_poster, video_title, thumbnail_sm, thumbnail_md, thumbnail_lg, featured_label, gallery_title, gallery_subtitle) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['slug'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['short_desc'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(5, $_POST['problem'], PDO::PARAM_STR);
    $stmt->bindParam(6, $_POST['research'], PDO::PARAM_STR);
    $stmt->bindParam(7, $_POST['solution'], PDO::PARAM_STR);
    $stmt->bindParam(8, $_POST['duration_value'], PDO::PARAM_STR);
    $stmt->bindParam(9, $_POST['duration_desc'], PDO::PARAM_STR);
    $stmt->bindParam(10, $_POST['video_src'], PDO::PARAM_STR);
    $stmt->bindParam(11, $_POST['video_poster'], PDO::PARAM_STR);
    $stmt->bindParam(12, $_POST['video_title'], PDO::PARAM_STR);
    $stmt->bindParam(13, $_POST['thumbnail_sm'], PDO::PARAM_STR);
    $stmt->bindParam(14, $_POST['thumbnail_md'], PDO::PARAM_STR);
    $stmt->bindParam(15, $_POST['thumbnail_lg'], PDO::PARAM_STR);
    $stmt->bindParam(16, $_POST['featured_label'], PDO::PARAM_STR);
    $stmt->bindParam(17, $_POST['gallery_title'], PDO::PARAM_STR);
    $stmt->bindParam(18, $_POST['gallery_subtitle'], PDO::PARAM_STR);

    $stmt->execute();

    $_SESSION['message'] = 'Project "' . $_POST['title'] . '" added successfully!';
    header('Location: admin-page.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project | Admin</title>
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

<body>
    <div class="admin-header">
        <h1>Portfolio Admin</h1>
        <a href="admin-page.php">Back to Admin Page</a>
    </div>

    <div class="admin-container">
        <a href="admin-page.php" class="back-link">← Back to Projects</a>
        <h2>Add New Project</h2>
        <div class="form-card">
            <form method="POST" action="add-project.php" enctype="multipart/form-data">
                
                <div class="admin-section-title">Basic Info</div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <p class="hint">URL-friendly name (e.g. gekk-earbuds). Also used as the image folder name.</p>
                    <input type="text" id="slug" name="slug" required>
                </div>
                <div class="form-group">
                    <label for="short_desc">Short Description</label>
                    <p class="hint">Shown on the homepage project card</p>
                    <textarea id="short_desc" name="short_desc" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Full Description</label>
                    <p class="hint">Shown at the top of the case study page</p>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>

                <div class="admin-section-title">Case Study</div>
                <div class="form-group">
                    <label for="problem">Problem Statement</label>
                    <textarea id="problem" name="problem" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="research">Research and Findings</label>
                    <textarea id="research" name="research" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="solution">Solution</label>
                    <textarea id="solution" name="solution" rows="4"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="duration_value">Duration</label>
                        <p class="hint">e.g. "1 week", "1 month"</p>
                        <input type="text" id="duration_value" name="duration_value">
                    </div>
                    <div class="form-group">
                        <label for="featured_label">Featured Label</label>
                        <p class="hint">e.g. "Branding"</p>
                        <input type="text" id="featured_label" name="featured_label">
                    </div>
                </div>
                <div class="form-group">
                    <label for="duration_desc">Duration Description</label>
                    <textarea id="duration_desc" name="duration_desc" rows="2"></textarea>
                </div>

                <div class="admin-section-title">Thumbnail Image</div>
                <p class="hint">Upload the URL with the naming convention in the project folder</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="thumbnail_sm">Small</label>
                        <input type="text" id="thumbnail_sm" name="thumbnail_sm" placeholder="images/project/thumb_S.jpg">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail_md">Medium</label>
                        <input type="text" id="thumbnail_md" name="thumbnail_md" placeholder="images/project/thumb_M.jpg">
                    </div>
                </div>
                <div class="form-group">
                    <label for="thumbnail_lg">Large</label>
                    <input type="text" id="thumbnail_lg" name="thumbnail_lg" placeholder="images/project/thumb_L.jpg">
                </div>

                <div class="admin-section-title">Video</div>
                <div class="form-group">
                    <label for="video_src">Video Source</label>
                    <input type="text" id="video_src" name="video_src" placeholder="https://www.youtube.com/watch?v=...">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="video_poster">Video Poster</label>
                        <input type="text" id="video_poster" name="video_poster" placeholder="Optional for now, not used for YouTube embeds">
                    </div>
                    <div class="form-group">
                        <label for="video_title">Video Title</label>
                        <input type="text" id="video_title" name="video_title">
                    </div>
                </div>

                <div class="admin-section-title">Gallery</div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="gallery_title">Gallery Title</label>
                        <input type="text" id="gallery_title" name="gallery_title" value="The Hall of Fame">
                    </div>
                    <div class="form-group">
                        <label for="gallery_subtitle">Gallery Subtitle</label>
                        <input type="text" id="gallery_subtitle" name="gallery_subtitle" value="A gallery showing my work in process and products">
                    </div>
                </div>

                <div class="submit-row">
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
    