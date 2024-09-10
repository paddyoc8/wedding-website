document.addEventListener('DOMContentLoaded', () => {
    const toggleMenu = document.querySelector('.menu-toggle');
    const nav = document.querySelector('nav');
  
    toggleMenu.addEventListener('click', () => {
      nav.classList.toggle('active');
    });
  });
  