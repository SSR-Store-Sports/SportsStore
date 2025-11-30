const lenis = new Lenis();

function raf(time) {
  lenis.raf(time);
  requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

// Prevenir Lenis na sidebar
document.addEventListener('wheel', (e) => {
  if (e.target.closest('.sidebar')) {
    e.stopPropagation();
  }
}, { passive: false });