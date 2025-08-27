const hamburgerBtn = document.getElementById('hamburgerBtn');
const mobileMenu = document.getElementById('mobileMenu');
const hamburgerIcon = document.getElementById('hamburgerIcon');
const closeIcon = document.getElementById('closeIcon');
const mobileMenuCloseBtn = document.getElementById('mobileMenuCloseBtn');

function toggleMenu() {
  const expanded = hamburgerBtn.getAttribute('aria-expanded') === 'true';
  hamburgerBtn.setAttribute('aria-expanded', String(!expanded));
  mobileMenu.classList.toggle('hidden');
  hamburgerIcon.classList.toggle('hidden');
  closeIcon.classList.toggle('hidden');
}

hamburgerBtn.addEventListener('click', toggleMenu);
mobileMenuCloseBtn.addEventListener('click', toggleMenu);

// Add tablet/mobile class to all buttons
function updateButtonClasses() {
  const buttons = document.querySelectorAll('button');
  buttons.forEach(btn => {
    btn.classList.remove('tablet', 'mobile');
  });
  const width = window.innerWidth;
  if (width <= 768 && width > 480) {
    buttons.forEach(btn => btn.classList.add('tablet'));
  } else if (width <= 480) {
    buttons.forEach(btn => btn.classList.add('mobile'));
  }
}
window.addEventListener('resize', updateButtonClasses);
window.addEventListener('load', updateButtonClasses);