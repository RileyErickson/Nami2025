<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
//this commit is nothing am just going through the steps again so i dont erase all my changes like I just did
// Include database connection
include_once('database/dbinfo.php');
$conn = connect();

// Ensure the 'minutes_link' table exists
$createMinutesTableQuery = "CREATE TABLE IF NOT EXISTS minutes_link (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date DATE NOT NULL
)";
if (!mysqli_query($conn, $createMinutesTableQuery)) {
    echo "Error creating table: " . mysqli_error($conn);
}
$checkTableExists = 
if (!mysqli_num_rows(mysqli_query($conn, "SHOW TABLES LIKE 'minutes_keywords'"))) {
    $createQuery = "CREATE TABLE minutes_keywords (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        keyword VARCHAR(255) NOT NULL
    )";
    if (!mysqli_query($conn, $createQuery)) {
        die("Error creating keywords table: " . mysqli_error($conn));
    }
}

$message = "";

// Handle link upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['link'])) {
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $linkDate = mysqli_real_escape_string($conn, $_POST['date']);

    // Validate URL
    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        $message = "Invalid URL.";
    } elseif (empty($linkDate)) {
        $message = "Date is required.";
    } else {
        // Check if link or date already exists in database
        $checkQuery = "SELECT * FROM minutes_link WHERE name = '$link' OR date = '$linkDate'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $message = "A link with this URL or date already exists.";
        } else {
            // Insert the link into the database
            $insertQuery = "INSERT INTO minutes_link (name, date) VALUES ('$link', '$linkDate')";
            if (mysqli_query($conn, $insertQuery)) {
                header("Location: editMinutes.php?date=$linkDate");
                exit();
            } else {
                $message = "Error saving record: " . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock | Upload Minutes</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Add Minutes</h1>
        <main>
        <div class="container">
            <h2>Upload Link</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="link" placeholder="Enter URL" required>
                <input type="date" name="date" required>
                <input type="submit" value="Upload Link">
            </form>
            <a class="button cancel" href="minutes.php" style="margin-top: .5rem">Return to Dashboard</a>
        </div>
        <?php if (!empty($message)) : ?>
            <p class="message <?php echo ($message == 'Invalid URL.' || $message == 'Date is required.' || $message == 'A link with this URL or date already exists.') ? 'error' : ''; ?>">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>
        </main>
        <main class="date"></main>
    </body>
    <?php require('footer.php'); ?>
</html>
