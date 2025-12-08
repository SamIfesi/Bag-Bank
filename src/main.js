const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);
const q = (s) => document.querySelector(s);

// forms
const userLoginForm = id("userLogin-form");
const pswdLoginForm = id("pswdLogin-form");
const passwordform = id("password-form");
const emailform = id("email-form");
const nameform = id("name-form");
const confirmPswdform = id("confirm-Pswd-form");

const regBtn = id("register");

// inputs
const username = id("username");
const password = id("password");
const email = id("email");
const fullname = id("fullname");
const cfmPassword = id("cfm-password");
const checker = qa(".psd-check");

// show password icons
const psdShow = id("psdShow");
const cfmPsdShow = id("iconCmf-psdShow");

// messages
const msgSuccess = id("msg-success");
const userMsg = id("user-error");
const pwdMsg = id("password-error");
const emailMsg = id("email-error");
const fullnameMsg = id("fullname-error");
const cfmPwdMsg = id("cfm-psd-error");

// Arrows
const backLogin = id("backLogin");
const backEmail = id("backEmail");
const backName = id("backName");
const backPsd = id("backPsd");

// Loader
const loader = id("loader");

// Navigate to registration page
if (regBtn) {
  regBtn.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = "register.php";
  });
}

// Password show/hide toggle
if (psdShow) {
  psdShow.addEventListener("click", (e) => {
    const eye = e.target;
    if (
      eye.classList.contains("ti-eye") &&
      !eye.classList.contains("ti-eye-off") &&
      password.type === "password"
    ) {
      eye.classList.replace("ti-eye", "ti-eye-off");
      password.type = "text";
    } else {
      eye.classList.replace("ti-eye-off", "ti-eye");
      password.type = "password";
    }
  });
}
// Confirm Password show/hide toggle
if (cfmPsdShow) {
  cfmPsdShow.addEventListener("click", (e) => {
    const eye = e.target;
    if (
      eye.classList.contains("ti-eye") &&
      !eye.classList.contains("ti-eye-off") &&
      cfmPassword.type === "password"
    ) {
      eye.classList.replace("ti-eye", "ti-eye-off");
      cfmPassword.type = "text";
    } else {
      eye.classList.replace("ti-eye-off", "ti-eye");
      cfmPassword.type = "password";
    }
  });
}

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

function loginUsers() {
  // Username form for Login
  if (userLoginForm) {
    userLoginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const usernameValue = username.value.toLowerCase().trim();
      const userPattern = /^[a-zA-Z][a-zA-Z0-9_]{2,15}$/;

      let valid = true;
      userMsg.textContent = "";
      userMsg.classList.remove("showMsg");

      const validation = [
        {
          condition: usernameValue.length === 0,
          message: "Username is required",
          element: userMsg,
        },
        {
          condition: usernameValue !== "" && !userPattern.test(usernameValue),
          message: "Invalid username.",
          element: userMsg,
        },
      ];

      for (const validate of validation) {
        if (validate.condition) {
          valid = false;
          validate.element.textContent = validate.message;
          validate.element.classList.add("showMsg");
          break;
        }
      }

      if (valid) {
        loginData.username = usernameValue;
        userMsg.textContent = "";
        userMsg.classList.remove("showMsg");

        userLoginForm.classList.add("hide");
        loader.classList.remove("hide");
        setTimeout(() => {
          loader.classList.add("hide");
          pswdLoginForm.classList.remove("hide");
        }, 1500);
      }
    });
  }

  if (pswdLoginForm) {
    pswdLoginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const pswdValue = password.value;

      let valid = true;
      pwdMsg.textContent = "";
      pwdMsg.classList.remove("showMsg");

      const validation = [
        {
          condition: pswdValue === "",
          message: "Password is required",
          element: pwdMsg,
        },
      ];

      for (let validate of validation) {
        if (validate.condition) {
          valid = false;
          validate.element.textContent = validate.message;
          validate.element.classList.add("showMsg");
          break;
        }
      }
    });
  }
}
loginUsers();


//Function for registerUsers()

