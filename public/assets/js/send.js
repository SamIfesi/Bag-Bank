const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);
const q = (s) => document.querySelector(s);

const config = {
  loader800: 800,
  loader1000: 1000,
  loader1500: 1500,
  amount: {
    maxAmount: 5000000,
    patAmount: /^\d+(\.\d{1,2})?$/,
    maxlength: 10,
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
  },
};

// validate send money form inputs
const initSendMoneyForm = () => {
  const { recipient, amount, bank, accName } = element?.inputs;
  const { next, quickAmounts, nextConfirm } = element?.btns;
  if (!recipient || !amount || !bank || !next || !nextConfirm) return;

  const formatDigitInput = (input, maxLength) => {
    let value = input.value.replace(/\D/g, "");
    if (value.length > maxLength) {
      value = value.substring(0, maxLength);
    }
    input.value = value;
  };
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

  const validateSendForm = () => {
    let recipientVal = recipient.value.trim();
    let amountVal = parseFloat(amount.value);
    let bankVal = bank.value;

    const isRecipientValid = config.recipient.pattern.test(recipientVal);
    const isBankValid = bankVal !== "";
    const isAmountPatternValid = config.amount.patAmount.test(amount.value);
    const isAmountValueValid =
      !isNaN(amountVal) &&
      amountVal > 0 &&
      amountVal <= config.amount.maxAmount;
    const isAmountValid = isAmountPatternValid && isAmountValueValid;
    const isAmountLengthValid = amount.value.length > 2;

    next.disabled = !(isRecipientValid && isBankValid && isAccountVerified);
    nextConfirm.disabled = !(isAmountValid && isAmountLengthValid);
  };
  if (quickAmounts) {
    quickAmounts.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        element.inputs.amount.value = btn.getAttribute("data-amount");
        validateSendForm();
      });
    });
  }

  recipient.addEventListener("input", () => {
    formatDigitInput(recipient, config.recipient.maxlength);
    isAccountVerified = false;
    validateSendForm();
  });
  amount.addEventListener("input", () => {
    formatAmountInput(amount, config.amount.maxlength);
    validateSendForm();

    const amountLength = amount.value.length;
    const amountValue = parseFloat(amount.value);

    if (amountValue > 0 && amountLength > 0 && amountLength <= 2) {
      element.errors.amount.style.display = "block";
    } else {
      element.errors.amount.style.display = "none";
    }
  });

  const fetchAccountName = async (accountNumber, bank) => {
    const url = "app/handlers/resolve_account.php";
    try {
      const formData = new FormData();
      formData.append("account_number", accountNumber);
      formData.append("bank_code", bank);
      const response = await fetch(url, {
        method: "POST",
        body: formData,
      });
      if (!response.ok) throw new Error("Network error");

      const data = await response.json();
      return data;
    } catch (error) {
      console.log("error during fetch of name", error);
      return { success: false, message: "Unable to verify account" };
    }
  };

  let isAccountVerified = false;

  const handleAccountLookup = async () => {
    const { loader } = element.forms;
    const { recipient, bank, accName } = element.inputs;
    const { errors } = element;
    const { name, account, banks } = element.details;

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
      name.innerText = result.name;
      account.innerText = recipientVal;
      if (bankVal === "my_bank") banks.innerText = "D'bag Bank";
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

    setTimeout(() => {
      accountSection.classList.add("hide");
    }, 500);

    setTimeout(() => {
      amountSection.classList.remove("hide");
    }, 800);

    setTimeout(() => {
      loader.classList.add("hide");
    }, 1000);
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
        const { loader } = element.forms;
        loader.classList.remove("hide");

        setTimeout(() => {
          from.classList.add("hide");
        }, 500);
        if (to) {
          setTimeout(() => {
            to.classList.remove("hide");
            loader.classList.add("hide");
          }, 800);
        } else if (link) {
          setTimeout(() => {
            window.location.href = link;
          }, 800);
        }
      });
    }
  });

  const { nextConfirm } = element.btns;
  nextConfirm.addEventListener("click", (e) => {
    e.preventDefault();
    const { amount } = element.inputs;
    const {
      banks: detailBank,
      account: detailAccount,
      name: detailName,
    } = element.details;
    const {
      container,
      model,
      close,
      amount: modelAmount,
      bank: modelBank,
      account: modelAccount,
      name: modelName,
    } = element.confirmation;

    const formattedAmount = parseFloat(amount.value).toLocaleString(undefined, {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
    modelAmount.innerText = "₦" + formattedAmount;
    modelBank.innerText = detailBank.innerText;
    modelAccount.innerText = detailAccount.innerText;
    modelName.innerText = detailName.innerText;

    model.classList.add("active");
    container.classList.add("active");

    if (close) {
      close.addEventListener("click", (e) => {
        e.preventDefault();
        model.classList.remove("active");
        container.classList.remove("active");
      });
    }
  });
  const { pay } = element.confirmation;
  pay.addEventListener("click", async (e) => {
    e.preventDefault();
    const { model, container } = element.confirmation;
    const { loader } = element.forms;
    const amountInput = element.inputs.amount;
    const recipientInput = element.inputs.recipient;
    const nameInput = element.inputs.accName;
    const bankInput = element.inputs.bank;

    pay.disabled = true;
    pay.innerText = "Processing...";
    loader.classList.remove("hide");

    try {
      const formData = new FormData();
      formData.append("amount", amountInput.value);
      formData.append("recipient_account", recipientInput.value);
      formData.append("recipient_name", nameInput.value);
      formData.append("bank_code", bankInput.value);

      const url = "app/handlers/process_transfer.php";
      const response = await fetch(url, {
        method: "POST",
        body: formData,
      });

      const responseText = await response.text();

      if (!response.ok) {
        throw new Error("Network response was not ok" + responseText);
      }

      const result = JSON.parse(responseText);

      await new Promise((resolve) => setTimeout(resolve, config.loader1500));
      loader.classList.add("hide");
      if (result.success) {
        model.classList.remove("active");
        container.classList.remove("active");
        window.location.href =
          "transfer_success.php?ref=" + result.transaction_ref;
      } else {
        pay.disabled = false;
        pay.innerText = "Proceed";
        model.classList.remove("active");
        container.classList.remove("active");

        element.errors.amount.innerText =
          result.message || "Transfer failed. Please try again.";
        element.errors.amount.style.display = "block";
      }
    } catch (error) {
      console.log("Payment error:", error);
      loader.classList.add("hide");
      pay.disabled = false;
      pay.innerText = "Proceed";
      model.classList.remove("active");
      container.classList.remove("active");
    }
  });
}
document.addEventListener("DOMContentLoaded", () => {
  initSendMoneyForm();
  navigateBack();
});
