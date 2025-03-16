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

$searchResults = [];

// Get all records initially
$query = "SELECT * FROM blacklisted";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
}

// Search functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $searchName = mysqli_real_escape_string($conn, $_POST['name']);
    
    if (!empty($searchName)) {
        $query = "SELECT * FROM blacklisted WHERE name LIKE '%$searchName%'";
        $result = mysqli_query($conn, $query);
        
        $searchResults = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
        }
    }
}

// Delete functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $idToDelete = mysqli_real_escape_string($conn, $_POST['id']);
    $deleteQuery = "DELETE FROM blacklisted WHERE id = '$idToDelete'";
    mysqli_query($conn, $deleteQuery);
    header("Location: searchBlacklist.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock | Search Emails</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Generate Email List</h1>
    <a href="blacklist.php" class="button">Back</a>
    <div class="container">
        <h2>Search Blacklist</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name">
            </div>
            <input type="submit" name="search" value="Search">
            <input type="submit" name="clear" value="Clear Search">
        </form>
    </div>
    
    <?php if (!empty($searchResults)) : ?>
        <?php foreach ($searchResults as $result) : ?>
            <div class="container">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($result['name']); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($result['date']); ?></p>
                <p><strong>Reason:</strong> <?php echo htmlspecialchars($result['reason']); ?></p>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                    <input type="submit" name="delete" class="delete-button" value="Remove">
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="container">
            <p>No records found.</p>
        </div>
    <?php endif; ?>
</body>
</html>
