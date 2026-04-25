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

$projects = $db->query("SELECT * FROM projects ORDER BY id ASC");
$tags = $db->query("SELECT * FROM project_tags ORDER BY id ASC");

// Build a unique list of tag names for the filter buttons
$uniqueTags = [];
foreach ($tags as $tag) {
    if (!in_array($tag['name'], $uniqueTags)) {
        $uniqueTags[] = $tag['name'];
    }
}

// Build a lookup: project_id => array of tag names
$projectTags = [];
foreach ($tags as $tag) {
    $projectTags[$tag['project_id']][] = $tag['name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Alex Nguyen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/grid.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="alex_logo-favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="alex_logo-favicon/favicon.svg" />
    <link rel="shortcut icon" href="alex_logo-favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="alex_logo-favicon/apple-touch-icon.png" />
    <link rel="manifest" href="alex_logo-favicon/site.webmanifest" />
    
    <!-- GSAP Library -->
    <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
    
    <!-- Plyr -->
    <script defer src="https://cdn.plyr.io/3.8.3/plyr.js"></script>

    <!-- Main JavaScript -->
    <script type="module" defer src="js/home.js"></script>
</head>
<body>
    <h1 class="hidden">Welcome to Alex Nguyen's Portfolio</h1>
    <header>
    <nav class="navbar">
            <h2 class="hidden">Main Navigation</h2>
            <div class="container nav-container">
                <a href="index.php" class="logo"><img src="images/Logo.svg" alt="Alex Nguyen Logo"></a>
                <ul class="nav-links">
                    <li><a href="index.php" class="active">Home</a></li>
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
    <div id="home" class="hero-section">
        <div class="container hero-grid">
            <div class="hero-content">
                 <span class="intro-tag">Interactive Media Designer & Developer</span>
                <h2>Creative solutions where <span class="highlight-green">design</span> meets <span class="highlight-gold">technology</span>.</h2>
                <p>I build engaging digital experiences, blending clean front-end code with purposeful motion design. Currently creating in London, Ontario.</p>
                
                <div class="cta-group">
                    <a href="#projects" class="btn btn-primary">View My Work</a>
                    <a href="about.html" class="btn btn-secondary">More About Me</a>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="abstract-shape shape-green"></div>
                <div class="abstract-shape shape-gold"></div>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <span>Scroll to explore</span>
             <div class="mouse"></div>
        </div>
    </div>
    </header>

    <main>
    <section id="player-container" class="player-container--home">
        <h2><span class="highlight-green">Demo</span> Reels</h2>
        <video controls preload="metadata" poster="images/DemoReels_Poster.webp">
            <source src="video/DemoReels.webm" type="video/webm">
            <p>You are using an older browser that does not support HTML5 Video. Please update your browser.</p>
        </video>
    </section>

    <!-- Projects Section -->
    <div id="projects" class="page-header">
        <div class="container">
            <span class="intro-tag">Selected Work</span>
            <h2>Design & Development <br><span class="highlight-green">Portfolio</span></h2>
            <p class="header-desc">A collection of projects showcasing my journey in Interactive Media Design at Fanshawe College.</p>
        </div>
    </div>

    <!-- Projects I've worked on -->
    <section class="work-section">
        <div class="container">
            <h2 class="section-title animate-fade-up">Projects I've worked on</h2>
            
            <!-- Tag Filter Buttons -->
            <div class="filter-tags animate-fade-up">
                <button class="filter-btn active" data-filter="all">All</button>
                <?php foreach ($uniqueTags as $tagName) : ?>
                    <button class="filter-btn" data-filter="<?= htmlspecialchars($tagName) ?>"><?= htmlspecialchars($tagName) ?></button>
                <?php endforeach; ?>
            </div>

            <!-- 2-Column Project Grid -->
            <div class="project-grid">
                <?php foreach ($projects as $project) : ?>
                    <div class="project-card-item animate-fade-up" data-tags="<?= htmlspecialchars(implode(',', $projectTags[$project['id']] ?? [])) ?>">
                        <a href="case_study.php?slug=<?= htmlspecialchars($project['slug']) ?>" class="project-card-link">
                            <div class="project-card-image">
                                <img src="<?= htmlspecialchars($project['thumbnail_lg']) ?>"
                                    srcset="<?= htmlspecialchars($project['thumbnail_sm']) ?> 200w,
                                            <?= htmlspecialchars($project['thumbnail_md']) ?> 400w,
                                            <?= htmlspecialchars($project['thumbnail_lg']) ?> 800w"
                                    sizes="(max-width: 768px) 100vw, 50vw"
                                    alt="<?= htmlspecialchars($project['title']) ?> Thumbnail"
                                    loading="lazy">
                            </div>
                            <div class="project-card-body">
                                <div class="project-card-tags">
                                    <?php if (isset($projectTags[$project['id']])) : ?>
                                        <?php foreach ($projectTags[$project['id']] as $tagName) : ?>
                                            <span class="tag"><?= htmlspecialchars($tagName) ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <p class="project-card-desc">
                                    <strong>Note:</strong> <?= htmlspecialchars($project['short_desc']) ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
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
            <div class="quote">
                <p>"Design is not just what it looks like and feels like. Design is how it works." - Steve Jobs</p>
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
