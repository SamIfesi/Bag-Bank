const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);
const q = (s) => document.querySelector(s);

const config = {
  loader800: 800,
  loader1000: 1000,
  loader1500: 1500,
  amount: {
    minAmount: 100, 
    maxAmount: 5000000, 
    patAmount: /^\d+(\.\d{1,2})?$/,
    maxlength: 15,
  },
  recipient: {
    pattern: /^\d{10}$/,
    maxlength: 10,
  },
};

const element = {
  inputs: {
    bank: id("bank"),
    recipient: id("recipient"),
    amount: id("amount"),
    accName: id("name"),
  },
  btns: {
    next: id("nextBtn"),
    nextConfirm: id("confirmBtn"),
    quickAmounts: qa(".quick-btn"),
  },
  errors: {
    recipient: id("recipient-error"),
    amount: id("amount-error"),
    bank: id("bank-error"),
    accName: id("accName-error"),
  },
  forms: {
    loader: id("loader"),
    accountSection: id("account-section"),
    amountSection: id("amount-section"),
  },
  details: {
    name: id("recipient-name"),
    account: id("recipient-account"),
    banks: id("recipient-bank"),
  },
  confirmation: {
    container: id("model"),
    model: id("confirm-model"),
    close: id("close-confirm-model"),
    amount: id("model-amount"),
    bank: id("model-bank-name"),
    account: id("model-account-number"),
    name: id("model-account-name"),
    pay: id("payBtn"),
    dragHandle: id("drag"),
  },
};

const getCleanAmount = (input) => {
  if (typeof input !== "string" && input.dataset && input.dataset.cleanValue) {
    return parseFloat(input.dataset.cleanValue);
  }
  let val = typeof input === "string" ? input : input.value;
  return parseFloat(val.replace(/,/g, ""));
};

const initSendMoneyForm = () => {
  const { recipient, amount, bank, accName } = element?.inputs;
  const { next, quickAmounts, nextConfirm } = element?.btns;
  let isAccountVerified = false; 

  if (!recipient || !amount || !bank || !next || !nextConfirm) return;

  const validateSendForm = () => {
    let recipientVal = recipient.value.trim();
    let bankVal = bank.value;

    let rawAmount = amount.dataset.cleanValue || "";
    let amountVal = parseFloat(rawAmount);

    const isRecipientValid = config.recipient.pattern.test(recipientVal);
    const isBankValid = bankVal !== "";

    const isAmountValueValid =
      !isNaN(amountVal) &&
      amountVal >= config.amount.minAmount &&
      amountVal <= config.amount.maxAmount;

    next.disabled = !(isRecipientValid && isBankValid && isAccountVerified);
    nextConfirm.disabled = !isAmountValueValid;
  };

  const formatAmountInput = (input) => {
    let value = input.value.replace(/[^\d.]/g, "");

    const parts = value.split(".");
    if (parts.length > 2) value = parts[0] + "." + parts.slice(1).join("");
    if (parts[1] && parts[1].length > 2)
      value = parts[0] + "." + parts[1].substring(0, 2);

    input.dataset.cleanValue = value;

    if (value !== "") {
      const numParts = value.split(".");
      numParts[0] = Number(numParts[0]).toLocaleString("en-US");
      input.value = numParts.join(".");
    } else {
      input.value = "";
    }
  };

  if (quickAmounts) {
    quickAmounts.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const amt = btn.getAttribute("data-amount");

        amount.dataset.cleanValue = amt;
        amount.value = Number(amt).toLocaleString("en-US", {
          minimumFractionDigits: 2,
        });

        validateSendForm();
        element.errors.amount.style.display = "none";
      });
    });
  }

  recipient.addEventListener("input", () => {
    let val = recipient.value.replace(/\D/g, "");
    recipient.value = val.substring(0, config.recipient.maxlength);
    isAccountVerified = false;
    validateSendForm();
  });

  amount.addEventListener("input", (e) => {
    formatAmountInput(e.target);
    validateSendForm();

    const rawVal = e.target.dataset.cleanValue || "";
    const amountNum = parseFloat(rawVal);

    if (rawVal.length > 0) {
      if (rawVal.length < 3 || amountNum < config.amount.minAmount) {
        element.errors.amount.innerText = "Minimum amount is ₦100";
        element.errors.amount.style.display = "block";
      } else if (amountNum > config.amount.maxAmount) {
        element.errors.amount.innerText = "Maximum amount is ₦5,000,000";
        element.errors.amount.style.display = "block";
      } else {
        element.errors.amount.style.display = "none";
      }
    } else {
      element.errors.amount.style.display = "none";
    }
  });

  // --- Account Lookup Logic ---
  const fetchAccountName = async (accountNumber, bank) => {
    const url = "../app/handlers/resolve_account.php";
    try {
      const formData = new FormData();
      formData.append("account_number", accountNumber);
      formData.append("bank_code", bank);
      const response = await fetch(url, { method: "POST", body: formData });
      if (!response.ok) throw new Error("Network error");
      return await response.json();
    } catch (error) {
      return { success: false, message: "Unable to verify account" };
    }
  };

  const handleAccountLookup = async () => {
    const { loader } = element.forms;
    const { recipient, bank, accName } = element.inputs;
    const { errors, details } = element;

    const recipientVal = recipient.value.trim();
    const bankVal = bank.value;

    if (!config.recipient.pattern.test(recipientVal) || !bankVal) {
      accName.value = "";
      isAccountVerified = false;
      validateSendForm();
      return;
    }

    loader.classList.remove("hide");
    const result = await fetchAccountName(recipientVal, bankVal);
    await new Promise((resolve) => setTimeout(resolve, config.loader800));

    if (result.success) {
      accName.value = result.name;
      details.name.innerText = result.name;
      details.account.innerText = recipientVal;
      if (bankVal === "my_bank") details.banks.innerText = "D'bag Bank";
      errors.recipient.style.display = "none";
      isAccountVerified = true;
    } else {
      accName.value = "";
      errors.recipient.textContent = result.message || "Account not found";
      errors.recipient.style.display = "block";
      isAccountVerified = false;
    }
    loader.classList.add("hide");
    validateSendForm();
  };

  bank.addEventListener("change", () => {
    validateSendForm();
    handleAccountLookup();
  });

  recipient.addEventListener("blur", () => {
    if (config.recipient.pattern.test(recipient.value.trim()) && bank.value) {
      handleAccountLookup();
    }
  });

  next.addEventListener("click", (e) => {
    e.preventDefault();
    const { loader, accountSection, amountSection } = element.forms;
    loader.classList.remove("hide");
    setTimeout(() => accountSection.classList.add("hide"), 500);
    setTimeout(() => amountSection.classList.remove("hide"), 800);
    setTimeout(() => loader.classList.add("hide"), 1000);
  });
};

