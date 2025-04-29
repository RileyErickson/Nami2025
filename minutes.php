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
    <main>
        <div id="dashboard">
    <?php if ($_SESSION['access_level'] >= 2): ?>
            <div class="dashboard-item" onclick="location.href='addMinutes.php'">
                <img src="images/create-report.svg" alt="Add Minutes">
                <span><center>Add Minutes</center></span>
            </div>
            <div class="dashboard-item" onclick="location.href='editMinutes.php'">
                <img src="images/volunteer-history.svg" alt="Edit Minutes">
                <span><center>Edit Minutes</center></span>
            </div>
    <?php endif?>
    <?php if ($_SESSION['access_level'] >= 3): ?>
            <div class="dashboard-item" onclick="location.href='searchMinutes.php'">
                <img src="images/search.svg" alt="Search Minutes">
                <span><center>Search Minutes</center></span>
            </div>
    <?php endif?>
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