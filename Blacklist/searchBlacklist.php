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
include_once('../database/dbinfo.php');

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
    <title>Search Blacklist</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            background-color: #add8e6;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"], .delete-button {
            background-color: #808080;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"]:hover, .delete-button:hover {
            background-color: #696969;
        }
        .delete-button {
            background-color: red;
            margin-left: 10px;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #808080;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #696969;
        }
    </style>
</head>
<body>
    <a href="blacklist.php" class="back-button">Back</a>
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
