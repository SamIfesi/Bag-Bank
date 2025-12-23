const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);
const q = (s) => document.querySelector(s);
const element = {
  btns: {
    send: id("sendBtn"),
  },
  loader: id("loader"),

  toggles: {
    bal: id("balShow"),
  },
  balance: {
    bal: id("bal"),
    amountText: id("amount-text"),
    balIcon: id("balIcon"),
  },
  account: {
    accBtn: id("acctToggleBtn"),
    accNum: id("acctText"),
  },
  card: {
    show: id("show-card"),
    navBtn: qa(".bottom-nav .nav-item"),
    pages: qa(".nav-section"),
  },
};

// Initialize all functionalities on DashBoard
const initDashboard = () => {
  // Balance Toggle
  const toggleBalance = () => {
    let toggleBtn = element.balance.balIcon;
    let balContainer = element.balance.bal;
    let amountText = element.balance.amountText;

    if (!toggleBtn || !balContainer || !amountText) return;
    toggleBtn.addEventListener("click", function () {
      const isCurrentlyHidden = amountText.textContent === "****";
      const realAmount = balContainer.getAttribute("data-amount");

      if (isCurrentlyHidden) {
        amountText.textContent = realAmount;
        balIcon.classList.remove("ti-eye");
        balIcon.classList.add("ti-eye-off");
      } else {
        amountText.textContent = "****";
        balIcon.classList.remove("ti-eye-off");
        balIcon.classList.add("ti-eye");
      }

      fetch("includes/toggler.php?item=balance", {
        method: "POST",
      }).catch((err) => console.error("Failed to save preference", err));
    });
  };
  toggleBalance();

  // Account Number Toggle
  const toggleAccountNumber = () => {
    let toggleBtn = element.account.accBtn;
    let accNum = element.account.accNum;
    if (!toggleBtn || !accNum) return;
    toggleBtn.addEventListener("click", () => {
      const fullNum = toggleBtn.getAttribute("data-full");
      const maskedNum = toggleBtn.getAttribute("data-masked");

      const currentText = accNum.textContent.trim();
      if (currentText === maskedNum) {
        accNum.textContent = fullNum;
      } else {
        accNum.textContent = maskedNum;
      }

      fetch("includes/toggler.php?item=account_number", {
        method: "POST",
      }).catch((err) => {
        console.error("Failed to save acct state", err);
      });
    });
  };
  toggleAccountNumber();
};

// action buttons for reloctions
const initActionButtons = () => {
  const send = element.btns?.send;
  if (send) {
    send.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "send.php";
    });
  }
};

// Sidebar collapse toggle
const initSidebar = () => {
  const sidebar = document.getElementById("sidebar");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const icon = document.getElementById("collapse-icon");
  const homeBody = document.querySelector(".home-body");

  if (!sidebar || !sidebarToggle) return;

  // Load saved state from localStorage
  const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
  if (isCollapsed) {
    sidebar.classList.add("collapsed");
    icon.classList.replace(
      "ti-layout-sidebar-left-collapse",
      "ti-layout-sidebar-right-collapse"
    );
    if (homeBody) homeBody.classList.add("sidebar-collapsed");
  }

  sidebarToggle.addEventListener("click", (e) => {
    e.preventDefault();
    const collapsed = sidebar.classList.toggle("collapsed");

    // Toggle icon classes
    if (collapsed) {
      icon.classList.replace(
        "ti-layout-sidebar-left-collapse",
        "ti-layout-sidebar-right-collapse"
      );
    } else {
      icon.classList.replace(
        "ti-layout-sidebar-right-collapse",
        "ti-layout-sidebar-left-collapse"
      );
    }

    if (homeBody) {
      homeBody.classList.toggle("sidebar-collapsed");
    }

    // Save state to localStorage
    localStorage.setItem("sidebarCollapsed", collapsed.toString());
  });
};

// ATM Card functionality
const initCardFunctionality = () => {
  // Card number toggle
  const cardToggleIcon = id("cardToggleIcon");
  const cardNumberDisplay = id("cardNumberDisplay");

  if (cardToggleIcon && cardNumberDisplay) {
    cardToggleIcon.addEventListener("click", function () {
      const cardSpan = cardNumberDisplay.querySelector("span");
      const fullCard = cardNumberDisplay.getAttribute("data-full");
      const maskedCard = cardNumberDisplay.getAttribute("data-masked");
      const isCurrentlyMasked = cardSpan.textContent.includes("*");

      if (isCurrentlyMasked) {
        cardSpan.textContent = fullCard;
        cardToggleIcon.classList.remove("ti-eye");
        cardToggleIcon.classList.add("ti-eye-off");
      } else {
        cardSpan.textContent = maskedCard;
        cardToggleIcon.classList.remove("ti-eye-off");
        cardToggleIcon.classList.add("ti-eye");
      }

      fetch("includes/toggler.php?item=card", {
        method: "POST",
      }).catch((err) => console.error("Failed to save preference", err));
    });
  }

  // Apply for card
  const applyCardBtn = id("applyCardBtn");
  const loadingCard = id("loadingCard");

  if (applyCardBtn) {
    applyCardBtn.addEventListener("click", async function () {
      const noCardSection = q(".no-card-section");

      // Show loading state
      if (noCardSection && loadingCard) {
        noCardSection.style.display = "none";
        loadingCard.style.display = "block";
      }

      try {
        const response = await fetch("app/handlers/apply_card.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
        });

        const data = await response.json();

        if (data.success) {
          // Show success message
          alert("🎉 " + data.message + "\n\nReloading page...");
          // Reload page to show the card
          window.location.reload();
        } else {
          // Show error message
          alert("❌ " + data.message);
          // Show apply button again
          if (noCardSection && loadingCard) {
            noCardSection.style.display = "block";
            loadingCard.style.display = "none";
          }
        }
      } catch (error) {
        console.error("Error applying for card:", error);
        alert("❌ An error occurred. Please try again.");
        // Show apply button again
        if (noCardSection && loadingCard) {
          noCardSection.style.display = "block";
          loadingCard.style.display = "none";
        }
      }
    });
  }
};

const navLocation = () => {
  const { show, navBtn, pages } = element.card;
  
  // Restore the saved page on page load
  const restoreSavedPage = () => {
    // Get the saved page from data attribute (set by PHP)
    const savedPage = document.body.getAttribute('data-current-page');
    
    if (savedPage && navBtn.length > 0) {
      navBtn.forEach((btn) => {
        const btnPage = btn.getAttribute("data-page");
        if (btnPage === savedPage) {
          btn.classList.add("active");
        } else {
          btn.classList.remove("active");
        }
      });

      pages.forEach((page) => {
        const pageName = page.getAttribute("data-name");
        if (pageName === savedPage) {
          page.classList.remove("hide");
        } else {
          page.classList.add("hide");
        }
      });
    }
  };

  // Call restore on load
  restoreSavedPage();
  
  navBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      navBtn.forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      const getPage = btn.getAttribute("data-page");
      
      // Save current page to session
      fetch("includes/toggler.php?item=page", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ page: getPage })
      }).catch((err) => console.error("Failed to save current page", err));
      
      // let count = 0;
      pages.forEach((page) => {
        const pageName = page.getAttribute("data-name");
        if (getPage === pageName) {
          page.classList.remove("hide");
        } else {
          page.classList.add("hide");
        }
      })
    })
  });
};

document.addEventListener("DOMContentLoaded", () => {
  initDashboard();
  initActionButtons();
  initSidebar();
  initCardFunctionality();
  navLocation()
});
