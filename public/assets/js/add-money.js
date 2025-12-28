const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);

const config = {
  minAmount: 100,
  maxAmount: 10000,
  amountPattern: /^\d+(\.\d{1,2})?$/,
  maxLength: 8,
};

const elements = {
  form: id("addMoneyForm"),
  amountInput: id("amount"),
  amountError: id("amount-error"),
  quickBtns: qa(". quick-btn"),
  addMoneyBtn: id("addMoneyBtn"),
  loader: id("loader"),
  backBtn: id("backBtn"),
  successModal: id("successModal"),
  errorModal: id("errorModal"),
  modalAmount: id("modalAmount"),
  newBalance: id("newBalance"),
  errorMessage: id("errorMessage"),
  doneBtn: id("doneBtn"),
  tryAgainBtn: id("tryAgainBtn"),
};

// Format amount input
const formatAmountInput = (input, maxLength) => {
  let value = input.value.replace(/[^\d.]/g, "");
  const parts = value.split(".");

  if (parts.length > 2) {
    value = parts[0] + "." + parts.slice(1).join("");
  }

  if (parts[1] && parts[1].length > 2) {
    value = parts[0] + "." + parts[1].substring(0, 2);
  }

  if (value.length > maxLength) {
    value = value.substring(0, maxLength);
  }

  input.value = value;
};

// Validate amount
const validateAmount = () => {
  const value = elements.amountInput.value.trim();
  const amount = parseFloat(value);

  if (!value) {
    elements.addMoneyBtn.disabled = true;
    elements.amountError.classList.remove("show");
    return false;
  }

  if (!config.amountPattern.test(value)) {
    elements.amountError.textContent = "Invalid amount format";
    elements.amountError.classList.add("show");
    elements.addMoneyBtn.disabled = true;
    return false;
  }

  if (amount < config.minAmount) {
    elements.amountError.textContent = `Minimum amount is ₦${config.minAmount.toLocaleString()}`;
    elements.amountError.classList.add("show");
    elements.addMoneyBtn.disabled = true;
    return false;
  }

  if (amount > config.maxAmount) {
    elements.amountError.textContent = `Maximum amount is ₦${config.maxAmount.toLocaleString()} per transaction`;
    elements.amountError.classList.add("show");
    elements.addMoneyBtn.disabled = true;
    return false;
  }

  elements.amountError.classList.remove("show");
  elements.addMoneyBtn.disabled = false;
  return true;
};

// Quick amount buttons
elements.quickBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    elements.quickBtns.forEach((b) => b.classList.remove("selected"));
    btn.classList.add("selected");
    elements.amountInput.value = btn.getAttribute("data-amount");
    validateAmount();
  });
});

// Amount input validation
elements.amountInput.addEventListener("input", () => {
  formatAmountInput(elements.amountInput, config.maxLength);
  validateAmount();

  // Remove selected class from quick buttons
  elements.quickBtns.forEach((b) => b.classList.remove("selected"));
});

// Back button
elements.backBtn.addEventListener("click", () => {
  window.location.href = "dashboard. php";
});

// Form submission
elements.form.addEventListener("submit", async (e) => {
  e.preventDefault();

  if (!validateAmount()) {
    return;
  }

  const amount = parseFloat(elements.amountInput.value);
  const paymentMethod = document.querySelector(
    'input[name="payment_method"]:checked'
  ).value;
  const description = id("description").value.trim() || "Wallet top-up";

  // Show loader
  elements.loader.classList.remove("hide");
  elements.addMoneyBtn.disabled = true;

  try {
    const response = await fetch("includes/components/process_add_money.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        amount: amount,
        payment_method: paymentMethod,
        description: description,
      }),
    });

    const data = await response.json();

    // Hide loader
    elements.loader.classList.add("hide");

    if (response.ok && data.success) {
      // Show success modal
      elements.modalAmount.textContent = `₦${data.amount_added}`;
      elements.newBalance.textContent = `₦${data.new_balance}`;
      elements.successModal.classList.add("active");
    } else {
      // Show error modal
      elements.errorMessage.textContent =
        data.message || "Transaction failed. Please try again.";
      elements.errorModal.classList.add("active");
      elements.addMoneyBtn.disabled = false;
    }
  } catch (error) {
    console.error("Error:", error);
    elements.loader.classList.add("hide");
    elements.errorMessage.textContent =
      "Network error. Please check your connection and try again.";
    elements.errorModal.classList.add("active");
    elements.addMoneyBtn.disabled = false;
  }
});

// Done button - redirect to dashboard
elements.doneBtn.addEventListener("click", () => {
  window.location.href = "views/dashboard.php";
});

// Try again button - close modal
elements.tryAgainBtn.addEventListener("click", () => {
  elements.errorModal.classList.remove("active");
  elements.addMoneyBtn.disabled = false;
});
