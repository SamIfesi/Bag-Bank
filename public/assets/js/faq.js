document.addEventListener("DOMContentLoaded", () => {
  // --- Accordion Logic ---
  const accordions = document.querySelectorAll(".accordion-item");

  accordions.forEach((item) => {
    const header = item.querySelector(".accordion-header");

    header.addEventListener("click", () => {
      // Check if this item is already open
      const isOpen = item.classList.contains("active");

      // Close all other items first (optional: simpler UX)
      accordions.forEach((otherItem) => {
        otherItem.classList.remove("active");
        otherItem.querySelector(".accordion-body").style.maxHeight = null;
      });

      // Toggle current item
      if (!isOpen) {
        item.classList.add("active");
        const body = item.querySelector(".accordion-body");
        body.style.maxHeight = body.scrollHeight + "px"; // Smooth height transition
      }
    });
  });

  // --- Search Logic ---
  const searchInput = document.getElementById("faqSearch");
  const faqItems = document.querySelectorAll(".accordion-item");
  const categories = document.querySelectorAll(".faq-category");

  searchInput.addEventListener("input", (e) => {
    const term = e.target.value.toLowerCase();

    faqItems.forEach((item) => {
      const question = item.querySelector("span").textContent.toLowerCase();
      const answer = item.querySelector("p").textContent.toLowerCase();

      if (question.includes(term) || answer.includes(term)) {
        item.style.display = "block";

        // Highlight logic (Optional: Open it if it's a direct match)
        if (term.length > 3 && question.includes(term)) {
          // Automatically open matches? (Can be annoying, maybe skip)
        }
      } else {
        item.style.display = "none";
      }
    });

    // Hide empty categories
    categories.forEach((cat) => {
      const visibleItems = cat.querySelectorAll(
        ".accordion-item[style='display: block']"
      );
      // Note: By default display is not set inline style, so we check offsetParent
      const hasVisible = Array.from(
        cat.querySelectorAll(".accordion-item")
      ).some((el) => el.style.display !== "none");

      cat.style.display = hasVisible ? "block" : "none";
    });
  });
});
