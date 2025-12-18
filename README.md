# 🏦 D'Bag Bank - Digital Banking Platform

A modern, full-featured digital banking application built with PHP, MySQL, and vanilla JavaScript. D'Bag Bank provides a secure and intuitive platform for users to manage their finances, transfer money, and track transactions.

![PHP](https://img.shields.io/badge/PHP-8.2.12-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat&logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/License-MIT-green.svg)

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Installation](#-installation)
- [Database Setup](#-database-setup)
- [Configuration](#%EF%B8%8F-configuration)
- [Usage](#-usage)
- [Security Features](#-security-features)
- [API Endpoints](#-api-endpoints)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🔐 Authentication System

- **User Registration** with email validation
- **Secure Login** with BCrypt password hashing
- **Session Management** with timeout handling
- **Password Strength Validation**
- **Account Number Generation** (10-digit unique identifiers)

### 💰 Banking Operations

- **Account Balance Management**
  - View current balance
  - Toggle balance visibility
  - Real-time balance updates
- **Money Transfer**
  - Internal transfers between D'Bag Bank users
  - Account name lookup before transfer
  - **Self-transfer prevention** (frontend + backend validation)
  - Amount validation (₦100 - ₦5,000,000 limit)
  - Transaction confirmation modal
  - Real-time balance deduction
- **Transaction History**
  - View all credit/debit transactions
  - Filter by transaction type
  - Transaction status indicators
  - Detailed transaction information

### 🎨 User Interface

- **Responsive Design** - Mobile-first approach
- **Landing Page** with features showcase
- **Dashboard** with quick actions and recent transactions
- **Send Money Flow**
  - Step 1: Account selection with bank dropdown
  - Step 2: Amount entry with quick amount buttons
  - Step 3: Confirmation modal with transaction summary
- **Transaction History Page**
- **Loading States & Animations**
- **Error Handling** with user-friendly messages

### 🔒 Security Features

- SQL injection prevention (prepared statements)
- XSS protection through input sanitization
- CSRF protection via session validation
- Password hashing with BCrypt
- Session-based authentication
- Secure cookie handling
- Balance validation before transfers
- Duplicate prevention for critical operations

---

## 🛠 Tech Stack

### Backend

- **PHP 8.2+** - Server-side logic
- **MySQL 8.0** - Database management
- **PDO** - Database abstraction layer
- **Session Management** - User authentication

### Frontend

- **HTML5** - Semantic markup
- **CSS3** - Modern styling with custom properties
- **Vanilla JavaScript (ES6+)** - Client-side interactivity
- **Fetch API** - Asynchronous HTTP requests

### Tools & Environment

- **XAMPP** - Local development server
- **Apache 2.4** - Web server
- **Git** - Version control
- **VSCode** - Code editor

---

## 📁 Project Structure

```
D'bag_Bank/
├── app/
│   ├── controller/
│   │   └── userController.php      # User CRUD operations
│   └── model/
│       ├── Database.php             # Database connection
│       └── model.php                # Base model with CRUD methods
├── config/
│   ├── functions/
│   │   └── utilities.php           # Helper functions
│   ├── Auth.php                     # Authentication helper
│   ├── autoload.php                 # Class autoloader
│   └── config.php                   # Configuration constants
├── includes/
│   ├── components/
│   │   ├── dash_card.php           # Dashboard balance card
│   │   ├── dash_footer.php         # Dashboard footer
│   │   ├── dash_header.php         # Dashboard header
│   │   ├── dash_trans.php          # Dashboard transactions
│   │   ├── process_login.php       # Login form processor
│   │   ├── process_register.php    # Registration processor
│   │   ├── process_transfer.php    # Transfer processor
│   │   ├── resolve_account.php     # Account lookup API
│   │   ├── send_account.php        # Send money step 1
│   │   ├── send_amount.php         # Send money step 2
│   │   └── send_header.php         # Send page header
│   ├── layout/                      # Layout components
│   ├── check_auth.php              # Authentication middleware
│   └── toggler.php                 # Toggle visibility handler
├── public/
│   ├── favicon.svg                 # Site favicon
│   ├── logo.svg                    # Full logo
│   ├── logo-icon.svg               # Logo icon
│   └── logo-stacked.svg            # Stacked logo
├── src/
│   ├── dash.js                     # Dashboard JavaScript
│   ├── home.css                    # Landing page styles
│   ├── index.css                   # Landing page styles
│   ├── index.js                    # Landing page JavaScript
│   ├── main.js                     # Global JavaScript
│   ├── receipt.css                 # Receipt styles
│   ├── receipt.js                  # Receipt JavaScript
│   ├── send.css                    # Send money styles
│   ├── send.js                     # Send money JavaScript
│   ├── style.css                   # Global styles
│   ├── transactions.css            # Transactions page styles
│   └── transactions.js             # Transactions page JavaScript
├── dashboard.php                   # User dashboard
├── index.php                       # Landing page
├── login.php                       # Login page
├── logout.php                      # Logout handler
├── register.php                    # Registration page
├── send.php                        # Send money page
├── transactions.php                # Transaction history
├── transfer_success.php            # Success page
├── database_updates.sql            # Database migrations
├── TRANSFER_SETUP.md              # Transfer setup guide
└── README.md                       # Project documentation
```

---

## 🚀 Installation

### Prerequisites

- **XAMPP** (or similar LAMP/WAMP stack)
  - PHP 8.2 or higher
  - MySQL 8.0 or higher
  - Apache 2.4 or higher
- **Git** (optional, for cloning)
- Modern web browser

### Step 1: Clone or Download

**Option A: Clone with Git**

```bash
cd C:/xampp/htdocs/php_sandbox
git clone <repository-url> D'bag_Bank
```

**Option B: Manual Download**

1. Download the project files
2. Extract to `C:/xampp/htdocs/php_sandbox/D'bag_Bank`

### Step 2: Start XAMPP

1. Open XAMPP Control Panel
2. Start **Apache** module
3. Start **MySQL** module

### Step 3: Create Database

1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create a new database named `mob_bank`
3. Set collation to `utf8mb4_unicode_ci`

### Step 4: Configure Database Connection

Edit `app/model/Database.php` with your credentials:

```php
private $host = "localhost";
private $user = "your_mysql_username";      // Default: root
private $password = "your_mysql_password";  // Default: (empty)
private $database = "mob_bank";
private $charset = "utf8mb4";
```

---

## 🗄 Database Setup

### Step 1: Create Users Table

Run this SQL in phpMyAdmin:

```sql
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    account_number VARCHAR(10) UNIQUE NOT NULL,
    balance DECIMAL(15, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Step 2: Create Banks Table

```sql
CREATE TABLE IF NOT EXISTS banks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default bank
INSERT INTO banks (code, name) VALUES ('mybank', 'D\'Bag Bank');
```

### Step 3: (Optional) Create Transactions Table

For transaction history tracking:

```sql
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('credit', 'debit') NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    recipient_account VARCHAR(10),
    recipient_name VARCHAR(100),
    sender_account VARCHAR(10),
    sender_name VARCHAR(100),
    bank_code VARCHAR(20),
    description TEXT,
    status ENUM('pending', 'success', 'failed') DEFAULT 'success',
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_timestamp (timestamp)
);
```

### Step 4: Add Test Data (Optional)

```sql
-- Add initial balance to test accounts
UPDATE users SET balance = 50000.00 WHERE id = 1;
UPDATE users SET balance = 25000.00 WHERE id = 2;
```

---

## ⚙️ Configuration

### Base URL Configuration

If your project is not in the root directory, update the fetch URLs in JavaScript files:

**Example: `src/send.js`**

```javascript
// Change this line based on your setup
const url = "/php_sandbox/D'bag_Bank/includes/components/process_transfer.php";

// For root directory:
const url = "/includes/components/process_transfer.php";
```

### Session Configuration

Edit session settings in `config/functions/utilities.php`:

```php
// Session timeout (in seconds)
ini_set('session.gc_maxlifetime', 3600); // 1 hour

// Session cookie lifetime
ini_set('session.cookie_lifetime', 0); // Until browser closes
```

---

## 📖 Usage

### 1. Register a New Account

1. Navigate to: http://localhost/php_sandbox/D'bag_Bank/register.php
2. Fill in the registration form:
   - Full Name
   - Username (3+ characters)
   - Email address
   - Password (min 8 chars, uppercase, number, special char)
3. Click **Register**
4. You'll be redirected to the dashboard with a unique 10-digit account number

### 2. Login

1. Navigate to: http://localhost/php_sandbox/D'bag_Bank/login.php
2. Enter your username and password
3. Click **Login**

### 3. View Dashboard

The dashboard shows:

- **Account Balance** (with hide/show toggle)
- **Account Number** (with copy functionality)
- **Quick Actions** (Send Money, Add Money, Transactions)
- **Recent Transactions** (last 5)

### 4. Send Money

1. Click **Send Money** from dashboard
2. **Step 1: Account Details**
   - Enter recipient's 10-digit account number
   - Select bank from dropdown
   - System automatically fetches recipient name
   - Click **Next** (only enabled after successful verification)
3. **Step 2: Amount Entry**
   - Enter amount (₦100 - ₦5,000,000)
   - Or use quick amount buttons
   - Add optional description
   - Click **Confirm**
4. **Step 3: Confirmation**
   - Review transaction details
   - Click **Proceed** to complete transfer
5. Success page displays with transaction reference

### 5. View Transaction History

1. Click **Transactions** from dashboard or menu
2. View all your transactions with:
   - Transaction type (Credit/Debit)
   - Amount
   - Recipient/Sender details
   - Date and time
   - Status

---

## 🔐 Security Features

### Input Validation & Sanitization

```php
// All user inputs are sanitized
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
```

### Password Security

- **BCrypt hashing** with `PASSWORD_BCRYPT`
- **Minimum requirements**: 8 characters, uppercase, number, special character
- Verification using `password_verify()`

### SQL Injection Prevention

```php
// Prepared statements with PDO
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
```

### Self-Transfer Prevention

```php
// Backend validation
if ($recipient_account === $sender->account_number) {
    echo json_encode(['success' => false, 'message' => 'You cannot transfer to your own account']);
    exit;
}
```

### Session Security

- Session regeneration on login
- Session validation on protected pages
- Automatic timeout handling
- Secure session data storage

---

## 🌐 API Endpoints

### Account Lookup

**Endpoint:** `includes/components/resolve_account.php`  
**Method:** POST  
**Parameters:**

- `account_number` - 10-digit account number
- `bank_code` - Bank code

**Response:**

```json
{
  "success": true,
  "name": "John Doe"
}
```

### Process Transfer

**Endpoint:** `includes/components/process_transfer.php`  
**Method:** POST  
**Parameters:**

- `amount` - Transfer amount
- `recipient_account` - Recipient account number
- `recipient_name` - Recipient name
- `bank_code` - Bank code

**Response:**

```json
{
  "success": true,
  "message": "Transfer successful",
  "new_balance": "45000.00"
}
```

### Toggle Visibility

**Endpoint:** `includes/toggler.php`  
**Method:** GET  
**Parameters:**

- `item` - `balance` or `account_number`

**Response:**

```json
{
  "success": true,
  "hidden": false
}
```

---

## 📸 Screenshots

### Landing Page

Clean and modern landing page with feature highlights

### Dashboard

User dashboard with balance overview and quick actions

### Send Money Flow

Three-step process: Account selection → Amount entry → Confirmation

### Transaction History

Comprehensive view of all transactions with filters

---

## 🐛 Known Issues & Limitations

1. **Single Currency**: Currently supports only Nigerian Naira (₦)
2. **No Email Verification**: Email verification not implemented yet
3. **Internal Transfers Only**: Only supports transfers within D'Bag Bank
4. **Basic Transaction History**: No date range filters or export functionality
5. **No Profile Management**: Users cannot update profile information after registration

---

## 🚧 Future Enhancements

- [ ] Email verification for new accounts
- [ ] Forgot password functionality
- [ ] Two-factor authentication (2FA)
- [ ] External bank transfers
- [ ] Bill payments
- [ ] Transaction export (CSV, PDF)
- [ ] Profile management
- [ ] Account statements
- [ ] Mobile app
- [ ] Push notifications
- [ ] Multi-currency support
- [ ] Recurring transfers
- [ ] Beneficiary management
- [ ] Dark mode

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 for PHP code
- Use meaningful variable and function names
- Comment complex logic
- Test thoroughly before submitting PR

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Your Name**

- GitHub: [@yourusername](https://github.com/yourusername)
- Email: your.email@example.com

---

## 🙏 Acknowledgments

- XAMPP for the local development environment
- Tabler Icons for the beautiful icon set
- Stack Sans Text & Inter fonts from Google Fonts
- The PHP and MySQL communities for excellent documentation

---

## 📞 Support

For support, email your.email@example.com or open an issue in the GitHub repository.

---

## 🔗 Links

- [Documentation](https://github.com/yourusername/dbag-bank/wiki)
- [Bug Reports](https://github.com/yourusername/dbag-bank/issues)
- [Feature Requests](https://github.com/yourusername/dbag-bank/issues)

---

**Made with ❤️ and PHP**
