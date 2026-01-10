const TransactionFilter = {
  settings: {
    itemSelector: ".trans-item",
    btnSelector: ".filter-btn[data-filter]",
    emptyStateId: "emptyTrans",
    listId: "transactionsList",
    hiddenClass: "hidden",
    activeClass: "active",
  },

  init() {
    this.items = document.querySelectorAll(this.settings.itemSelector);
    this.buttons = document.querySelectorAll(this.settings.btnSelector);
    this.emptyState = document.getElementById(this.settings.emptyStateId);

    this.bindEvents();
    this.applyInitialFilter();

    const initialFilter = "all";
    this.updateEmptyStateButtons(initialFilter);
  },

  bindEvents() {
    this.buttons.forEach((btn) => {
      btn.addEventListener("click", () => {
        const filter = btn.getAttribute("data-filter");
        this.updateUI(filter);
      });
    });
  },

  updateUI(filterType) {
    let visibleCount = 0;

    // 1. Filter Items
    this.items.forEach((item) => {
      const isMatch = filterType === "all" || item.dataset.type === filterType;

      if (isMatch) {
        item.classList.remove(this.settings.hiddenClass);
        visibleCount++;
      } else {
        item.classList.add(this.settings.hiddenClass);
      }
    });

    // 2. Update Empty State
    if (this.emptyState) {
      this.emptyState.style.display = visibleCount === 0 ? "block" : "none";
    }

    // 3. Always update buttons when filter changes
    this.updateEmptyStateButtons(filterType);

    // 4. Update Button Styles
    this.buttons.forEach((btn) => {
      const isActive = btn.getAttribute("data-filter") === filterType;
      btn.classList.toggle(this.settings.activeClass, isActive);
    });
  },

  /**
   * Updates the action buttons inside both empty state views
   */
  updateEmptyStateButtons(filterType) {
    const noTransactionBtn = document.getElementById("noTransaction");
    if (noTransactionBtn) {
      if (filterType === "top_up") {
        noTransactionBtn.textContent = "Add Money";
        noTransactionBtn.onclick = () =>
          (window.location.href = "add_money.php");
      } else {
        noTransactionBtn.textContent = "Send Money";
        noTransactionBtn.onclick = () => (window.location.href = "send.php");
      }
    }

    const noTransactionYetBtn = document.getElementById("noTransactionYet");
    if (noTransactionYetBtn) {
      if (filterType === "top_up") {
        noTransactionYetBtn.textContent = "Add Money";
        noTransactionYetBtn.onclick = () =>
          (window.location.href = "add_money.php");
      } else {
        noTransactionYetBtn.textContent = "Send Money";
        noTransactionYetBtn.onclick = () => (window.location.href = "send.php");
      }
    }
  },

  applyInitialFilter() {
    const activeBtn = document.querySelector(
      `${this.settings.btnSelector}.${this.settings.activeClass}`
    );
    const initialFilter = activeBtn
      ? activeBtn.getAttribute("data-filter")
      : "all";
    this.updateUI(initialFilter);
  },
};

document.addEventListener("DOMContentLoaded", () => TransactionFilter.init());
