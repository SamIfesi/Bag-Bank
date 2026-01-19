-- Create the database (if not using the default 'railway')
CREATE DATABASE IF NOT EXISTS railway;
USE railway;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    account_number VARCHAR(255) DEFAULT NULL,
    balance DECIMAL(11, 2) NOT NULL DEFAULT 0.00,
    card_number VARCHAR(16) DEFAULT NULL,
    card_cvv VARCHAR(3) DEFAULT NULL,
    card_expiry VARCHAR(7) DEFAULT NULL,
    card_status ENUM('none', 'pending', 'active', 'blocked') DEFAULT 'none',
    card_issued_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_of_birth DATE DEFAULT NULL,
    gender ENUM('male', 'female') DEFAULT NULL,
    phone_number VARCHAR(20) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    city VARCHAR(100) DEFAULT NULL,
    state VARCHAR(100) DEFAULT NULL,
    occupation VARCHAR(150) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    user_image VARCHAR(255) DEFAULT NULL,
    UNIQUE KEY unique_card_number (card_number)
);

-- 2. Transactions Table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('credit', 'debit', 'top_up') NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    recipient_name VARCHAR(255) DEFAULT NULL,
    recipient_account VARCHAR(20) DEFAULT NULL,
    sender_account VARCHAR(20) DEFAULT NULL,
    sender_name VARCHAR(100) DEFAULT NULL,
    bank_name VARCHAR(100) DEFAULT NULL,
    bank_code VARCHAR(50) DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    status VARCHAR(20) DEFAULT 'success',
    reference VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Banks Table (For the select dropdown in send.php)
CREATE TABLE IF NOT EXISTS banks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insert some default banks
INSERT INTO banks (id, code, name) VALUES
(1, 'my_bank', 'D\'Bag Bank'),
(2, 'gtbank', 'GTBank'),
(3, 'access', 'Access Bank'),
(4, 'zenith', 'Zenith Bank'),
(5, 'uba', 'UBA'),
(6, 'first', 'First Bank');