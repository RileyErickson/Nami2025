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
    <title>NAMI Rappahannock | Form Management</title>
</head>
<body>
    <?php require_once('header.php'); ?>

    <h1>Form Management</h1>
    <main class="dashboard">
    <div id="dashboard">
        <div class="dashboard-item" data-link="viewForms.php">
            <img src="images/account.png"></img>
            <span><center>View Forms</center></span>
        </div>
        <div class="dashboard-item" data-link="formSearch.php">
            <img src="images/emailList.png">
            <span><center>Search Forms</center></span>
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
