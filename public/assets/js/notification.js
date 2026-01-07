document.addEventListener("DOMContentLoaded", () => {
  // --- Modal Setup ---
  const modal = document.getElementById("confirmationModal");
  const modalTitle = document.getElementById("modalTitle");
  const modalMessage = document.getElementById("modalMessage");
  const modalConfirm = document.getElementById("modalConfirm");
  const modalCancel = document.getElementById("modalCancel");
  const modalClose = document.getElementById("modalClose");
  const modalOverlay = document.getElementById("modalOverlay");

  let confirmCallback = null;

  function showConfirmationModal(title, message, onConfirm) {
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    confirmCallback = onConfirm;
    modal.classList.remove("hide");
  }

  function hideConfirmationModal() {
    modal.classList.add("hide");
    confirmCallback = null;
  }

  modalConfirm.addEventListener("click", () => {
    if (confirmCallback) {
      confirmCallback();
    }
    hideConfirmationModal();
  });

  modalCancel.addEventListener("click", hideConfirmationModal);
  modalClose.addEventListener("click", hideConfirmationModal);
  modalOverlay.addEventListener("click", hideConfirmationModal);

  // --- 1. Filtering Logic ---
  const tabs = document.querySelectorAll(".tab-btn");
  const items = document.querySelectorAll(".notif-item");
  const emptyState = document.querySelector(".empty-state");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      // UI Toggle
      tabs.forEach((t) => t.classList.remove("active"));
      tab.classList.add("active");

      const filter = tab.getAttribute("data-filter");
      let visibleCount = 0;

      items.forEach((item) => {
        const category = item.getAttribute("data-category");
        const isUnread = item.classList.contains("unread");

        // Logic to show/hide
        let shouldShow = false;

        if (filter === "all") {
          shouldShow = true;
        } else if (filter === "unread") {
          shouldShow = isUnread;
        } else if (filter === category) {
          shouldShow = true;
        }

        // Apply
        if (shouldShow) {
          item.classList.remove("hide");
          visibleCount++;
        } else {
          item.classList.add("hide");
        }
      });

      // Empty State
      if (visibleCount === 0) {
        emptyState.classList.remove("hide");
      } else {
        emptyState.classList.add("hide");
      }
    });
  });

  // --- 2. Mark All as Read ---
  const markAllBtn = document.getElementById("markAllRead");

  markAllBtn.addEventListener("click", () => {
    const unreadItems = document.querySelectorAll(".notif-item.unread");

    if (unreadItems.length === 0) return;

    showConfirmationModal(
      "Mark All as Read?",
      "All notifications will be marked as read.",
      () => {
        unreadItems.forEach((item) => {
          item.classList.remove("unread");
          const dot = item.querySelector(".status-dot");
          if (dot) dot.remove();
        });
        // Optional: Send AJAX request to PHP here to update DB
      }
    );
  });

  // --- 3. Individual Click ---
  items.forEach((item) => {
    item.addEventListener("click", function () {
      if (this.classList.contains("unread")) {
        this.classList.remove("unread");
        const dot = this.querySelector(".status-dot");
        if (dot) dot.remove();
      }
    });
  });
});
