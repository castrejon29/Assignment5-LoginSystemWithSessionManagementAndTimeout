-- Create database (if needed)
CREATE DATABASE IF NOT EXISTS login_system;
USE login_system;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

-- Insert sample user
-- Username: admin
-- Password: admin123 (hashed using PASSWORD_HASH)
INSERT INTO users (username, password) VALUES
    ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Note: The password hash above is for 'admin123'
-- In production, always hash passwords using password_hash() in PHP