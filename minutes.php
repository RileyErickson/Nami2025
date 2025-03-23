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
    <title>NAMI Rappahannock | Minutes Management</title>
</head>
<body>
    <?php require_once('header.php'); ?>

    <h1>Minutes Management</h1>

    <div id="dashboard">
        <div class="dashboard-item" onclick="location.href='addMinutes.php'">
            <img src="images/create-report.svg" alt="Add Minutes">
            <span>Add Minutes</span>
        </div>
        <div class="dashboard-item" onclick="location.href='editMinutes.php'">
            <img src="images/volunteer-history.svg" alt="Edit Minutes">
            <span>Edit Minutes</span>
        </div>
        <div class="dashboard-item" onclick="location.href='searchMinutes.php'">
            <img src="images/search.svg" alt="Search Minutes">
            <span>Search Minutes</span>
        </div>
        <div class="dashboard-item" onclick="location.href='index.php'">
            <img src="images/logout.svg" alt="Return Home">
            <span>Return Home</span>
        </div>
    </div>

</body>
</html>

<?php mysqli_close($conn); ?>