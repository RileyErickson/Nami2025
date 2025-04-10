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
    <main>
    <div id="dashboard">
        <div class="dashboard-item" onclick="location.href='logHours.php'">
            <img src="images/create-report.svg" alt="Log Hours">
            <span><center>Log Hours</center></span>
        </div>
        <div class="dashboard-item" onclick="location.href='deleteHours.php'">
            <img src="images/delete.svg" alt="Delete Hours">
            <span><center>Delete Hours</center></span>
        </div>
        <div class="dashboard-item" onclick="location.href='approveHours.php'">
            <img src="images/volunteer-history.svg" alt="Approve Hours">
            <span><center>Approve Hours</center></span>
        </div>
        <div class="dashboard-item" onclick="location.href='viewHours.php'">
            <img src="images/search.svg" alt="View Hours">
            <span><center>View Hours</center></span>
        </div>
        <div style="flex-basis: 100%; height: 0;"></div>
        <div class="dashboard-item" onclick="location.href='index.php'" style="background-color: grey;">
            <img src="images/logout.svg" alt="Return Home">
            <span><center>Return to Home Dashboard</center></span>
        </div>

    </div>
    </main>
</body>
<?php require('footer.php'); ?>
</html>

<?php mysqli_close($conn); ?>
