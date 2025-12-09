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
  },
};
/**
 * Universal Inpur Validator
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
    if(elements.forms.steps.confirm.classList.contains('hide')) {
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
    e.preventDefault();
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

document.addEventListener("DOMContentLoaded", () => {
  initRegistration();
  initLogin();
  initUtilities();
});

// Check if user is authenticated
function checkAuth() {
  const userStored = JSON.parse(sessionStorage.getItem("tempUser"));
  const isAuthenticated =
    userStored && userStored.username && userStored.isLoggedIn;

  // Get current page path
  const currentPage = window.location.pathname;

  const publicPages = ["/", "/index.html", "/pages/register.html"];

  if (!isAuthenticated && !publicPages.includes(currentPage)) {
    window.location.href = "/index.html";
  } else if (isAuthenticated && publicPages.includes(currentPage)) {
    window.location.href = "/pages/home.html";
  }
}
// checkAuth();
