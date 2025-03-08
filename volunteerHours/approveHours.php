<?php
// Start session to access stored user information
session_start();

// Enable error reporting for debugging
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
require_once('../database/dbinfo.php');
$conn = connect();

// Ensure the 'volunteerHours' table exists
$createTableQuery = "CREATE TABLE IF NOT EXISTS volunteerHours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    f_name VARCHAR(255) NOT NULL,
    l_name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    hours INT NOT NULL
)";

if (!mysqli_query($conn, $createTableQuery)) {
    die("Error creating table: " . mysqli_error($conn));
}

// Handle approval and denial
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $log_id = intval($_POST['log_id']);
    
    if (isset($_POST['approve'])) {
        // Fetch pending log details
        $fetchQuery = "SELECT * FROM pendingHourLogs WHERE id = ?";
        $stmt = $conn->prepare($fetchQuery);
        $stmt->bind_param("i", $log_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $log = $result->fetch_assoc();
        $stmt->close();
        
        if ($log) {
            // Insert approved hours into volunteerHours
            $insertQuery = "INSERT INTO volunteerHours (f_name, l_name, date, hours) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssi", $log['first_name'], $log['last_name'], $log['date'], $log['hours']);
            $stmt->execute();
            $stmt->close();
            
            // Remove the log from pendingHourLogs
            $deleteQuery = "DELETE FROM pendingHourLogs WHERE id = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("i", $log_id);
            $stmt->execute();
            $stmt->close();
        }
        
        header("Location: approveHours.php");
        exit();
    }
    
    if (isset($_POST['deny'])) {
        $deleteQuery = "DELETE FROM pendingHourLogs WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $log_id);
        $stmt->execute();
        $stmt->close();
        header("Location: approveHours.php");
        exit();
    }
}

// Fetch all pending hour logs
$query = "SELECT * FROM pendingHourLogs ORDER BY date DESC";
$result = mysqli_query($conn, $query);
$pendingLogs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pendingLogs[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Volunteer Hours</title>
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
        .button {
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .approve-button {
            background-color: green;
            color: white;
        }
        .deny-button {
            background-color: red;
            color: white;
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
        <h2>Approve Volunteer Hours</h2>
        <?php foreach ($pendingLogs as $log) : ?>
            <div class="log-container">
                <p><strong><?php echo htmlspecialchars($log['first_name'] . ' ' . $log['last_name']); ?></strong></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($log['date']); ?></p>
                <p><strong>Hours:</strong> <?php echo htmlspecialchars($log['hours']); ?></p>
                <div class="log-description">                    
                    <p><strong>What:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($log['what'])); ?></p>
                </div>
                <form method="POST">
                    <input type="hidden" name="log_id" value="<?php echo $log['id']; ?>">
                    <button type="submit" name="approve" class="button approve-button">Approve</button>
                    <button type="submit" name="deny" class="button deny-button">Deny</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
