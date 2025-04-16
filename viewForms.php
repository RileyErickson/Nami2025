<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('database/dbinfo.php');
$conn = connect();

// Fetch all unique keywords for sidebar
$formQuery = "SELECT DISTINCT application FROM dbformmanagement ORDER BY application ASC";
$formResult = mysqli_query($conn, $formQuery);
while ($row = mysqli_fetch_assoc($formResult)) {
    $applications[] = $row['application'];
}


$result = mysqli_query($conn, $formQuery);
while ($row = mysqli_fetch_assoc($result)) {
    $formResults[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <?php require_once('universal.inc') ?>
    <style>
        #sidebar {
            width: 200px;
            float: left;
        }

        #content {
            margin-left: 10%;
            margin-right: 10%;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require_once('header.php') ?>
    <h1>Forms</h1>
    <div id="content">
        <div class="container">
            <h3>Form List:</h3>
        </div>
    </div>
</body>
<?php require('footer.php'); ?>
</html>