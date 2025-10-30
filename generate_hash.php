<?php
/**
 * Password Hash Generator Utility
 * Use this file to generate password hashes for your database
 *
 * IMPORTANT: Delete this file after setting up your users!
 */

// Change this to the password you want to hash
$password = 'admin123';

// Generate hash
$hash = password_hash($password, PASSWORD_DEFAULT);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .hash-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            margin: 20px 0;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            color: #856404;
            margin-top: 20px;
        }
        code {
            background: #e9ecef;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🔐 Password Hash Generator</h1>

    <p><strong>Password:</strong> <?php echo htmlspecialchars($password); ?></p>

    <p><strong>Generated Hash:</strong></p>
    <div class="hash-box">
        <?php echo $hash; ?>
    </div>

    <p><strong>SQL Insert Example:</strong></p>
    <div class="hash-box">
        INSERT INTO users (username, password) VALUES ('admin', '<?php echo $hash; ?>');
    </div>

    <div class="warning">
        <strong>⚠️ Security Warning:</strong><br>
        Delete this file (<code>generate_hash.php</code>) after generating your password hashes!
        This file should not be accessible on a production server.
    </div>
</div>
</body>
</html>
