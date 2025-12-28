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
    navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.1)";
  } else {
    navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.05)";
  }
});

// Job filters (Careers page)
const jobFilters = qa(".job-filters .filter-btn");
const jobCards = qa(".job-card");
const noJobsMessage = document.querySelector(".no-jobs-message");

if (jobFilters.length > 0) {
  jobFilters.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Remove active class from all buttons
      jobFilters.forEach((b) => b.classList.remove("active"));
      // Add active class to clicked button
      btn.classList.add("active");

      const filter = btn.getAttribute("data-filter");
      let visibleCount = 0;

      jobCards.forEach((card) => {
        const category = card.getAttribute("data-category");
        if (filter === "all" || category === filter) {
          card.style.display = "block";
          visibleCount++;
        } else {
          card.style.display = "none";
        }
      });

      // Show/hide no jobs message
      if (noJobsMessage) {
        noJobsMessage.style.display = visibleCount === 0 ? "block" : "none";
      }
    });
  });
}

// Blog filters
const blogFilters = qa(".blog-filters .filter-btn");
const blogCards = qa(".blog-card");

if (blogFilters.length > 0) {
  blogFilters.forEach((btn) => {
    btn.addEventListener("click", () => {
      blogFilters.forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      const filter = btn.getAttribute("data-filter");

      blogCards.forEach((card) => {
        const category = card.getAttribute("data-category");
        if (filter === "all" || category === filter) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
}

// Newsletter form submission
const newsletterForm = document.querySelector(".newsletter-form");
if (newsletterForm) {
  newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = newsletterForm.querySelector("input").value;
    alert(`Thank you for subscribing with ${email}!`);
    newsletterForm.reset();
  });
}

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

// Contact Form Submission
const contactForm = id("contactForm");
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Thank you for contacting us! We'll get back to you soon.");
    contactForm.reset();
  });
}

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
