<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// Include database connection
include_once('database/dbinfo.php');
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc') ?>
    <title>NAMI Rappahannock | Select Minutes</title>
    <style>
        .date-list {
            width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .date-link {
            display: block;
            padding: 10px;
            margin: 5px 0;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        .date-link:hover {
            background-color: #e9e9e9;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #104C9C;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php require_once('header.php') ?>

    <h1 style="text-align: center;">Select Minutes</h1>

    <div class="date-list">
        <?php
        // Fetch all dates from the minutes_link table
        $query = "SELECT date FROM minutes_link ORDER BY date DESC";
        $result = mysqli_query($conn, $query);

        // Check if there are any dates returned
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $dateFormatted = date("F j, Y", strtotime($row['date']));
                echo '<a href="editMinutes.php?date=' . urlencode($row['date']) . '" class="date-link">' . htmlspecialchars($dateFormatted) . '</a>';
            }
        } else {
            echo '<p>No minutes available to select.</p>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

        <a href="minutes.php" class="back-button">Back to Minutes</a>
    </div>
</body>
</html>
