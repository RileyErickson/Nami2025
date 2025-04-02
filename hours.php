<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('database/dbinfo.php');
$conn = connect();

// Any additional PHP logic can be added here if needed
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc'); ?>
    <title>NAMI Rappahannock | Hours Management</title>
</head>
<body>
    <?php require_once('header.php'); ?>

    <h1>Hours Management</h1>

    <div id="dashboard">
        <div class="dashboard-item" onclick="location.href='logHours.php'">
            <img src="images/create-report.svg" alt="Log Hours">
            <span>Log Hours</span>
        </div>
        <div class="dashboard-item" onclick="location.href='deleteHours.php'">
            <img src="images/delete.svg" alt="Delete Hours">
            <span>Delete Hours</span>
        </div>
        <div class="dashboard-item" onclick="location.href='approveHours.php'">
            <img src="images/volunteer-history.svg" alt="Approve Hours">
            <span>Approve Hours</span>
        </div>
        <div class="dashboard-item" onclick="location.href='viewHours.php'">
            <img src="images/search.svg" alt="View Hours">
            <span>View Hours</span>
        </div>
        <div class="dashboard-item" onclick="location.href='index.php'">
            <img src="images/logout.svg" alt="Return Home">
            <span>Return Home</span>
        </div>
    </div>

</body>
</html>

<?php mysqli_close($conn); ?>
