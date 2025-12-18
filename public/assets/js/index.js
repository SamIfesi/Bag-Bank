const id = (id) => document.getElementById(id);

const elements = {
  mobileMenuToggle: id("mobileMenuToggle"),
  mobileMenu: id("mobileMenu"),
  mobileMenuClose: id("mobileMenuClose"),
};

// Mobile menu toggle
if (elements.mobileMenuToggle) {
  elements.mobileMenuToggle.addEventListener("click", () => {
    elements.mobileMenu.classList.add("active");
  });
}

if (elements.mobileMenuClose) {
  elements.mobileMenuClose.addEventListener("click", () => {
    elements.mobileMenu.classList.remove("active");
  });
}

// Close mobile menu when clicking a link
const mobileLinks = document.querySelectorAll(".mobile-nav-links a");
mobileLinks.forEach((link) => {
  link.addEventListener("click", () => {
    elements.mobileMenu.classList.remove("active");
  });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Navbar background on scroll
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.1)";
  } else {
    navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.05)";
  }
});
