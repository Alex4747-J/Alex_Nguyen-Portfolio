(() => {
  // Mobile Navigation
  const hamburger = document.querySelector('.hamburger');
  const navLinks = document.querySelector('.nav-links');
  const navLinkItems = document.querySelectorAll('.nav-links a');
  
  // Smooth Scroll Links
  const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
  
  // Animation Elements (Class-based)
  const fadeUpElements = document.querySelectorAll('.animate-fade-up');
  const fadeInElements = document.querySelectorAll('.animate-fade-in');
  const scaleUpElements = document.querySelectorAll('.animate-scale-up');
  const slideLeftElements = document.querySelectorAll('.animate-slide-left');
  const slideRightElements = document.querySelectorAll('.animate-slide-right');
  
  // Scroll Button
  const scrollButton = document.createElement('button');
  scrollButton.className = 'scroll-to-top';
  scrollButton.setAttribute('aria-label', 'Scroll to top');
  document.body.appendChild(scrollButton);

  // Video Player
  const videoPlayer = document.querySelector('#player-container video');

  // ===========================================
  // PLYR VIDEO PLAYER
  // ===========================================

  function initVideoPlayer() {
    if (videoPlayer && typeof Plyr !== 'undefined') {
      const player = new Plyr(videoPlayer, {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen']
      });
    }
  }

  // ===========================================
  // MOBILE NAVIGATION FUNCTIONS
  // ===========================================
  
  function toggleMobileMenu() {
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('active');
  }

  function closeMobileMenu() {
    hamburger.classList.remove('active');
    navLinks.classList.remove('active');
  }

  // ===========================================
  // SCROLL TO TOP BUTTON FUNCTIONS
  // ===========================================

  function toggleScrollButtonVisibility() {
    const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollPosition > 300) {
      scrollButton.classList.add('show');
    } else {
      scrollButton.classList.remove('show');
    }
  }

  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

  // ===========================================
  // SMOOTH SCROLL FUNCTION
  // ===========================================
  
  function handleSmoothScroll(event) {
    const targetHash = event.currentTarget.hash;
    
    if (targetHash && typeof gsap !== 'undefined' && typeof ScrollToPlugin !== 'undefined') {
      event.preventDefault();
      gsap.to(window, {
        duration: 1,
        scrollTo: { y: targetHash, offsetY: 100 },
        ease: 'power2.out'
      });
    }
  }

  // ===========================================
  // GSAP SETUP
  // ===========================================
  
  function setupGSAP() {
    if (typeof gsap === 'undefined') {
      return;
    }

    if (typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }

    if (typeof ScrollToPlugin !== 'undefined') {
      gsap.registerPlugin(ScrollToPlugin);
    }
  }

  // ===========================================
  // REUSABLE ANIMATION FUNCTIONS (Class-based)
  // ===========================================

  function animateFadeUp() {
    if (typeof gsap === 'undefined') {
      return;
    }

    fadeUpElements.forEach((element, index) => {
      gsap.from(element, {
        opacity: 0,
        y: 40,
        duration: 0.8,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none reverse'
        }
      });
    });
  }

  function animateFadeIn() {
    if (typeof gsap === 'undefined') {
      return;
    }

    fadeInElements.forEach((element) => {
      gsap.from(element, {
        opacity: 0,
        duration: 1,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none reverse'
        }
      });
    });
  }

  function animateScaleUp() {
    if (typeof gsap === 'undefined') {
      return;
    }

    scaleUpElements.forEach((element) => {
      gsap.from(element, {
        opacity: 0,
        scale: 0.9,
        duration: 0.8,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none reverse'
        }
      });
    });
  }

  function animateSlideLeft() {
    if (typeof gsap === 'undefined') {
      return;
    }

    slideLeftElements.forEach((element) => {
      gsap.from(element, {
        opacity: 0,
        x: -50,
        duration: 0.8,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none reverse'
        }
      });
    });
  }

  function animateSlideRight() {
    if (typeof gsap === 'undefined') {
      return;
    }

    slideRightElements.forEach((element) => {
      gsap.from(element, {
        opacity: 0,
        x: 50,
        duration: 0.8,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none reverse'
        }
      });
    });
  }

  // ===========================================
  // EVENT LISTENERS
  // ===========================================
  
  // Video Player
  initVideoPlayer();

  // Mobile navigation
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', toggleMobileMenu);
    
    navLinkItems.forEach((link) => {
      link.addEventListener('click', closeMobileMenu);
    });
  }

  // Scroll to top button
  window.addEventListener('scroll', toggleScrollButtonVisibility);
  scrollButton.addEventListener('click', scrollToTop);

  // Smooth scroll navigation
  smoothScrollLinks.forEach((link) => {
    link.addEventListener('click', handleSmoothScroll);
  });

  // GSAP animations
  setupGSAP();
  
  setTimeout(() => {
    animateFadeUp();
    animateFadeIn();
    animateScaleUp();
    animateSlideLeft();
    animateSlideRight();
  }, 100);

})();