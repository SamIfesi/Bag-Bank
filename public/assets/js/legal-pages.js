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
  if (navbar) {
    if (window.scrollY > 50) {
      navbar.style.boxShadow = "0 0.125rem 1.25rem rgba(0, 0, 0, 0.1)";
    } else {
      navbar.style.boxShadow = "0 0.125rem 1.25rem rgba(0, 0, 0, 0.05)";
    }
  }
});

// Smooth scroll for TOC links
const tocLinks = qa('.toc-list a, .sidebar-links a[href^="#"]');
tocLinks.forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const targetId = this.getAttribute("href");
    const targetElement = document.querySelector(targetId);

    if (targetElement) {
      const offset = 8 * 16; // 8rem in pixels (navbar + toc height)
      const elementPosition = targetElement.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - offset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });

      // Update active link
      tocLinks.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  });
});

// Highlight active section in TOC on scroll
let sections = qa(".legal-section");
let tocLinksArray = Array.from(qa(".toc-list a"));

function highlightTOC() {
  let scrollPosition = window.scrollY + 200;

  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.offsetHeight;
    const sectionId = section.getAttribute("id");

    if (
      scrollPosition >= sectionTop &&
      scrollPosition < sectionTop + sectionHeight
    ) {
      tocLinksArray.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${sectionId}`) {
          link.classList.add("active");
        }
      });
    }
  });
}

window.addEventListener("scroll", highlightTOC);

// Download PDF functionality (placeholder)
const downloadBtns = qa(".download-btn");
downloadBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    alert(
      "PDF download functionality will be implemented.  For now, you can print this page (Ctrl+P) and save as PDF."
    );
    // In production, this would trigger actual PDF generation
    // window.print();
  });
});

// Copy section link to clipboard
const sectionHeaders = qa(".legal-section h2, .legal-section h3");
sectionHeaders.forEach((header) => {
  header.style.cursor = "pointer";
  header.title = "Click to copy link to this section";

  header.addEventListener("click", () => {
    const sectionId = header.closest(".legal-section").getAttribute("id");
    if (sectionId) {
      const url = `${window.location.origin}${window.location.pathname}#${sectionId}`;

      // Copy to clipboard
      navigator.clipboard
        .writeText(url)
        .then(() => {
          // Show success feedback
          const originalText = header.textContent;
          header.textContent = "✓ Link copied! ";
          header.style.color = "#2e7d32";

          setTimeout(() => {
            header.textContent = originalText;
            header.style.color = "";
          }, 2000);
        })
        .catch((err) => {
          console.error("Failed to copy: ", err);
        });
    }
  });
});

// Back to top button
const createBackToTop = () => {
  const backToTop = document.createElement("button");
  backToTop.innerHTML = '<i class="ti ti-arrow-up"></i>';
  backToTop.id = "back-to-top";
  backToTop.style.cssText = `
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 3.5rem;
    height: 3.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #5200a3 0%, #6c5ce7 100%);
    color: white;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 0.25rem 0.75rem rgba(82, 0, 163, 0.3);
    z-index: 1000;
  `;

  document.body.appendChild(backToTop);

  window.addEventListener("scroll", () => {
    if (window.scrollY > 500) {
      backToTop.style.opacity = "1";
      backToTop.style.visibility = "visible";
    } else {
      backToTop.style.opacity = "0";
      backToTop.style.visibility = "hidden";
    }
  });

  backToTop.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  backToTop.addEventListener("mouseenter", () => {
    backToTop.style.transform = "translateY(-0.25rem)";
    backToTop.style.boxShadow = "0 0.375rem 1rem rgba(82, 0, 163, 0.4)";
  });

  backToTop.addEventListener("mouseleave", () => {
    backToTop.style.transform = "translateY(0)";
    backToTop.style.boxShadow = "0 0.25rem 0.75rem rgba(82, 0, 163, 0.3)";
  });
};

// Initialize back to top button
createBackToTop();

// Print page functionality
const addPrintListener = () => {
  window.addEventListener("beforeprint", () => {
    console.log("Printing legal document...");
  });

  window.addEventListener("afterprint", () => {
    console.log("Print completed");
  });
};

addPrintListener();

// Smooth scroll for all anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
    if (href !== "#") {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        const offset = 8 * 16; // 8rem
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth",
        });
      }
    }
  });
});