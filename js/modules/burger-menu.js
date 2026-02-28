export function burgerMenu() {
  
  
  // Mobile Navigation
  const hamburger = document.querySelector('.hamburger');
  const navLinks = document.querySelector('.nav-links');
  const navLinkItems = document.querySelectorAll('.nav-links a');

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
  // EVENT LISTENERS
  // ===========================================
  
    // Mobile navigation
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', toggleMobileMenu);
    
    navLinkItems.forEach((link) => {
      link.addEventListener('click', closeMobileMenu);
    });
  }

}