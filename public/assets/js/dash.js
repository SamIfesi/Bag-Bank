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
  const homeBody = document.querySelector(".home-body");

  if (!sidebar || !sidebarToggle) {
    console.log("Sidebar elements not found");
    return;
  }

  console.log("Sidebar initialized");

  // Load saved state from localStorage
  const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
  if (isCollapsed) {
    sidebar.classList.add("collapsed");
    if (homeBody) homeBody.classList.add("sidebar-collapsed");
  }

  sidebarToggle.addEventListener("click", (e) => {
    e.preventDefault();
    const collapsed = sidebar.classList.toggle("collapsed");

    if (homeBody) {
      homeBody.classList.toggle("sidebar-collapsed");
    }

    // Save state to localStorage
    // localStorage.setItem("sidebarCollapsed", collapsed.toString());
    console.log("Sidebar toggled:", collapsed);
  });
};

document.addEventListener("DOMContentLoaded", () => {
  initDashboard();
  initActionButtons();
  initSidebar();
});

console.log("hello");
