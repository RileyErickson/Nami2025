<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Default values
$loggedIn = false;
$accessLevel = 0;
$userID = null;

// Check if user is logged in
if (isset($_SESSION['_id'])) {
    $loggedIn = true;
    $accessLevel = $_SESSION['access_level'];
    $userID = $_SESSION['_id'];
}

// Require admin privileges
if ($accessLevel < 2) {
    header('Location: login.php');
    die();
}

// Include database connection
include_once('database/dbinfo.php');

// Connect to database
$conn = connect();

// Create 'blacklisted' table if it does not exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS blacklisted (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    reason TEXT NOT NULL
)";

if (!mysqli_query($conn, $createTableQuery)) {
    echo "Error creating table: " . mysqli_error($conn);
}

$successMessage = "";

// Add a new blacklisted person
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    if (!empty($name) && !empty($date) && !empty($reason)) {
        $insertQuery = "INSERT INTO blacklisted (name, date, reason) VALUES ('$name', '$date', '$reason')";
        
        if (mysqli_query($conn, $insertQuery)) {
            $successMessage = "Successfully added $name to the blacklist.";
        } else {
            $successMessage = "Error adding to blacklist: " . mysqli_error($conn);
        }
    } else {
        $successMessage = "All fields are required.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock | Add Blacklist</title>
       
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Add to Blacklist</h1>
    <div class="container">
        <h2>Add New Blacklisted Person</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" required>
            </div>
            
            <div class="form-group">
                <label for="reason">Reason:</label>
                <textarea name="reason" required></textarea>
            </div>
            
            <input type="submit" value="Blacklist">
        </form>
        
    <a class="button cancel" href="blacklist.php" style="margin-top: .5rem">Return to Dashboard</a>; 
    </div>
    
    <?php if (!empty($successMessage)) : ?>
        <div class="success-message"> <?php echo $successMessage; ?> </div>
    <?php endif; ?>
</body>
</html>
