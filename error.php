<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .error-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        h1 {
            color: #dc3545;
            margin-bottom: 15px;
            font-size: 28px;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .error-details {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="error-icon">🚫</div>
    <h1>Login Failed</h1>

    <div class="error-details">
        Invalid username or password
    </div>

    <p>
        The credentials you entered are incorrect. Please check your username
        and password and try again.
    </p>

    <a href="login.php" class="btn">↩️ Back to Login</a>
</div>
</body>
</html>
