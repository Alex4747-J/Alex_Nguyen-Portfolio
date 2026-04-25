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

// Fetch the current project by slug
$currentProject = $db->query("SELECT * FROM projects WHERE slug = :slug", ['slug' => $slug]);

// If no project found, show a 404 message
if (empty($currentProject)) {
    echo '<h1>Project not found</h1>';
    echo '<p><a href="index.php">Go back home</a></p>';
    exit;
}

$project = $currentProject[0];

// Fetch related data for this project
$projectTagsList = $db->query("SELECT * FROM project_tags WHERE project_id = :id ORDER BY id ASC", ['id' => $project['id']]);
$tools = $db->query("SELECT tools.name, tools.icon_url FROM project_tools JOIN tools ON project_tools.tool_id = tools.id WHERE project_tools.project_id = :id ORDER BY project_tools.id ASC", ['id' => $project['id']]);
$gallery = $db->query("SELECT * FROM project_gallery WHERE project_id = :id ORDER BY id ASC", ['id' => $project['id']]);

// Split gallery into sets for interleaving
// Set 1: first 2 images (before Problem)
// Set 2: next 2 images (before Research) 
// Set 3: remaining images (before Solution)
$gallerySet1 = array_slice($gallery, 0, 2);
$gallerySet2 = array_slice($gallery, 2, 2);
$gallerySet3 = array_slice($gallery, 4);

function getYouTubeEmbedId(string $url): ?string
{
    $trimmedUrl = trim($url);

    if ($trimmedUrl === '') {
        return null;
    }

    // Accept full iframe embed code pasted from YouTube by extracting its src URL first.
    if (preg_match('~src=["\']([^"\']+)["\']~i', $trimmedUrl, $iframeMatches)) {
        $trimmedUrl = $iframeMatches[1];
    }

    // Accept raw YouTube IDs as well as common YouTube URL formats.
    if (preg_match('~^[A-Za-z0-9_-]{11}$~', $trimmedUrl)) {
        return $trimmedUrl;
    }

    if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/|youtube\.com/shorts/)([^&?/]+)~i', $trimmedUrl, $matches)) {
        return $matches[1];
    }

    $parts = parse_url($trimmedUrl);
    if (!is_array($parts)) {
        return null;
    }

    if (($parts['host'] ?? '') && str_contains($parts['host'], 'youtube.com') && !empty($parts['query'])) {
        parse_str($parts['query'], $query);
        return $query['v'] ?? null;
    }

    return null;
}