function registerUsers() {
  //  Email form submission
  if (emailform) {
    emailform.addEventListener("submit", (e) => {
      e.preventDefault();
      let emailValue = email.value.toLowerCase().trim();
      const emailPattern = /^[A-Za-z\d._%+-]+@[A-Za-z\d.-]+\.[A-Za-z]{2,}$/;

      let valid = true;
      emailMsg.textContent = "";
      emailMsg.classList.remove("showMsg");

      const validation = [
        {
          condition: emailValue.length === 0,
          message: "Email is required.",
          element: emailMsg,
        },
        {
          condition: !emailPattern.test(emailValue),
          message: "Invalid email address.",
          element: emailMsg,
        },
      ];

      if (email) {
        for (const validate of validation) {
          if (validate.condition) {
            valid = false;
            validate.element.textContent = validate.message;
            validate.element.classList.add("showMsg");
            break;
          }
        }
      }

      if (valid) {
        emailMsg.textContent = "";
        emailMsg.classList.remove("showMsg");

        emailform.classList.add("hide");
        loader.classList.remove("hide");
        setTimeout(() => {
          loader.classList.add("hide");
          nameform.classList.remove("hide");
        }, 1500);
      }
    });
  }

  //   Name form submission
  if (nameform) {
    nameform.addEventListener("submit", (e) => {
      e.preventDefault();
      let nameValue = fullname.value.toLowerCase().trim();
      let usernameValue = username.value.toLowerCase().trim();
      const namePattern = /^[\p{L}\s'-]+$/u;
      const userPattern = /^[a-zA-Z][a-zA-Z0-9_]{2,15}$/;

      let valid = true;
      fullnameMsg.textContent = "";
      userMsg.textContent = "";
      fullnameMsg.classList.remove("showMsg");
      userMsg.classList.remove("showMsg");

      const validation = [
        {
          condition: nameValue.length === 0,
          message: "Fullname is required.",
          element: fullnameMsg,
        },
        {
          condition: nameValue.length > 0 && !namePattern.test(nameValue),
          message: "Invalid fullname.",
          element: fullnameMsg,
        },
        {
          condition: usernameValue.length === 0,
          message: "Username is required.",
          element: userMsg,
        },
        {
          condition:
            usernameValue.length > 0 && !userPattern.test(usernameValue),
          message: "Invalid username.",
          element: userMsg,
        },
      ];

      if (fullname) {
        for (const validate of validation) {
          if (validate.condition) {
            valid = false;
            validate.element.textContent = validate.message;
            validate.element.classList.add("showMsg");
          }
        }
      }

      if (valid) {
        fullnameMsg.textContent = "";
        userMsg.textContent = "";
        fullnameMsg.classList.remove("showMsg");
        userMsg.classList.remove("showMsg");

        nameform.classList.add("hide");
        loader.classList.remove("hide");
        setTimeout(() => {
          loader.classList.add("hide");
          passwordform.classList.remove("hide");
        }, 1500);
      }
    });
  }

  //  password form submission
  if (passwordform) {
    const pswdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W_]).{8,}$/;
    password.addEventListener("input", () => {
      let pwdValue = password.value;

      checker.forEach((check) => {
        if (check.textContent.includes("Minimum 8 characters")) {
          check.classList.toggle("valid", pwdValue.length >= 8);
        }
        if (check.textContent.includes("1 uppercase character")) {
          check.classList.toggle("valid", /[A-Z]/.test(pwdValue));
        }
        if (check.textContent.includes("1 lowercase character")) {
          check.classList.toggle("valid", /[a-z]/.test(pwdValue));
        }
        if (check.textContent.toLowerCase().includes("1 number character")) {
          check.classList.toggle("valid", /[\d]/.test(pwdValue));
        }
        if (check.textContent.includes("Atleast 1 special character")) {
          check.classList.toggle("valid", /[\W_]/.test(pwdValue));
        }
      });
      pwdMsg.textContent = "";
      pwdMsg.classList.remove("showMsg");
    });

    passwordform.addEventListener("submit", (e) => {
      e.preventDefault();
      let pwdValue = password.value;

      let valid = true;
      pwdMsg.textContent = "";
      pwdMsg.classList.remove("showMsg");

      const validation = [
        {
          condition: pwdValue.length === 0,
          message: "Password is required.",
          element: pwdMsg,
        },
        {
          condition: pwdValue.length > 0 && !pswdPattern.test(pwdValue),
          message: "Password must meet all requirements.",
          element: pwdMsg,
        },
      ];

      if (password) {
        for (const validate of validation) {
          if (validate.condition) {
            valid = false;
            validate.element.textContent = validate.message;
            validate.element.classList.add("showMsg");
          }
        }
      }

      if (valid) {
        pwdMsg.textContent = "";
        pwdMsg.classList.remove("showMsg");
        passwordform.classList.add("hide");
        loader.classList.remove("hide");
        setTimeout(() => {
          loader.classList.add("hide");
          confirmPswdform.classList.remove("hide");
        }, 1500);
      }
    });
  }

  // Confirm password form submission
  if (confirmPswdform) {
    confirmPswdform.addEventListener("submit", (e) => {
      e.preventDefault();
      let cfmPsdValue = cfmPassword.value;

      let valid = true;
      cfmPwdMsg.textContent = "";
      cfmPwdMsg.classList.remove("showMsg");

      const validation = [
        {
          condition: cfmPsdValue.length === 0,
          message: "Confirm Password is required.",
          element: cfmPwdMsg,
        },
        {
          condition: cfmPsdValue !== userData.password,
          message: "Passwords do not match.",
          element: cfmPwdMsg,
        },
      ];

      if (cfmPassword) {
        for (const validate of validation) {
          if (validate.condition) {
            valid = false;
            validate.element.textContent = validate.message;
            validate.element.classList.add("showMsg");
            break;
          }
        }
      }

      if (valid) {
      }
    });
  }
}
registerUsers();

// Back buttons functionality
if (backPsd) {
  backPsd.addEventListener("click", () => {
    loader.classList.remove("hide");
    confirmPswdform.classList.add("hide");
    setTimeout(() => {
      loader.classList.add("hide");
      passwordform.classList.remove("hide");
    }, 1500);
  });
}
if (backName) {
  backName.addEventListener("click", () => {
    loader.classList.remove("hide");
    passwordform.classList.add("hide");
    setTimeout(() => {
      loader.classList.add("hide");
      nameform.classList.remove("hide");
    }, 1500);
  });
}
if (backEmail) {
  backEmail.addEventListener("click", () => {
    loader.classList.remove("hide");
    nameform.classList.add("hide");
    setTimeout(() => {
      loader.classList.add("hide");
      emailform.classList.remove("hide");
    }, 1500);
  });
}
if (backLogin) {
  backLogin.addEventListener("click", () => {
    loader.classList.remove("hide");
    emailform.classList.add("hide");
    setTimeout(() => {
      loader.classList.add("hide");
      window.location.href = "/index.html";
    }, 1500);
  });
}
