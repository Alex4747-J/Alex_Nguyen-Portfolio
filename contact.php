<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me | Alex Nguyen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
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

    <!-- Main JavaScript -->
    <script type="module" defer src="js/contact.js"></script>
</head>
<body>
    <h1 class="hidden">Welcome to Alex Nguyen's Portfolio</h1>
    <header>
        <nav class="navbar">
            <h2 class="hidden">Main Navigation</h2>
            <div class="container nav-container">
                <a href="index.php" class="logo"><img src="images/Logo.svg" alt="Alex Nguyen Logo"></a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About Me</a></li>
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
                <p>I'm currently looking for <strong>Work Opportunities in Front-end Dev and UX/Graphic Design</strong> in London, Ontario (willing to change location if we're besties). Whether you have a question about my work or just want to say hi, I'd love to hear from you.</p>
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
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/linkedin/linkedin-original.svg">
                    </div>
                    <span>Alex Nguyen</span>
                </a>
            </div>

            <!-- Contact Form -->
            <div class="form-container animate-fade-up">
                <form method="post" action="includes/adduser.php" class="contact-form">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">*Name</label>
                            <input type="text" id="name" name="name" placeholder="Your First and Last Name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">*Email Address</label>
                            <input type="text" id="email" name="email" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">*Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Tell me about your ideas, your hopes and dreams, your fav game/steamid/discord..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                    
                    <section id="feedback"><p>*Please fill out all required sections</p></section>
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