const id = (id) => document.getElementById(id);
const qa = (s) => document.querySelectorAll(s);

const elements = {
  chatMessages: id("chatMessages"),
  chatForm: id("chatForm"),
  messageInput: id("messageInput"),
  sendBtn: id("sendBtn"),
  charCounter: id("charCounter"),
  typingIndicator: id("typingIndicator"),
  suggestedActions: id("suggestedActions"),
  clearChatBtn: id("clearChatBtn"),
  menuBtn: id("menuBtn"),
  quickMenu: id("quickMenu"),
  menuOverlay: id("menuOverlay"),
  menuItems: qa(".menu-item"),
  notificationBanner: id("notificationBanner"),
  bannerMessage: id("bannerMessage"),
  bannerClose: id("bannerClose"),
  confirmationModal: id("confirmationModal"),
  modalOverlay: id("modalOverlay"),
  modalTitle: id("modalTitle"),
  modalMessage: id("modalMessage"),
  modalConfirm: id("modalConfirm"),
  modalCancel: id("modalCancel"),
  modalClose: id("modalClose"),
};

elements.menuItems.forEach((item) => {
  item.addEventListener("click", () => {
    const action = item.getAttribute("data-action");
    if (action === "clear-chat") {
      elements.clearChatBtn.click();
    }
  });
});

elements.menuBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  elements.quickMenu.classList.toggle("hide");
});
elements.menuOverlay.addEventListener("click", () => {
  elements.quickMenu.classList.add("hide");
});

// 1. Auto-resize textarea
elements.messageInput.addEventListener("input", function () {
  this.style.height = "auto";
  this.style.height = this.scrollHeight + "px";
  elements.charCounter.textContent = `${this.value.length}/1000`;
  elements.sendBtn.disabled = this.value.trim().length === 0;
});

// 2. Suggestion Chips Logic
const suggestionChips = qa(".suggestion-chip");
suggestionChips.forEach((chip) => {
  chip.addEventListener("click", function () {
    const message = this.getAttribute("data-message");
    elements.messageInput.value = message;
    elements.messageInput.dispatchEvent(new Event("input"));
    elements.chatForm.dispatchEvent(new Event("submit"));
  });
});

// 3. MAIN SEND FUNCTION
elements.chatForm.addEventListener("submit", async function (e) {
  e.preventDefault();
  const message = elements.messageInput.value.trim();
  if (!message) return;

  // Add User Message
  addMessage("user", message, getCurrentTime());

  elements.messageInput.value = "";
  elements.messageInput.style.height = "auto";
  elements.charCounter.textContent = "0/1000";
  elements.sendBtn.disabled = true;

  // Hide suggestions
  if (elements.suggestedActions)
    elements.suggestedActions.classList.add("hide");

  showTypingIndicator();
  scrollToBottom();

  try {
    const response = await fetch("../app/handlers/process_ai_chat.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message: message }),
    });

    // Handle non-JSON responses gracefully
    const text = await response.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (err) {
      console.error("Server Raw Response:", text);
      throw new Error("Server returned invalid JSON");
    }

    removeTypingIndicator();

    if (data.success) {
      addMessage("bot", data.message, data.timestamp);
    } else {
      addMessage(
        "bot",
        "My connection is a bit fuzzy. Can you say that again?",
        getCurrentTime()
      );
    }
  } catch (error) {
    console.error(error);
    removeTypingIndicator();
    addMessage(
      "bot",
      "Oops! I'm having trouble connecting to the server. Please check your internet.",
      getCurrentTime()
    );
  }
});

// 4. UI Helper Functions
function addMessage(type, text, time, skipSave = false) {
  const group = document.createElement("div");
  group.className = `message-group ${type}`;

  // Avatar for bot
  const avatar =
    type === "bot"
      ? `<div class="message-avatar"><i class="ti ti-sparkles"></i></div>`
      : "";
  const formattedText = formatText(text);

  group.innerHTML = `
    ${type === "bot" ? avatar : ""}
    <div class="message-wrapper">
      <div class="message ${type}">
        <div class="message-content">${formattedText}</div>
        <span class="message-time">${time}</span>
      </div>
    </div>
  `;

  elements.chatMessages.appendChild(group);
  scrollToBottom();

  if (!skipSave) {
    saveChat(type, text, time);
  }
}

function scrollToBottom() {
  setTimeout(() => {
    elements.chatMessages.scrollTop = elements.chatMessages.scrollHeight;
  }, 100);
}

function showTypingIndicator() {
  removeTypingIndicator();

  const group = document.createElement("div");
  group.className = "message-group bot";
  group.id = "typingIndicatorMessage";

  group.innerHTML = `
    <div class="message-avatar"><i class="ti ti-sparkles"></i></div>
    <div class="typing-dots">
        <span></span>
        <span></span>
        <span></span>
    </div>
  `;

  elements.chatMessages.appendChild(group);
  scrollToBottom();
}

function removeTypingIndicator() {
  const indicator = document.getElementById("typingIndicatorMessage");
  if (indicator) {
    indicator.remove();
  }
}

function getCurrentTime() {
  return new Date().toLocaleTimeString("en-US", {
    hour: "numeric",
    minute: "2-digit",
    hour12: true,
  });
}

function saveChat(type, text, time) {
  const history = JSON.parse(sessionStorage.getItem("chatHistory") || "[]");
  history.push({ type, text, time });
  sessionStorage.setItem("chatHistory", JSON.stringify(history));
}

function loadChat() {
  const history = JSON.parse(sessionStorage.getItem("chatHistory") || "[]");
  history.forEach((msg) => addMessage(msg.type, msg.text, msg.time, true));
  if (history.length > 0 && elements.suggestedActions)
    elements.suggestedActions.classList.add("hide");
}

elements.clearChatBtn.addEventListener("click", () => {
  showConfirmationModal(
    "Clear Chat?",
    "All messages will be deleted. This action cannot be undone.",
    () => {
      sessionStorage.removeItem("chatHistory");
      showBanner("Chat cleared successfully", "success", 3000);
      location.reload();
    }
  );
});

function formatText(text) {
  let formatted = text.replace(/\*\*(.*?)\*\*/g, "<b>$1</b>");
  formatted = formatted.replace(/\*(.*?)\*/g, "<i>$1</i>");
  formatted = formatted.replace(/\n/g, "<br>");
  return formatted;
}

// ===== NOTIFICATION BANNER FUNCTIONS =====
function showBanner(message, type = "success", duration = 5000) {
  elements.bannerMessage.textContent = message;
  elements.notificationBanner.classList.remove("hide");

  // Auto-hide after duration
  if (duration > 0) {
    setTimeout(() => hideBanner(), duration);
  }
}

function hideBanner() {
  elements.notificationBanner.classList.add("hide");
}

elements.bannerClose.addEventListener("click", hideBanner);

// ===== CONFIRMATION MODAL FUNCTIONS =====
let confirmCallback = null;

function showConfirmationModal(title, message, onConfirm) {
  elements.modalTitle.textContent = title;
  elements.modalMessage.textContent = message;
  confirmCallback = onConfirm;
  elements.confirmationModal.classList.remove("hide");
}

function hideConfirmationModal() {
  elements.confirmationModal.classList.add("hide");
  confirmCallback = null;
}

elements.modalConfirm.addEventListener("click", () => {
  if (confirmCallback) {
    confirmCallback();
  }
  hideConfirmationModal();
});

elements.modalCancel.addEventListener("click", hideConfirmationModal);
elements.modalClose.addEventListener("click", hideConfirmationModal);
elements.modalOverlay.addEventListener("click", hideConfirmationModal);

loadChat();
scrollToBottom();
