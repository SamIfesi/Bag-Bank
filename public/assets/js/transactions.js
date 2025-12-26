function filterTransactions(filterType) {
  const transactionsList = document.getElementById("transactionsList");
  const items = transactionsList.querySelectorAll(".trans-item");
  const emptyState = document.getElementById("emptyState");
  let visibleCount = 0;

  items.forEach((item) => {
    const type = item.getAttribute("data-type");
    const description = item.getAttribute("data-description");
    let shouldShow = false;

    if (filterType === "all") {
      shouldShow = true;
    } else if (filterType === "credit" && type === "credit") {
      shouldShow = true;
    } else if (filterType === "debit" && type === "debit") {
      shouldShow = true;
    } else if (filterType === "topup" && description === "Top Up") {
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
  const desktopButtons = document.querySelectorAll(
    ".filter-buttons .filter-btn"
  );
  desktopButtons.forEach((btn) => {
    btn.classList.remove("active");
    if (btn.getAttribute("data-filter") === filterType) {
      btn.classList.add("active");
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  filterTransactions("all");
});
