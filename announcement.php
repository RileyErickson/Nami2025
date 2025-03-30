<?php
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Handle Clear Announcement
if (isset($_POST['clear_announcement'])) {
    if (file_exists('announcement.txt')) {
        unlink('announcement.txt');
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle Add Announcement
if (isset($_POST['add_announcement'])) {
    $announcement = trim($_POST['announcement_text'] ?? '');
    if (!empty($announcement)) {
        if (file_exists('announcement.txt')) {
            unlink('announcement.txt');
        }
        file_put_contents('announcement.txt', $announcement);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Announcement cannot be empty.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc'); ?>
    <title>NAMI Rappahannock | Announcement</title>
    <style>
        .dashboard {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            padding: 30px;
        }

        .announcement-container {
            background: #f1f1f1;
            border: 2px solid #ccc;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
        }

        .announcement-container h2 {
            margin-top: 0;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-top: 10px;
            resize: vertical;
        }

        button {
            margin-top: 10px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php require_once('header.php'); ?>
    <h1>Announcement</h1>

    <main class="dashboard">
        <!-- Add Announcement Container -->
        <div class="announcement-container">
            <form method="post">
                <h2>Add Announcement</h2>
                <label for="announcement_text">Enter your message:</label>
                <textarea id="announcement_text" name="announcement_text" required></textarea><br>
                <button type="submit" name="add_announcement">Add Announcement</button>

                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
            </form>
        </div>

        <!-- Clear Announcement Container -->
        <div class="announcement-container">
            <form method="post" onsubmit="return confirm('Are you sure you want to delete the current announcement?');">
                <h2>Clear Announcement</h2>
                <p>This will permanently delete the current announcement.</p>
                <button type="submit" name="clear_announcement">Clear Announcement</button>
            </form>
        </div>
    </main>
</body>
</html>
