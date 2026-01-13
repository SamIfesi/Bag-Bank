-- Create the database (if not using the default 'railway')
CREATE DATABASE IF NOT EXISTS railway;
USE railway;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    account_number VARCHAR(20) NOT NULL UNIQUE,
    balance DECIMAL(15, 2) DEFAULT 0.00,
    
    -- Profile details
    phone_number VARCHAR(20) DEFAULT NULL,
    gender ENUM('male', 'female', 'other') DEFAULT NULL,
    date_of_birth DATE DEFAULT NULL,
    address TEXT DEFAULT NULL,
    city VARCHAR(50) DEFAULT NULL,
    state VARCHAR(50) DEFAULT NULL,
    occupation VARCHAR(100) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    user_image VARCHAR(255) DEFAULT NULL,
    
    -- Card details
    card_number VARCHAR(20) DEFAULT NULL,
    card_cvv VARCHAR(5) DEFAULT NULL,
    card_expiry VARCHAR(10) DEFAULT NULL,
    card_status ENUM('none', 'active', 'inactive', 'blocked') DEFAULT 'none',
    card_issued_at TIMESTAMP NULL DEFAULT NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Transactions Table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('credit', 'debit', 'top_up') NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    
    -- Sender details (for credit transactions)
    sender_name VARCHAR(100) DEFAULT NULL,
    sender_account VARCHAR(20) DEFAULT NULL,
    
    -- Recipient details (for debit transactions)
    recipient_name VARCHAR(100) DEFAULT NULL,
    recipient_account VARCHAR(20) DEFAULT NULL,
    
    bank_name VARCHAR(100) DEFAULT NULL,
    bank_code VARCHAR(50) DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    status ENUM('pending', 'success', 'failed') DEFAULT 'pending',
    reference VARCHAR(50) NOT NULL UNIQUE,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Banks Table (For the select dropdown in send.php)
CREATE TABLE IF NOT EXISTS banks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some default banks
INSERT INTO banks (name, code) VALUES 
('D\'Bag Bank (Internal)', 'my_bank'),
('Access Bank', '044'),
('GTBank', '058'),
('Zenith Bank', '057'),
('UBA', '033'),
('First Bank', '011'),
('Kuda Bank', '50211'),
('Opay', '999992'),
('PalmPay', '999991');