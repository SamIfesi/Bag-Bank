const id = (id) => document.getElementById(id);

const elements = {
  form: id("profileForm"),
  imageUpload: id("imageUpload"),
  profileImage: id("profileImage"),
  phoneInput: id("phone"),
  phoneError: id("phone-error"),
  bioInput: id("bio"),
  bioCount: id("bioCount"),
  saveBtn: id("saveBtn"),
  loader: id("loader"),
  successAlert: id("successAlert"),
  errorAlert: id("errorAlert"),
};

// Image preview
if (elements.imageUpload) {
  elements.imageUpload.addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
      // Validate file type
      const validTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!validTypes.includes(file.type)) {
        alert("Only JPG, JPEG, PNG & GIF files are allowed");
        e.target.value = "";
        return;
      }

      // Validate file size (5MB max)
      if (file.size > 5 * 1024 * 1024) {
        alert("Image size must not exceed 5MB");
        e.target.value = "";
        return;
      }

      // Preview image
      const reader = new FileReader();
      reader.onload = function (event) {
        if (elements.profileImage) {
          elements.profileImage.src = event.target.result;
        } else {
          // If no image exists, create one
          const imgContainer = document.querySelector(".profile-picture");
          const defaultAvatar = imgContainer.querySelector(".default-avatar");
          if (defaultAvatar) {
            defaultAvatar.remove();
          }

          const img = document.createElement("img");
          img.id = "profileImage";
          img.src = event.target.result;
          img.alt = "Profile Picture";
          imgContainer.insertBefore(
            img,
            imgContainer.querySelector(".image-upload-label")
          );
        }
      };
      reader.readAsDataURL(file);
    }
  });
}

// Phone validation
if (elements.phoneInput) {
  elements.phoneInput.addEventListener("input", function () {
    let value = this.value.replace(/[^0-9+\s-]/g, "");
    this.value = value;

    // Basic validation
    const cleaned = value.replace(/[^0-9+]/g, "");
    if (cleaned.length > 0 && (cleaned.length < 10 || cleaned.length > 15)) {
      elements.phoneError.textContent = "Phone number must be 10-15 digits";
      elements.phoneError.classList.add("show");
    } else {
      elements.phoneError.classList.remove("show");
    }
  });
}

// Bio character count
if (elements.bioInput && elements.bioCount) {
  const updateCharCount = () => {
    const count = elements.bioInput.value.length;
    elements.bioCount.textContent = count;

    if (count > 500) {
      elements.bioCount.style.color = "var(--color-danger)";
    } else {
      elements.bioCount.style.color = "var(--text-secondary)";
    }
  };

  elements.bioInput.addEventListener("input", updateCharCount);
  updateCharCount(); // Initial count
}

// Show error banner with message
const showErrorBanner = (message) => {
  const banner = document.getElementById("errorBanner");
  const errorMessage = document.getElementById("errorMessage");
  
  if (banner && errorMessage) {
    errorMessage.textContent = message;
    banner.classList.add("show");
    
    // Auto-hide banner after 3 seconds
    setTimeout(() => {
      banner.classList.remove("show");
    }, 3000);
  }
};

// Form submission - Submit form normally to PHP handler
if (elements.form) {
  elements.form.addEventListener("submit", function (e) {
    // Show loader
    if (elements.loader) {
      elements.loader.classList.remove("hide");
    }
    
    // Check if there are any validation errors before submitting
    const phoneError = document.getElementById("phone-error");
    if (phoneError && phoneError.classList.contains("show")) {
      e.preventDefault();
      
      // Hide loader and show error banner
      if (elements.loader) {
        elements.loader.classList.add("hide");
      }
      
      showErrorBanner("Please fix all validation errors before submitting");
      return false;
    }
    
    // Form will submit normally to the PHP handler
    // Loader will remain visible until page reloads
  });
}

// Auto-hide alerts after 5 seconds
// // const hideAlert = (alert) => {
// //   if (alert) {
// //     setTimeout(() => {
// //       alert.style.transition = "opacity 0.5s ease";
// //       alert.style.opacity = "0";
// //       setTimeout(() => {
// //         alert.remove();
// //       }, 500);
// //     }, 5000);
// //   }
// // };

// if (elements.successAlert) hideAlert(elements.successAlert);
// if (elements.errorAlert) hideAlert(elements.errorAlert);