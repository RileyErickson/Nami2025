<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('database/dbinfo.php');
$conn = connect();

// Get date from URL
$date = $_GET['date'] ?? "";
if (empty($date)) {
    die("Invalid date parameter.");
}
$date = mysqli_real_escape_string($conn, $date);
$formattedDate = date("m-d-Y", strtotime($date));

// Fetch minutes name
$minutesName = "";
$result = mysqli_query($conn, "SELECT name FROM minutes WHERE date = '$date' LIMIT 1");
if ($row = mysqli_fetch_assoc($result)) {
    $minutesName = $row['name'];
}

// Fetch existing keywords
$keywords = [];
$result = mysqli_query($conn, "SELECT * FROM keywords WHERE date = '$date'");
while ($row = mysqli_fetch_assoc($result)) {
    $keywords[] = $row;
}

// Add keyword
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addKeyword'])) {
    $keyword = trim($_POST['keyword']);
    if (!empty($keyword)) {
        $keyword = mysqli_real_escape_string($conn, $keyword);
        mysqli_query($conn, "INSERT INTO keywords (date, keyword) VALUES ('$date', '$keyword')");
        header("Location: editMinutes.php?date=$date");
        exit();
    }
}

// Remove keyword
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteKeyword'])) {
    $keywordId = mysqli_real_escape_string($conn, $_POST['keywordId']);
    mysqli_query($conn, "DELETE FROM keywords WHERE id = '$keywordId'");
    header("Location: editMinutes.php?date=$date");
    exit();
}

// Delete everything associated with the date
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteAll'])) {
    mysqli_query($conn, "DELETE FROM keywords WHERE date = '$date'");
    mysqli_query($conn, "DELETE FROM minutes WHERE date = '$date'");
    header("Location: index.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Minutes</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #add8e6;
            font-family: Arial, sans-serif;
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
        .keyword-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .delete-button {
            background-color: red;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            color: white;
            border-radius: 5px;
        }
        .delete-button:hover {
            background-color: darkred;
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
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #696969;
        }
    </style>
</head>
<body>
    <a href="minutes.php" class="back-button">Back</a>
    <div class="container">
        <h2>Edit Minutes for <?php echo htmlspecialchars($formattedDate); ?></h2>
        <p><strong>Document:</strong> <?php echo htmlspecialchars($minutesName); ?></p>
        
        <!-- Add Keyword -->
        <form method="POST">
            <input type="text" name="keyword" placeholder="Enter new keyword" required>
            <input type="submit" name="addKeyword" value="Add Keyword">
        </form>
        
        <!-- Keyword List -->
        <div class="keyword-list">
            <h3>Keywords</h3>
            <?php foreach ($keywords as $keyword) : ?>
                <div class="keyword-container">
                    <span><?php echo htmlspecialchars($keyword['keyword']); ?></span>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="keywordId" value="<?php echo $keyword['id']; ?>">
                        <input type="submit" name="deleteKeyword" class="delete-button" value="Remove">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Delete Everything -->
        <form method="POST">
            <input type="submit" name="deleteAll" class="delete-button" value="delete these minutes (CANNOT BE UNDONE)">
        </form>
    </div>
</body>
</html>
