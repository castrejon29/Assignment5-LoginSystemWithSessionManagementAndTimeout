<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
define('DB_HOST', 'localhost');     // Try '127.0.0.1' if localhost doesn't work
define('DB_USER', 'root');          // Default XAMPP username
define('DB_PASS', '');              // Default XAMPP password is empty
define('DB_NAME', 'login_system');  // Your database name

// Session timeout in seconds (1 minute = 60 seconds)
define('SESSION_TIMEOUT', 60);

// Create database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        // More detailed error for debugging
        die("Database Connection Failed: " . $conn->connect_error . "<br>Error Code: " . $conn->connect_errno);
    }

    return $conn;
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>