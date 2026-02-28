<?php
spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/includes/' . $class . '.php';
    $filepath = str_replace("/", DIRECTORY_SEPARATOR, $filepath);
    
    require_once $filepath;
});

use Portfolio\Database;

$db = new Database();

// Get the slug from the URL
$slug = $_GET['slug'] ?? '';

// Fetch the project by slug
$projects = $db->query("SELECT * FROM projects WHERE slug = :slug", ['slug' => $slug]);

// If no project found, show a 404 message
if (empty($projects)) {
    echo '<h1>Project not found</h1>';
    echo '<p><a href="index.php">Go back home</a></p>';
    exit;
}

$project = $projects[0];

// Fetch related data
$tags = $db->query("SELECT * FROM project_tags WHERE project_id = :id ORDER BY id ASC", ['id' => $project['id']]);
$tools = $db->query("SELECT tools.name, tools.icon_url FROM project_tools JOIN tools ON project_tools.tool_id = tools.id WHERE project_tools.project_id = :id ORDER BY project_tools.id ASC", ['id' => $project['id']]);
$gallery = $db->query("SELECT * FROM project_gallery WHERE project_id = :id ORDER BY id ASC", ['id' => $project['id']]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gekk Earbuds | Projects</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css" />
    <link rel="stylesheet" href="css/main.css">
    <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="alex_logo-favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="alex_logo-favicon/favicon.svg" />
    <link rel="shortcut icon" href="alex_logo-favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="alex_logo-favicon/apple-touch-icon.png" />
    <link rel="manifest" href="alex_logo-favicon/site.webmanifest" />
    
    <!-- Plyr -->
     <script defer src="https://cdn.plyr.io/3.8.3/plyr.js"></script>

    <!-- Main JavaScript -->
    <script type="module" defer src="js/home.js"></script>
</head>
<body>
    <h1 class="hidden">Gekk Earbuds - Alex Nguyen's Portfolio</h1>
    <header>
        <nav class="navbar">
            <h2 class="hidden">Main Navigation</h2>
            <div class="container nav-container">
                <a href="index.php" class="logo"><img src="images/Logo.svg" alt="Alex Nguyen Logo"></a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About Me</a></li>
                    <li><a href="contact.php" class="btn-nav">Contact</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <main>
    <!-- Project Intro -->
    <section class="project-intro">
        <div class="container">
            <h2 class="animate-fade-up"><?= htmlspecialchars($project['title']) ?></h2>
            <p class="project-description animate-fade-up">
                <?= htmlspecialchars($project['description']) ?>
            </p>
            <div class="project-tags animate-fade-up">
                <?php foreach ($tags as $tag) : ?>
                    <span class="tag"><?= htmlspecialchars($tag['name']) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <?php if ($project['video_src']) : ?>
    <section id="player-container">
        <h2><?= htmlspecialchars($project['video_title']) ?></h2>
        <video controls preload="metadata" poster="<?= htmlspecialchars($project['video_poster']) ?>">
            <source src="<?= htmlspecialchars($project['video_src']) ?>" type="video/webm">
            <p>You are using an older browser that does not support HTML5 Video. Please update your browser.</p>
        </video>
    </section>
    <?php endif; ?>

    <!-- Gallery Section -->
    <section class="project-gallery">
        <div class="container">
            <h3 class="section-title animate-fade-up"><?= htmlspecialchars($project['gallery_title']) ?></h3>
            <p class="section-subtitle animate-fade-up"><?= htmlspecialchars($project['gallery_subtitle']) ?></p>
            
            <div class="gallery-grid">
                <?php foreach ($gallery as $image) : ?>
                <div class="gallery-item animate-fade-up">
                    <img src="<?= htmlspecialchars($image['image_lg']) ?>"
                         srcset="<?= htmlspecialchars($image['image_sm']) ?> 150w,
                                 <?= htmlspecialchars($image['image_md']) ?> 300w,
                                 <?= htmlspecialchars($image['image_lg']) ?> 600w"
                         sizes="(max-width: 768px) 100vw, (max-width: 900px) 45vw, 580px"
                         alt="<?= htmlspecialchars($image['alt_text']) ?>"
                         loading="lazy">
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Featured Image with Text -->
            <div class="gallery-featured animate-fade-up">
                <div class="featured-text">
                    <span><?= htmlspecialchars($project['featured_label']) ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Case Study Section -->
    <section class="project-case-study">
        <div class="container">
            <h3 class="section-title animate-fade-up">Case Study</h3>
            <p class="section-subtitle animate-fade-up">The steps, the struggles, and the success</p>

            <div class="case-study-content">
                <!-- Problem Statement -->
                <div class="case-study-item animate-fade-up">
                    <h4>Problem Statement</h4>
                    <p><?= htmlspecialchars($project['problem']) ?></p>
                </div>

                <!-- Research and Findings -->
                <div class="case-study-item animate-fade-up">
                    <h4>Research and Findings</h4>
                    <p><?= htmlspecialchars($project['research']) ?></p>
                </div>

                <!-- Solution -->
                <div class="case-study-item animate-fade-up">
                    <h4>Solution</h4>
                    <p><?= htmlspecialchars($project['solution']) ?></p>
                </div>

                <!-- Duration -->
                <div class="case-study-duration animate-fade-up">
                    <span class="duration-label">Duration</span>
                    <span class="duration-value"><?= htmlspecialchars($project['duration_value']) ?></span>
                    <p><?= htmlspecialchars($project['duration_desc']) ?></p>
                </div>
            </div>

            <!-- Tools Used -->
            <div class="tools-section animate-fade-up">
                <h4>Tools Used</h4>
                <p class="tools-subtitle">My creative toolbox for this project</p>
                <div class="tools-grid">
                    <?php foreach ($tools as $tool) : ?>
                    <div class="tool-item">
                        <img src="<?= htmlspecialchars($tool['icon_url']) ?>" alt="<?= htmlspecialchars($tool['name']) ?>">
                        <span><?= htmlspecialchars($tool['name']) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Form Section -->
    <section class="cta-form-section animate-fade-up">
        <div class="container">
            <div class="cta-content">
                <h2>You're still here?</h2>
                <p>Yippie, that means that my work resonates with you, and we're ready to be (work) besties! Let your email here and I will reach you within 24 hours!</p>
                <form class="cta-form">
                    <input type="email" id="cta-email" name="email" placeholder="your.email@example.com" required>
                    <button type="submit" class="btn-cta">Let's Connect</button>
                </form>
                <div id="cta-feedback"></div>
                <p class="cta-note">Or reach out directly at <a href="contact.php" style="color: white; font-weight: 600;">contact page</a></p>
            </div>
        </div>
    </section>
    </main>

    <footer class="footer">
        <div class="container footer-layout">
            <div class="footer-social">
                <a href="https://www.linkedin.com/in/anh-nguyen-53280b266/" target="_blank" class="social-icon" aria-label="LinkedIn">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/linkedin/linkedin-original.svg" alt="Linkedin Icon"/>
                </a>
                <a href="https://github.com/Alex4747-J" target="_blank" class="social-icon" aria-label="GitHub">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg" alt="Github Icon">
                </a>
            </div>
            <div class="footer-logo">
                <a href="index.php"><img src="images/Logo.svg" alt="Alex Nguyen Logo"></a>
            </div>
        </div>
        <div class="container">
            <p class="copyright">Alex Nguyen © 2025. Built with code & raw determination (coffee)</p>
        </div>
    </footer>
</body>
</html>