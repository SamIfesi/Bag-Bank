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
  cardApply: {
    applyBtn: id("applyCardBtn"),
    loading: id("loadingCard"),
    msg: id("msg"),
    icon: id("icon"),
    messageText: id("messageText"),
    toggler: {
      iconEye: id("cardToggleIcon"),
      atmNumber: id("cardNumberDisplay"),
      cvv: id("cvv"),
    },
    noCardSection: id("noCardSection"),
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
      window.location.href = "views/send.php";
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
  const { iconEye, atmNumber, cvv } = element.cardApply.toggler;

  if (iconEye && atmNumber && cvv) {
    iconEye.addEventListener("click", function () {
      const cardSpan = atmNumber.querySelector("span");
      const fullCard = atmNumber.getAttribute("data-full");
      const fullCvv = cvv.getAttribute("data-full");
      const maskedCard = atmNumber.getAttribute("data-masked");
      const maskedCvv = cvv.getAttribute("data-masked");
      const isCurrentlyMasked = cardSpan.textContent.includes("*");
      const isCurrentlyMaskedCvv = cvv.textContent.includes("*");

      if (isCurrentlyMasked && isCurrentlyMaskedCvv) {
        cardSpan.textContent = fullCard;
        cvv.textContent = fullCvv;
        iconEye.classList.replace("ti-eye", "ti-eye-off");
      } else {
        cardSpan.textContent = maskedCard;
        cvv.textContent = maskedCvv;
        iconEye.classList.replace("ti-eye-off", "ti-eye");
      }

      fetch("includes/toggler.php?item=card", {
        method: "POST",
      }).catch((err) => console.error("Failed to save preference", err));
    });
  }

  // Apply for card
  const { applyBtn, loading, msg, icon, messageText, noCardSection } =
    element.cardApply;

  if (!applyBtn || !loading || !msg || !icon || !messageText) return;
  applyBtn.addEventListener("click", async () => {
    const url = "app/handlers/apply_card.php";
    noCardSection.classList.add("hide");
    loading.classList.remove("hide");
    msg.classList.remove("hidden");
    msg.style.transform = "";
    msg.style.opacity = "";

    try {
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
      });

      const data = await response.json();

      msg.classList.add("active");

      if (response.ok && data.success) {
        msg.classList.remove("error");
        msg.classList.add("success");
        icon.classList.add("ti-circle-check");
        messageText.textContent = data.message;

        setTimeout(() => {
          window.location.reload();
        }, 3000);
      } else {
        msg.classList.add("error");
        if (response.status === 400) {
          icon.classList.add("ti-alert-circle");
        } else if (response.status === 500) {
          icon.classList.add("ti-alert-circle");
        } else if (response.status === 405) {
          icon.classList.add("ti-alert-triangle");
        } else {
          icon.classList.add("ti-alert-circle");
        }
        messageText.textContent = data.message || "Failed to issue card";
        noCardSection.classList.remove("hide");
        loading.classList.add("hide");
      }
    } catch (error) {
      msg.classList.add("active", "error");
      icon.classList.add("ti-alert-octagon");
      messageText.textContent = "An error occurred. Please try again.";
      loading.classList.add("hide");
      noCardSection.classList.remove("hide");
    }
    setTimeout(() => {
      msg.classList.remove("active", "error", "success");
      msg.style.transform = "";
      msg.style.opacity = "";
      icon.className = "ti";
      messageText.textContent = "";
      msg.classList.add("hidden");
    }, 2000);
  });
};

const navLocation = () => {
  const { show, navBtn, pages } = element.card;
  const restoreSavedPage = () => {
    // Get the saved page from data attribute (set by PHP)
    const savedPage = document.body.getAttribute("data-current-page");

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
        body: JSON.stringify({ page: getPage }),
      }).catch((err) => console.error("Failed to save current page", err));

      // let count = 0;
      pages.forEach((page) => {
        const pageName = page.getAttribute("data-name");
        if (getPage === pageName) {
          page.classList.remove("hide");
        } else {
          page.classList.add("hide");
        }
      });
    });
  });
};

const drag = () => {
  const { msg } = element.cardApply;
  if (!msg) return;

  let startY = 0;
  let currentY = 0;
  let isDragging = false;

  const startDrag = (e) => {
    isDragging = true;
    startY = e.type.includes("touch") ? e.touches[0].clientY : e.clientY;
    msg.style.transition = "none";
  };

  const duringDrag = (e) => {
    if (!isDragging) return;

    currentY = e.type.includes("touch") ? e.touches[0].clientY : e.clientY;
    const deltaY = currentY - startY;

    // only allow dragging upwards (negative deltaY)
    if (deltaY < 0) {
      msg.style.transform = `translateX(-50%) translateY(${deltaY}px)`;

      // fade out slightly as user drags up
      msg.style.opacity = 1 - Math.abs(deltaY) / 100;
    }
  };

  const endDrag = () => {
    if (!isDragging) return;
    isDragging = false;

    msg.style.transition = "all 0.5s ease";
    const deltaY = currentY - startY;
    const msgHeight = msg.offsetHeight;
    const dragPercentage = Math.abs(deltaY) / msgHeight;

    // Close if dragged more than 50% or more than 50px
    if (dragPercentage >= 0.5 || deltaY < -50) {
      msg.classList.add("hidden");
      msg.style.transform = "";
      msg.style.opacity = "";
    } else {
      msg.style.transform = "translateX(-50%) translateY(0)";
      msg.style.opacity = "1";
    }
  };

  // Event Listeners
  msg.addEventListener("mousedown", startDrag);
  window.addEventListener("mousemove", duringDrag);
  window.addEventListener("mouseup", endDrag);

  msg.addEventListener("touchstart", startDrag);
  window.addEventListener("touchmove", duringDrag);
  window.addEventListener("touchend", endDrag);
};

document.addEventListener("DOMContentLoaded", () => {
  initDashboard();
  initActionButtons();
  initSidebar();
  initCardFunctionality();
  navLocation();
  drag();
});
