-- Migration to add ATM card fields to users table
-- Run this SQL in your database to add card functionality

ALTER TABLE `users` 
ADD COLUMN `card_number` VARCHAR(16) NULL DEFAULT NULL AFTER `balance`,
ADD COLUMN `card_cvv` VARCHAR(3) NULL DEFAULT NULL AFTER `card_number`,
ADD COLUMN `card_expiry` VARCHAR(7) NULL DEFAULT NULL AFTER `card_cvv`,
ADD COLUMN `card_status` ENUM('none', 'pending', 'active', 'blocked') DEFAULT 'none' AFTER `card_expiry`,
ADD COLUMN `card_issued_at` TIMESTAMP NULL DEFAULT NULL AFTER `card_status`,
ADD UNIQUE KEY `unique_card_number` (`card_number`);

-- Note: Run this migration in your phpMyAdmin or MySQL client

-- drop the column in the users table
ALTER TABLE `users` 
DROP COLUMN `card_number`,
DROP COLUMN `card_cvv`,
DROP COLUMN `card_expiry`,
DROP COLUMN `card_status`,
DROP COLUMN `card_issued_at`;

-- Add new profile columns to users table
ALTER TABLE users
ADD COLUMN IF NOT EXISTS date_of_birth DATE,
ADD COLUMN IF NOT EXISTS gender ENUM('male', 'female'),
ADD COLUMN IF NOT EXISTS phone_number VARCHAR(20),
ADD COLUMN IF NOT EXISTS address TEXT,
ADD COLUMN IF NOT EXISTS city VARCHAR(100),
ADD COLUMN IF NOT EXISTS state VARCHAR(100),
ADD COLUMN IF NOT EXISTS occupation VARCHAR(150),
ADD COLUMN IF NOT EXISTS bio TEXT,
ADD COLUMN IF NOT EXISTS user_image VARCHAR(255);

-- Create uploads directory structure (do this manually)
-- public/uploads/profiles/

-- Modify transactions table to include 'top_up' type
ALTER TABLE `transactions` 
MODIFY COLUMN `type` ENUM('credit', 'debit', 'top_up') NOT NULL;