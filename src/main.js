const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);
const q = (s) => document.querySelector(s);

const CONFIG = {
  loaderDelay: 800,
  patterns: {
    email: /^[A-Za-z\d._%+-]+@[A-Za-z\d.-]+\.[A-Za-z]{2,}$/,
    username: /^[a-zA-Z][a-zA-Z0-9_]{2,15}$/,
    fullname: /^[\p{L}\s'-]+$/u,
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W_]).{8,}$/,
  },
  send: {
    amount: {
      maxAmount: 5000000,
      patAmount: /^\d+(\.\d{1,2})?$/,
      maxlength: 10,
    },
    recipient: {
      pattern: /^\d{10}$/,
      maxlength: 10,
    },
  },
};

let tempUserData = {
  password: "",
};
const elements = {
  forms: {
    login: id("login-form"),
    register: id("register-form"),
    steps: {
      email: id("email-form"),
      name: id("name-form"),
      password: id("password-form"),
      confirm: id("confirm-Pswd-form"),
      userLogin: id("userLogin-form"),
      passLogin: id("pswdLogin-form"),
    },
  },
  inputs: {
    email: id("email"),
    fullname: id("fullname"),
    username: id("username"),
    password: id("password"),
    cfmPassword: id("cfm-password"),
  },
  errors: {
    email: id("email-error"),
    fullname: id("fullname-error"),
    username: id("user-error"),
    password: id("password-error"),
    confirm: id("cfm-psd-error"),
  },
  btns: {
    emailNext: id("continueEmail"),
    nameNext: id("continueName"),
    passNext: id("continuePassword"),
    loginNext: id("continueLogin"),
    regNext: id("registerUser"),
  },

  checkers: qa(".psd-check"),
  loader: id("loader"),

  toggles: {
    psd: id("psdShow"),
    cfm: id("cfmPsdShow"),
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
  action: {
    send: id("sendBtn"),
  },
  send: {
    inputs: {
      bank: id("bank"),
      recipient: id("recipient"),
      amount: id("amount"),
      accname: id("name"),
    },
    btns: {
      next: id("nextBtn"),
      send: id("sendMoneyBtn"),
      quickAmounts: qa(".quick-btn"),
    },
    errors: {
      recipient: id("recipient-error"),
      amount: id("amount-error"),
      bank: id("bank-error"),
      accname: id("accname-error"),
    },
  },
};
/**
 * Universal Input Validator
 * @para {HTMLElement} inputElement - The input element
 * @param {RegExp} pattern - Regex pattern
 * @param {HTMLElement} errorElement - The error display element
 * @param {string} patternMsg - Message to show on failure
 * @param {string} requireMsg - Message to show if empty
 * @param {boolean} isValid
 *
 * handle navigation to registration page
 * @param {HTMLElement} regBtn - Register button element
 * @param {HTMLElement} currentStep - Div to hide
 * @param {HTMLElement} nextStep - Div to show
 */

const clearInputs = () => {
  if (elements.inputs.email) elements.inputs.email.value = "";
  if (elements.inputs.fullname) elements.inputs.fullname.value = "";
  if (elements.inputs.username) elements.inputs.username.value = "";
  if (elements.inputs.password) elements.inputs.password.value = "";
  if (elements.inputs.cfmPassword) elements.inputs.cfmPassword.value = "";

  elements.checkers.forEach((item) => item.classList.remove("valid"));
  Object.values(elements.errors).forEach((error) => {
    if (error) {
      error.textContent = "";
      error.classList.remove("showMsg");
    }
  });
};

const validateInput = (
  inputElement,
  pattern,
  errorElement,
  patternMsg,
  requireMsg
) => {
  if (!inputElement) return true;

  if (!inputElement || !errorElement) {
    console.warn("Missing input or error element:", inputElement, errorElement);
    return false;
  }
  const value = inputElement.value.trim();
  errorElement.textContent = "";
  errorElement.classList.remove("showMsg");

  if (value.length === 0) {
    errorElement.textContent = requireMsg;
    errorElement.classList.add("showMsg");
    return false;
  }

  if (pattern && !pattern.test(value)) {
    errorElement.textContent = patternMsg;
    errorElement.classList.add("showMsg");
    return false;
  }
  return true;
};

const transitionStep = (currentStep, nextStep) => {
  if (!currentStep || !nextStep) return;

  currentStep.classList.add("hide");
  elements.loader.classList.remove("hide");

  setTimeout(() => {
    elements.loader.classList.add("hide");
    nextStep.classList.remove("hide");
  }, CONFIG.loaderDelay);
};

// Registration Logic
const initRegistration = () => {
  // email step
  if (!elements.forms.register) return;
  elements.btns.emailNext.addEventListener("click", (e) => {
    e.preventDefault();
    const isValid = validateInput(
      elements.inputs.email,
      CONFIG.patterns.email,
      elements.errors.email,
      "Please enter a valid email address.",
      "Email is required."
    );
    if (isValid)
      transitionStep(elements.forms.steps.email, elements.forms.steps.name);
  });

  // fullname and username step
  elements.btns.nameNext.addEventListener("click", (e) => {
    e.preventDefault();
    const validName = validateInput(
      elements.inputs.fullname,
      CONFIG.patterns.fullname,
      elements.errors.fullname,
      "Invalid fullname format.",
      "Fullname is required."
    );
    const validUser = validateInput(
      elements.inputs.username,
      CONFIG.patterns.username,
      elements.errors.username,
      "Username must be alphanumeric, 3-16 chars.",
      "Username is required."
    );

    if (validName && validUser)
      transitionStep(elements.forms.steps.name, elements.forms.steps.password);
  });
  // password step and Live Rquirement Checker
  elements.inputs.password.addEventListener("input", (e) => {
    const value = e.target.value;
    const check = [
      { text: "Minimum 8 characters", regex: /.{8,}/ },
      { text: "1 uppercase character", regex: /[A-Z]/ },
      { text: "1 lowercase character", regex: /[a-z]/ },
      { text: "1 number character", regex: /[\d]/ },
      { text: "Atleast 1 special character", regex: /[\W_]/ },
    ];
    elements.checkers.forEach((item) => {
      const match = check.find((c) =>
        item.textContent.toLowerCase().includes(c.text.toLowerCase())
      );
      if (match) item.classList.toggle("valid", match.regex.test(value));
    });
  });

  elements.btns.passNext.addEventListener("click", (e) => {
    e.preventDefault();
    const isValid = validateInput(
      elements.inputs.password,
      CONFIG.patterns.password,
      elements.errors.password,
      "Password does not meet requirements.",
      "Password is required."
    );

    if (isValid) {
      tempUserData.password = elements.inputs.password.value;
      transitionStep(
        elements.forms.steps.password,
        elements.forms.steps.confirm
      );
    }
  });

  // final Submission Step
  elements.forms.register.addEventListener("submit", (e) => {
    if (elements.forms.steps.confirm.classList.contains("hide")) {
      e.preventDefault();
      return;
    }
    const cfmValue = elements.inputs.cfmPassword.value;
    elements.errors.confirm.classList.remove("showMsg");

    if (cfmValue !== tempUserData.password) {
      e.preventDefault();
      elements.errors.confirm.textContent = "Passwords do not match.";
      elements.errors.confirm.classList.add("showMsg");
      return;
    }

    elements.loader.classList.remove("hide");
    elements.forms.steps.confirm.classList.add("hide");
  });
};

// Initialize login Process
const initLogin = () => {
  if (!elements.forms.login) return;
  elements.btns.loginNext.addEventListener("click", (e) => {
    e.preventDefault();
    const isValid = validateInput(
      elements.inputs.username,
      CONFIG.patterns.username,
      elements.errors.username,
      "Invalid username format.",
      "Username is required."
    );
    if (isValid)
      transitionStep(
        elements.forms.steps.userLogin,
        elements.forms.steps.passLogin
      );
  });

  elements.forms.login.addEventListener("submit", (e) => {
    const isValid = validateInput(
      elements.inputs.password,
      null,
      elements.errors.password,
      "",
      "Password is required."
    );
    if (isValid) {
      elements.loader.classList.remove("hide");
      elements.forms.steps.passLogin.classList.add("hide");
    } else {
      e.preventDefault();
    }
  });
};

const initUtilities = () => {
  const toggleHandler = (icon, input) => {
    if (!icon || !input) return;
    icon.addEventListener("click", () => {
      const isText = input.type === "text";
      input.type = isText ? "password" : "text";
      icon.classList.toggle("ti-eye");
      icon.classList.toggle("ti-eye-off");
    });
  };

  toggleHandler(elements.toggles.psd, elements.inputs.password);
  toggleHandler(elements.toggles.cfm, elements.inputs.cfmPassword);

  // Back Button Navigation
  const backNavs = [
    {
      btn: id("backLogin"),
      current: elements.forms.steps.email,
      prev: null,
      link: "login.php",
    },
    {
      btn: id("backEmail"),
      current: elements.forms.steps.name,
      prev: elements.forms.steps.email,
    },
    {
      btn: id("backName"),
      current: elements.forms.steps.password,
      prev: elements.forms.steps.name,
    },
    {
      btn: id("backPsd"),
      current: elements.forms.steps.confirm,
      prev: elements.forms.steps.password,
    },
    {
      btn: id("backToLogin"),
      current: elements.forms.steps.passLogin,
      prev: elements.forms.steps.userLogin,
    },
  ];

  backNavs.forEach((nav) => {
    if (nav.btn) {
      nav.btn.addEventListener("click", () => {
        if (nav.link) {
          window.location.href = nav.link;
        } else {
          nav.current.classList.add("hide");
          nav.prev.classList.remove("hide");
        }
      });
    }
  });

  const regBtn = id("register");
  if (regBtn) {
    regBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "register.php";
    });
  }
};

