<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

// Get form data
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Validate input
if (empty($username) || empty($password)) {
    header('Location: error.php');
    exit();
}

// Get database connection
$conn = getDBConnection();

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Password is correct - create session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['last_activity'] = time();

        // Close connection
        $stmt->close();
        $conn->close();

        // Redirect to admin page
        header('Location: admin.php');
        exit();
    }
}

// Login failed - close connection and redirect to error
$stmt->close();
$conn->close();
header('Location: error.php');
exit();
?>
