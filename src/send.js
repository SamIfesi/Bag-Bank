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
    accname: id("name"),
  },
  btns: {
    next: id("nextBtn"),
    nextSend: id("sendMoneyBtn"),
    quickAmounts: qa(".quick-btn"),
  },
  errors: {
    recipient: id("recipient-error"),
    amount: id("amount-error"),
    bank: id("bank-error"),
    accName: id("accname-error"),
  },
  forms: {
    loader: id("loader"),
    accountSection: id("account-section"),
    amountSection: id("amount-section"),
  },
};
// validate send money form inputs

const initSendMoneyForm = () => {
  const { recipient, amount, bank, accName } = element?.inputs;
  const { next, quickAmounts, nextSend } = element?.btns;
  if (!recipient || !amount || !bank || !next || !nextSend) return;

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

    next.disabled = !(isRecipientValid && isBankValid);
    nextSend.disabled = !(isAmountValid && isAmountLengthValid);
  };
  if (quickAmounts) {
    quickAmounts.forEach((btn) => {
      btn.addEventListener("click", () => {
        element.inputs.amount.value = btn.getAttribute("data-amount");
        validateSendForm();
      });
    });
  }

  recipient.addEventListener("input", () => {
    formatDigitInput(recipient, config.recipient.maxlength);
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
  bank.addEventListener("change", validateSendForm);

  //   next.addEventListener("click", (e) => {
  //     e.preventDefault();

  //     const { loader, accountSection, amountSection } = element.forms;
  //     loader.classList.remove("hide");

  //     setTimeout(() => {
  //       accountSection.classList.add("hide");
  //     }, config.loader800);
  //     setTimeout(() => {
  //       amountSection.classList.remove("hide");
  //     }, config.loader1000);
  //     setTimeout(() => {
  //       loader.classList.add("hide");
  //     }, config.loader1500);
  //   });
};

const fetchAccountName = async (accountNumber, bank) => {
  const url = "";
  try {
    loader.classlist.remove("hide");
    const response = await fetch(url, {
      method: "POST",
      body: formData,
    });
    if (!response.ok) {
      const errorData = await response.json();
      throw new Error(errorData.message || `HTTP Error: ${response.status}`);
    }
    const data = await response.json();
    loader.classlist.add("hide");
    return data;
  } catch (error) {
    console.error("error during fetch of name", error);
  }
};
element.forms.accountSection.addEventListener("submit", async (e) => {
  e.preventDefault();
  const { loader, accountSection, amountSection } = element.forms;
  const { recipient, bank, accname } = element.inputs;
  const { errors } = element;
  errors.recipient.style.display = "none";
  errors.recipient.textContent = "";
  loader.classList.remove("hide");

  const result = await fetchAccountName(recipient.value.trim(), bank.value);
  await new Promise((resolve) => setTimeout(resolve, config.loader800));

  if (result.success) {
    accname.value = result.name;

    accountSection.classList.add("hide");
    amountSection.classList.remove("hide");
  } else {
    errors.recipient.textContent = result.message || "Account not found";
    errors.recipient.style.display = "block";
    errors.recipient.classList.add("showMsg");
  }
  loader.classList.add("hide");
});
document.addEventListener("DOMContentLoaded", () => {
  initSendMoneyForm();
});