// Initialize all functionalities on DashBoard
const initDashboard = () => {
  // Balance Toggle
  const toggleBalance = () => {
    let toggleBtn = elements.balance.balIcon;
    let balContainer = elements.balance.bal;
    let amountText = elements.balance.amountText;

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
    let toggleBtn = elements.account.accBtn;
    let accNum = elements.account.accNum;
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
/**
 * @param {HTMLElement} sendBtn - Send Money button
 */

const initActionButtons = () => {
  const sendBtn = elements.action?.send;
  if (sendBtn) {
    sendBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "send.php";
    });
  }
};

// validate send money form inputs

const initSendMoneyForm = () => {
  const { recipient, amount, bank, accName } = elements.send?.inputs;
  const { next, quickAmounts } = elements.send?.btns;
  if (!recipient || !amount || !bank || !next) return;

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

    const isRecipientValid = CONFIG.send.recipient.pattern.test(recipientVal);
    const isBankValid = bankVal !== "";
    const isAmountPatternValid = CONFIG.send.amount.patAmount.test(
      amount.value
    );
    const isAmountValueValid =
      !isNaN(amountVal) &&
      amountVal > 0 &&
      amountVal <= CONFIG.send.amount.maxAmount;
    const isAmountValid = isAmountPatternValid && isAmountValueValid;

    next.disabled = !(isRecipientValid && isAmountValid && isBankValid);
  };
  if (quickAmounts) {
    quickAmounts.forEach((btn) => {
      btn.addEventListener("click", () => {
        elements.send.inputs.amount.value = btn.getAttribute("data-amount");
        validateSendForm();
      });
    });
  }

  recipient.addEventListener("input", () => {
    formatDigitInput(recipient, CONFIG.send.recipient.maxlength);
    validateSendForm();
  });
  amount.addEventListener("input", () => {
    formatAmountInput(amount, CONFIG.send.amount.maxlength);
    validateSendForm();
    elements.send.errors.amount.style.display = amount.value ? "block" : "none";
  });
  bank.addEventListener("change", validateSendForm);
};
document.addEventListener("DOMContentLoaded", () => {
  initRegistration();
  initLogin();
  initUtilities();
  initDashboard();
  initSendMoneyForm();
  initActionButtons();
});