function navigateBack() {
  const backBtns = [
    {
      btn: id("backToAccountBtn"),
      from: id("amount-section"),
      to: id("account-section"),
    },
    {
      btn: id("backToDashBtn"),
      from: id("account-section"),
      to: null,
      link: "dashboard.php",
    },
  ];
  backBtns.forEach(({ btn, from, to, link }) => {
    if (btn) {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        element.forms.loader.classList.remove("hide");
        setTimeout(() => from.classList.add("hide"), 500);
        if (to) {
          setTimeout(() => {
            to.classList.remove("hide");
            element.forms.loader.classList.add("hide");
          }, 800);
        } else if (link) {
          setTimeout(() => {
            window.location.href = link;
          }, 800);
        }
      });
    }
  });

  // --- Confirm Modal Logic ---
  const { nextConfirm } = element.btns;
  nextConfirm.addEventListener("click", (e) => {
    e.preventDefault();
    const { amount } = element.inputs;
    const { banks, account, name } = element.details;
    const {
      container,
      model,
      close,
      amount: mAmount,
      bank: mBank,
      account: mAccount,
      name: mName,
    } = element.confirmation;

    const rawVal = amount.dataset.cleanValue || getCleanAmount(amount);
    const formatted = parseFloat(rawVal).toLocaleString("en-NG", {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });

    mAmount.innerText = "₦" + formatted;
    mBank.innerText = banks.innerText;
    mAccount.innerText = account.innerText;
    mName.innerText = name.innerText;

    model.classList.add("active");
    container.classList.add("active");

    if (close) {
      close.onclick = (e) => {
        e.preventDefault();
        model.classList.remove("active");
        container.classList.remove("active");
      };
    }
  });

  const { pay } = element.confirmation;
  pay.addEventListener("click", async (e) => {
    e.preventDefault();
    const { model, container } = element.confirmation;
    const { loader } = element.forms;

    const amountVal =
      element.inputs.amount.dataset.cleanValue ||
      getCleanAmount(element.inputs.amount);

    pay.disabled = true;
    pay.innerText = "Processing...";
    loader.classList.remove("hide");

    try {
      const formData = new FormData();
      formData.append("amount", amountVal);
      formData.append("recipient_account", element.inputs.recipient.value);
      formData.append("recipient_name", element.inputs.accName.value);
      formData.append("bank_code", element.inputs.bank.value);

      const response = await fetch("../app/handlers/process_transfer.php", {
        method: "POST",
        body: formData,
      });
      const result = await response.json();

      await new Promise((resolve) => setTimeout(resolve, config.loader1500));
      loader.classList.remove("hide");

      if (result.success) {
        window.location.href =
          "transfer_success.php?ref=" + result.transaction_ref;
      } else {
        pay.disabled = false;
        pay.innerText = "Proceed";
        model.classList.remove("active");
        container.classList.remove("active");
        element.errors.amount.innerText = result.message || "Transfer failed.";
        element.errors.amount.style.display = "block";
      }
    } catch (error) {
      loader.classList.add("hide");
      pay.disabled = false;
      pay.innerText = "Proceed";
    }
  });
}

const drag = () => {
  const { dragHandle, model, container } = element.confirmation;
  if (!dragHandle) return;

  let isDragging = false;
  let startY = 0;
  let currentY = 0;

  const startDrag = (e) => {
    isDragging = true;
    startY = e.type.includes("touch") ? e.touches[0].clientY : e.clientY;
    model.style.transition = "none";
  };

  const duringDrag = (e) => {
    if (!isDragging) return;
    currentY = e.type.includes("touch") ? e.touches[0].clientY : e.clientY;
    let deltaY = currentY - startY;
    if (deltaY > 0) model.style.transform = `translateY(${deltaY}px)`;
  };

  const endDrag = () => {
    if (!isDragging) return;
    isDragging = false;
    let deltaY = (currentY || startY) - startY;
    if (deltaY > 200) {
      model.style.transform = `translateY(100%)`;
      setTimeout(() => {
        container.classList.remove("active");
        model.classList.remove("active");
        model.style.transform = "";
      }, 400);
    } else {
      model.style.transform = `translateY(0)`;
      model.style.transition = "transform 0.3s ease";
    }
    currentY = 0;
  };

  dragHandle.addEventListener("mousedown", startDrag);
  dragHandle.addEventListener("touchstart", startDrag);
  window.addEventListener("mousemove", duringDrag);
  window.addEventListener("touchmove", duringDrag);
  window.addEventListener("mouseup", endDrag);
  window.addEventListener("touchend", endDrag);
};

document.addEventListener("DOMContentLoaded", () => {
  initSendMoneyForm();
  navigateBack();
  drag();
});