<!DOCTYPE html>
<html lang="en">
<?php
//Error reporting, turn off when we launch
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me | Alex Nguyen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <h1 class="hidden">Welcome to Alex Nguyen's Portfolio</h1>
    <header>
        <nav class="navbar">
            <h2 class="hidden">Main Navigation</h2>
            <div class="container nav-container">
                <a href="index.html" class="logo"><img src="images/Logo.svg" alt="Alex Nguyen Logo"></a>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Me</a></li>
                    <li><a href="contact.html" class="btn-nav active-btn">Contact</a></li>
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
    <section class="contact-section">
        <div class="container">
            
            <!-- Contact Header - Centered -->
            <div class="contact-header animate-fade-up">
                <span class="intro-tag">Get in Touch</span>
                <h2>Let's start a <span class="highlight-green">conversation</span>.</h2>
                <p>I'm currently looking for <strong>Spring 2026 Co-op opportunities</strong> in London, Ontario. Whether you have a question about my work or just want to say hi, I'd love to hear from you.</p>
                <p>I'm also looking to connect with new friends who share my hobbies—movies, anime/manga, games (I love FPS games!), etc. Don't hesitate to reach out for a guaranteed (or not) fun time :D</p>
            </div>

            <!-- Contact Info Icons - Horizontal Row -->
            <div class="contact-icons animate-fade-up">
                <a href="https://maps.google.com/?q=London,Ontario" target="_blank" class="contact-icon-item">
                    <div class="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <span>London, Ontario</span>
                </a>

                <a href="npanh1903@gmail.com" class="contact-icon-item">
                    <div class="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <span>npanh1903@gmail.com</span>
                </a>

                <a href="https://www.linkedin.com/in/anh-nguyen-53280b266/" target="_blank" class="contact-icon-item">
                    <div class="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                    </div>
                    <span>Alex Nguyen</span>
                </a>
            </div>

            <!-- Contact Form -->
             <p>
                <?php
                    if(isset($_GET['msg'])) {
                        echo htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8');
                    }
                ?>
            </p>
            <div class="form-container animate-fade-up">
                <form method="post" action="includes/send.php" class="contact-form">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Your First and Last Name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Tell me about your ideas, your hopes and dreams, your fav game/steamid/discord..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
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
                <a href="https://github.com/yourusername" target="_blank" class="social-icon" aria-label="GitHub">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg" alt="Github Icon">
                </a>
            </div>
            <div class="footer-logo">
                <a href="index.html"><img src="images/Logo.svg" alt="Alex Nguyen Logo"></a>
            </div>
        </div>
        <div class="container">
            <p class="copyright">Alex Nguyen © 2025. Built with code & raw determination (coffee)</p>
        </div>
    </footer>

    <!-- GSAP Library -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
    
    <!-- Main JavaScript -->
    <script src="js/main.js"></script>
</body>
</html>