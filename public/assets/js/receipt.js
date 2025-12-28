const id = (id) => document.getElementById(id);

const elements = {
  statusModal: id("statusModal"),
  receiptContainer: id("receiptContainer"),
  viewReceiptBtn: id("viewReceiptBtn"),
  backToDashBtn: id("backToDashBtn"),
  printBtn: id("printBtn"),
  downloadBtn: id("downloadBtn"),
  backBtn: id("backBtn"),
};

// View receipt from status modal
if (elements.viewReceiptBtn) {
  elements.viewReceiptBtn.addEventListener("click", () => {
    elements.statusModal.classList.remove("active");
    elements.receiptContainer.classList.remove("hide");
  });
}

// Back to dashboard from status modal
if (elements.backToDashBtn) {
  elements.backToDashBtn.addEventListener("click", () => {
    window.location.href = "views/dashboard.php";
  });
}

// Print receipt
if (elements.printBtn) {
  elements.printBtn.addEventListener("click", () => {
    window.print();
  });
}

// Download PDF (using browser print to PDF)
if (elements.downloadBtn) {
  elements.downloadBtn.addEventListener("click", () => {
    window.print();
  });
}

// Back to dashboard from receipt
if (elements.backBtn) {
  elements.backBtn.addEventListener("click", () => {
    window.location.href = "views/dashboard.php";
  });
}
