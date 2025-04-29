<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('database/dbinfo.php');
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc'); ?>
    <title>NAMI Rappahannock | Email Management</title>
</head>
<body>
    <?php require_once('header.php'); ?>

    <h1>Email Management</h1>
    <main>
        <div id="dashboard">
            <?php if ($_SESSION['access_level'] >= 2): ?>
                <div class="dashboard-item" onclick="location.href='sendMessages.php'">
                    <img src="images/emailsend.svg" alt="Send Email">
                    <span><center>Send Email</center></span>
                </div>
                <div class="dashboard-item" onclick="location.href='emailList.php'">
                    <img src="images/search.svg" alt="List Emails">
                    <span><center>List Emails</center></span>
                </div>
                <div style="flex-basis: 100%; height: 0;"></div>
                <div class="dashboard-item" onclick="location.href='index.php'" style="background-color: grey;">
                    <img src="images/logout.svg" alt="Return Home">
                    <span><center>Return to Home Dashboard</center></span>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php require('footer.php'); ?>
</body>
</html>
