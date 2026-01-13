-- =====================================================
-- MIGRATION: Initial Schema
-- Description: Creates the company_db and its tables.
-- =====================================================

-- =====================================================
-- 1️⃣ Database Setup
-- =====================================================
-- Create the database with UTF-8 support for special characters
CREATE DATABASE IF NOT EXISTS company_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Switch to the newly created database
USE company_db;

-- =====================================================
-- 2️⃣ Employees Table
-- =====================================================
-- Note: 'id' is UNSIGNED to double the positive range.
-- 'uuid' is indexed for fast lookups.
CREATE TABLE IF NOT EXISTS employees (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL,
    name VARCHAR(100) NOT NULL,
    age TINYINT UNSIGNED NOT NULL,
    job VARCHAR(100) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    admission_date DATE NOT NULL,
    UNIQUE KEY uk_employees_uuid (uuid),
    KEY idx_employees_job (job),
    KEY idx_employees_admission_date (admission_date)
) ENGINE=InnoDB;

-- =====================================================
-- 3️⃣ Projects Table
-- =====================================================
-- This table depends on 'employees' via employee_id.
-- ON DELETE CASCADE ensures if an employee is deleted, their projects are too.
CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL,
    employee_id INT UNSIGNED NOT NULL,
    description VARCHAR(255) NOT NULL,
    value DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    delivery_date DATE NOT NULL,
    UNIQUE KEY uk_projects_uuid (uuid),
    KEY idx_projects_status (status),
    KEY idx_projects_delivery_date (delivery_date),
    KEY idx_projects_employee (employee_id),
    CONSTRAINT fk_projects_employee
        FOREIGN KEY (employee_id)
        REFERENCES employees(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;
