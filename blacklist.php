<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection if necessary
include_once('database/dbinfo.php');
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc'); ?>
    <title>NAMI Rappahannock | Blacklist Menu</title>
</head>
<body>
    <?php require_once('header.php'); ?>

    <h1>Blacklist</h1>

    <main class="date">
        <div id="dashboard">
            <div class="dashboard-item" onclick="location.href='searchBlacklist.php'">
                <img src="images/person-search.svg" alt="Search Blacklist">
                <span>Search Blacklist</span>
            </div>

            <div class="dashboard-item" onclick="location.href='addBlacklist.php'">
                <img src="images/add-person.svg" alt="Add to Blacklist">
                <span>Add to Blacklist</span>
            </div>

            <div class="dashboard-item" onclick="location.href='index.php'">
                <img src="images/view-calendar.svg" alt="Return Home">
                <span>Return Home</span>
            </div>
        </div>
    </main>

</body>
</html>

<?php mysqli_close($conn); ?>