$videoSrc = trim((string) ($project['video_src'] ?? ''));
$youtubeEmbedId = getYouTubeEmbedId($videoSrc);
$youtubeEmbedUrl = $youtubeEmbedId ? 'https://www.youtube.com/embed/' . rawurlencode($youtubeEmbedId) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($project['title']) ?> | Projects</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/grid.css">
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
    <h1 class="hidden"><?= htmlspecialchars($project['title']) ?> - Alex Nguyen's Portfolio</h1>
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
    <!-- Hero Image -->
    <section class="case-hero">
        <div class="case-hero-image">
            <img src="<?= htmlspecialchars($project['thumbnail_lg']) ?>"
                 srcset="<?= htmlspecialchars($project['thumbnail_sm']) ?> 400w,
                         <?= htmlspecialchars($project['thumbnail_md']) ?> 800w,
                         <?= htmlspecialchars($project['thumbnail_lg']) ?> 1200w"
                 sizes="100vw"
                 alt="<?= htmlspecialchars($project['title']) ?> Hero Image">
        </div>
    </section>

    <!-- Project Intro -->
    <section class="project-intro">
        <div class="grid-con">
            <div class="col-span-full grid-con">
                <h2 class="animate-fade-up col-span-full"><?= htmlspecialchars($project['title']) ?></h2>
                <p class="featured col-span-full"><?= htmlspecialchars($project['featured_label']) ?></p>
            </div>

            <div class="col-span-full grid-con">
                <h3 class="animate-fade-up m-col-start-1 m-col-span-2">Description</h3>
                <p class="project-description animate-fade-up col-span-full m-col-start-4 m-col-span-8">
                    <?= htmlspecialchars($project['description']) ?>
                </p>
            </div>
            <div class="col-span-full m-col-start-1 m-col-span-5">
                <h3 class="animate-fade-up">Role</h3>
                <p class="project-description animate-fade-up">
                    <?= htmlspecialchars($project['role']) ?>
                </p>
            </div>
            <div class="col-span-full m-col-start-6">
                <h3 class="animate-fade-up">Deliverables</h3>
                <p class="project-description animate-fade-up">
                    <?= htmlspecialchars($project['deliverables']) ?>
                </p>
            </div>
        </div>
        
    </section>

    <!-- Video Section -->
    <?php if ($youtubeEmbedId !== null) : ?>
    <section id="player-container" class="player-container--case-study">
        <h2><?= htmlspecialchars($project['video_title']) ?></h2>
        <div class="youtube-player-frame" style="position: relative; width: 100%; padding-top: 56.25%; border-radius: 16px; overflow: hidden;">
            <iframe
                src="<?= htmlspecialchars($youtubeEmbedUrl) ?>"
                title="<?= htmlspecialchars($project['video_title'] ?: $project['title']) ?>"
                class="youtube-player-frame__iframe"
                width="100%"
                height="100%"
                style="position: absolute; inset: 0; display: block; width: 100%; height: 100%; border: 0;"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen>
            </iframe>
        </div>
    </section>
    <?php endif; ?>

    <!-- Gallery Title -->
    <section class="project-gallery">
        <div class="container">
            <h3 class="section-title animate-fade-up"><?= htmlspecialchars($project['gallery_title']) ?></h3>
            <p class="section-subtitle animate-fade-up"><?= htmlspecialchars($project['gallery_subtitle']) ?></p>
        </div>
    </section>

    <!-- Case Study with Interleaved Gallery -->
    <section class="project-case-study">
        <div class="container">
            <div class="case-study-content">

                <!-- Gallery Set 1: 2 images side by side -->
                <?php if (!empty($gallerySet1)) : ?>
                <div class="gallery-grid animate-fade-up">
                    <?php foreach ($gallerySet1 as $image) : ?>
                    <div class="gallery-item">
                        <img src="<?= htmlspecialchars($image['image_lg']) ?>"
                             srcset="<?= htmlspecialchars($image['image_sm']) ?> 150w,
                                     <?= htmlspecialchars($image['image_md']) ?> 300w,
                                     <?= htmlspecialchars($image['image_lg']) ?> 600w"
                             sizes="(max-width: 768px) 100vw, 45vw"
                             alt="<?= htmlspecialchars($image['alt_text']) ?>"
                             loading="lazy">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Problem Statement -->
                <div class="case-study-item animate-fade-up">
                    <h4>Problem Statement</h4>
                    <p><?= htmlspecialchars($project['problem']) ?></p>
                </div>

                <!-- Gallery Set 2: 2 images side by side -->
                <?php if (!empty($gallerySet2)) : ?>
                <div class="gallery-grid animate-fade-up">
                    <?php foreach ($gallerySet2 as $image) : ?>
                    <div class="gallery-item">
                        <img src="<?= htmlspecialchars($image['image_lg']) ?>"
                             srcset="<?= htmlspecialchars($image['image_sm']) ?> 150w,
                                     <?= htmlspecialchars($image['image_md']) ?> 300w,
                                     <?= htmlspecialchars($image['image_lg']) ?> 600w"
                             sizes="(max-width: 768px) 100vw, 45vw"
                             alt="<?= htmlspecialchars($image['alt_text']) ?>"
                             loading="lazy">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Research and Findings -->
                <div class="case-study-item animate-fade-up">
                    <h4>Research and Findings</h4>
                    <p><?= htmlspecialchars($project['research']) ?></p>
                </div>

                <!-- Gallery Set 3: remaining images (full width) -->
                <?php if (!empty($gallerySet3)) : ?>
                <div class="gallery-grid gallery-grid-single animate-fade-up">
                    <?php foreach ($gallerySet3 as $image) : ?>
                    <div class="gallery-item">
                        <img src="<?= htmlspecialchars($image['image_lg']) ?>"
                             srcset="<?= htmlspecialchars($image['image_sm']) ?> 150w,
                                     <?= htmlspecialchars($image['image_md']) ?> 300w,
                                     <?= htmlspecialchars($image['image_lg']) ?> 600w"
                             sizes="100vw"
                             alt="<?= htmlspecialchars($image['alt_text']) ?>"
                             loading="lazy">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

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

    <!-- Other projects -->
    <section class="work-section">
        <div class="container">
            <h2 class="section-title animate-fade-up">Other Projects</h2>

            <!-- Project Grid -->
            <div class="project-grid-case-study">
                <?php foreach ($projects as $otherProject) : ?>
                <?php if ($otherProject['slug'] === $slug) continue; ?>
                <div class="project-card-item-case-study animate-fade-up" data-tags="<?= htmlspecialchars(implode(',', $projectTags[$otherProject['id']] ?? [])) ?>">
                    <a href="case_study.php?slug=<?= htmlspecialchars($otherProject['slug']) ?>" class="project-card-link">
                        <div class="project-card-image">
                            <img src="<?= htmlspecialchars($otherProject['thumbnail_lg']) ?>"
                                srcset="<?= htmlspecialchars($otherProject['thumbnail_sm']) ?> 200w,
                                        <?= htmlspecialchars($otherProject['thumbnail_md']) ?> 400w,
                                        <?= htmlspecialchars($otherProject['thumbnail_lg']) ?> 800w"
                                sizes="(max-width: 768px) 100vw, 50vw"
                                alt="<?= htmlspecialchars($otherProject['title']) ?> Thumbnail"
                                loading="lazy">
                        </div>
                        <div class="project-card-body">
                            <div class="project-card-tags">
                                <?php if (isset($projectTags[$otherProject['id']])) : ?>
                                    <?php foreach ($projectTags[$otherProject['id']] as $tagName) : ?>
                                        <span class="tag"><?= htmlspecialchars($tagName) ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <p class="project-card-desc">
                                <strong>Note:</strong> <?= htmlspecialchars($otherProject['short_desc']) ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>

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
