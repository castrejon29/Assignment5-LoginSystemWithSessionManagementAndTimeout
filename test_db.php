<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing Database Connection</h2>";

// Test 1: Check if mysqli extension is loaded
if (extension_loaded('mysqli')) {
    echo "✅ mysqli extension is loaded<br>";
} else {
    echo "❌ mysqli extension is NOT loaded<br>";
    die("Please enable mysqli in php.ini");
}

// Test 2: Try to connect
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'login_system';

echo "<br>Attempting connection with:<br>";
echo "Host: $host<br>";
echo "User: $user<br>";
echo "Password: " . (empty($pass) ? "(empty)" : "(set)") . "<br>";
echo "Database: $db<br><br>";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    echo "❌ Connection Error: " . $conn->connect_error . "<br>";
    echo "Error Code: " . $conn->connect_errno . "<br>";

    // Try alternative host
    echo "<br>Trying 127.0.0.1 instead...<br>";
    $conn2 = new mysqli('127.0.0.1', $user, $pass);
    if ($conn2->connect_error) {
        echo "❌ Also failed with 127.0.0.1<br>";
    } else {
        echo "✅ Connection works with 127.0.0.1! Update config.php to use this.<br>";
    }
} else {
    echo "✅ Connected to MySQL server successfully!<br>";

    // Test 3: Check if database exists
    $result = $conn->query("SHOW DATABASES LIKE '$db'");
    if ($result->num_rows > 0) {
        echo "✅ Database '$db' exists<br>";

        // Test 4: Connect to the database
        $conn->select_db($db);

        // Test 5: Check if users table exists
        $result = $conn->query("SHOW TABLES LIKE 'users'");
        if ($result->num_rows > 0) {
            echo "✅ Table 'users' exists<br>";

            // Test 6: Count users
            $result = $conn->query("SELECT COUNT(*) as count FROM users");
            $row = $result->fetch_assoc();
            echo "✅ Users table has " . $row['count'] . " user(s)<br>";
        } else {
            echo "❌ Table 'users' does NOT exist<br>";
            echo "Run the database_setup.sql file in phpMyAdmin";
        }
    } else {
        echo "❌ Database '$db' does NOT exist<br>";
        echo "Create it in phpMyAdmin first!";
    }
}

$conn->close();
?>