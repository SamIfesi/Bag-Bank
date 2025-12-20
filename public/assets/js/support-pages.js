const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);

// Mobile menu functionality
const mobileMenuToggle = id("mobileMenuToggle");
const mobileMenu = id("mobileMenu");
const mobileMenuClose = id("mobileMenuClose");

if (mobileMenuToggle) {
  mobileMenuToggle.addEventListener("click", () => {
    mobileMenu.classList.add("active");
  });
}

if (mobileMenuClose) {
  mobileMenuClose.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
  });
}

// Close mobile menu when clicking a link
const mobileLinks = qa(".mobile-nav-links a");
mobileLinks.forEach((link) => {
  link.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
  });
});

// Navbar scroll effect
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.style.boxShadow = "0 0. 125rem 1. 25rem rgba(0, 0, 0, 0.1)";
  } else {
    navbar.style.boxShadow = "0 0.125rem 1.25rem rgba(0, 0, 0, 0.05)";
  }
});

// FAQ Accordion
const faqQuestions = qa(".faq-question");
faqQuestions.forEach((question) => {
  question.addEventListener("click", () => {
    const faqItem = question.parentElement;
    const isActive = faqItem.classList.contains("active");

    // Close all other FAQs
    qa(".faq-item").forEach((item) => {
      item.classList.remove("active");
    });

    // Toggle current FAQ
    if (!isActive) {
      faqItem.classList.add("active");
    }
  });
});

// Contact Form Submission
const contactForm = id("contactForm");
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Thank you for contacting us! We'll get back to you soon.");
    contactForm.reset();
  });
}

// Help Search
const helpSearch = id("helpSearch");
if (helpSearch) {
  const helpSearchForm = helpSearch.closest("form");
  helpSearchForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const query = helpSearch.value;
    alert(`Searching for: ${query}`);
  });
}

// Smooth scroll
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
// Initialize functionalities
document.addEventListener("DOMContentLoaded", () => {
  // Any additional initialization can go here
});
