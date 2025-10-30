<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check for session timeout
if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    if ($inactive_time > SESSION_TIMEOUT) {
        // Session has expired
        session_unset();
        session_destroy();
        header('Location: login.php?timeout=1');
        exit();
    }
}

// Update last activity time
$_SESSION['last_activity'] = time();

// Calculate remaining time
$remaining_time = SESSION_TIMEOUT - (time() - $_SESSION['last_activity']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            padding: 20px;
        }

        .admin-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 32px;
        }

        .welcome-message {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .info-panel {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .info-item {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #333;
        }

        .info-value {
            color: #666;
        }

        .timer-panel {
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #ffc107;
            text-align: center;
        }

        .timer-text {
            font-size: 16px;
            color: #856404;
            margin-bottom: 10px;
        }

        #countdown {
            font-size: 36px;
            font-weight: bold;
            color: #d39e00;
            font-family: 'Courier New', monospace;
        }

        .button-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-logout {
            background: #dc3545;
            color: white;
        }

        .btn-action {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .warning {
            color: #dc3545;
            font-weight: 600;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body>
<div class="admin-container">
    <h1>👋 Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p class="welcome-message">You have successfully logged into the admin dashboard.</p>

    <div class="info-panel">
        <div class="info-item">
            <span class="info-label">User ID:</span>
            <span class="info-value"><?php echo htmlspecialchars($_SESSION['user_id']); ?></span>
        </div>
        <div class="info-item">
            <span class="info-label">Username:</span>
            <span class="info-value"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <div class="info-item">
            <span class="info-label">Session Status:</span>
            <span class="info-value">Active</span>
        </div>
    </div>

    <div class="timer-panel">
        <p class="timer-text">⏱️ Auto-logout Timer</p>
        <div id="countdown">01:00</div>
        <p class="timer-text" style="margin-top: 10px; font-size: 14px;">
            Session will expire after 1 minute of inactivity
        </p>
    </div>

    <div class="button-group">
        <a href="logout.php" class="btn btn-logout">🚪 Logout</a>
        <button onclick="resetTimer()" class="btn btn-action">🔄 Reset Timer</button>
    </div>
</div>

<script>
    let timeLeft = <?php echo $remaining_time; ?>;
    let countdownTimer;

    function updateCountdown() {
        if (timeLeft <= 0) {
            clearInterval(countdownTimer);
            document.getElementById('countdown').innerHTML = '<span class="warning">EXPIRED</span>';
            setTimeout(() => {
                window.location.href = 'logout.php';
            }, 1000);
            return;
        }

        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('countdown').textContent =
            `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (timeLeft <= 10) {
            document.getElementById('countdown').classList.add('warning');
        }

        timeLeft--;
    }

    function resetTimer() {
        // Make an AJAX request to reset the session timer
        fetch('admin.php')
            .then(() => {
                timeLeft = <?php echo SESSION_TIMEOUT; ?>;
                document.getElementById('countdown').classList.remove('warning');
                updateCountdown();
            });
    }

    // Start the countdown
    updateCountdown();
    countdownTimer = setInterval(updateCountdown, 1000);

    // Reset timer on any user activity
    let activityEvents = ['mousedown', 'keypress', 'scroll', 'touchstart'];
    activityEvents.forEach(event => {
        document.addEventListener(event, () => {
            if (timeLeft > 0 && timeLeft < <?php echo SESSION_TIMEOUT; ?>) {
                resetTimer();
            }
        }, { once: false, passive: true });
    });
</script>
</body>
</html>