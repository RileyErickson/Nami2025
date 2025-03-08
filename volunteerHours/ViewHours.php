<?php
// Start session to access stored user information
session_start();

// Enable error reporting for debugging
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
require_once('../database/dbinfo.php');
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
    <title>Volunteer Hours</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #add8e6;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
            margin-bottom: 20px;
        }
        .log-container {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            text-align: left;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #808080;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <a href="../index.php" class="back-button">Back</a>
    <div class="container">
        <h2>Volunteer Hours</h2>
        <h3>Total Hours: <?php echo $totalHours; ?></h3>
        <?php foreach ($volunteerHours as $entry) : ?>
            <div class="log-container">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($entry['date']); ?></p>
                <p><strong>Hours:</strong> <?php echo htmlspecialchars($entry['hours']); ?></p>
            </div>
        <?php endforeach; ?>
        
    </div>
</body>
</html>
