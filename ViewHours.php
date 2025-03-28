<?php
// Start session to access stored user information
session_start();

// Enable error reporting for debugging
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
require_once('database/dbinfo.php');
$conn = connect();

// Fetch all volunteer hours
$query = "SELECT f_name, l_name, date, hours FROM volunteerHours ORDER BY l_name, f_name, date ASC";
$result = mysqli_query($conn, $query);
$volunteerHours = [];
$totalHours = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $volunteerHours[] = $row;
    $totalHours += $row['hours'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
        <?php require_once('universal.inc') ?>
        <link rel="stylesheet" href="css/editprofile.css" type="text/css" />
        <title>NAMI Rappahannock | View Hours</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <?php 
            require_once('header.php'); 
            require_once('include/output.php');
        ?>
    <h1>Volunteer Hours</h1>
    <div class="container">

        <h3>Total Hours: <?php echo $totalHours; ?></h3>
        <?php foreach ($volunteerHours as $entry) : ?>
            <div class="container" style="margin-top: .5rem">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($entry['date']); ?></p>
                <p><strong>Hours:</strong> <?php echo htmlspecialchars($entry['hours']); ?></p>
            </div>
        <?php endforeach; ?>
        
        <a class="button cancel" href="hours.php" style="margin-top: .5rem">Return to Dashboard</a>
        
    </div>
</body>
</html>
