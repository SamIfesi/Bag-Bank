function filterTransactions(filterType) {
  const transactionsList = document.getElementById("transactionsList");
  if (!transactionsList) return;
  
  const items = transactionsList.querySelectorAll(".trans-item");
  const emptyState = document.getElementById("emptyTrans");
  let visibleCount = 0;

  items.forEach((item) => {
    const type = item.getAttribute("data-type");
    let shouldShow = false;

    if (filterType === "all") {
      shouldShow = true;
    } else if (filterType === "credit" && type === "credit") {
      shouldShow = true;
    } else if (filterType === "debit" && type === "debit") {
      shouldShow = true;
    } else if (filterType === "top_up" && type === "top_up") {
      shouldShow = true;
    }

    if (shouldShow) {
      item.style.display = "flex";
      visibleCount++;
    } else {
      item.style.display = "none";
    }
  });

  if (visibleCount === 0) {
    emptyState.style.display = "block";
  } else {
    emptyState.style.display = "none";
  }

  updateFilterUI(filterType);
}

function updateFilterUI(filterType) {
  // Update desktop buttons
  const desktopButtons = document.querySelectorAll(".filter-btn");
  const noTransactionBtn = document.getElementById("noTransaction");

  desktopButtons.forEach((btn) => {
    btn.classList.remove("active");
    if (btn.getAttribute("data-filter") === filterType) {
      btn.classList.add("active");
    }
  });

  // Only update button text if the button exists
  if (noTransactionBtn) {
    if (filterType === "top_up") {
      noTransactionBtn.textContent = "add money";
      noTransactionBtn.addEventListener("click", () => {
        window.location.href = "add_money.php";
      });
    } else {
      noTransactionBtn.textContent = "Send Money";
      noTransactionBtn.addEventListener("click", () => {
        window.location.href = "send.php";
      });
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  filterTransactions("all");
});
