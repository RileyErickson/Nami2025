<?php

session_start();

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once('header.php');
require_once('universal.inc');
require_once('database/dbinfo.php');


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
    <title>NAMI Rappahannock | Approve Volunteer Hours</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .log-container {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .log-container p {
            margin: 5px 0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .approve-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .deny-button {
            background-color: #e53935;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .no-logs {
            text-align: center;
            font-style: italic;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Approve Volunteer Hours</h1>

        <?php if (empty($pendingLogs)) : ?>
            <p class="no-logs">No pending logs to review.</p>
        <?php else : ?>
            <?php foreach ($pendingLogs as $log) : ?>
                <div class="log-container">
                    <p><strong><?php echo htmlspecialchars($log['first_name'] . ' ' . $log['last_name']); ?></strong></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($log['date']); ?></p>
                    <p><strong>Hours:</strong> <?php echo htmlspecialchars($log['hours']); ?></p>
                    <p><strong>What:</strong><br><?php echo nl2br(htmlspecialchars($log['what'])); ?></p>

                    <form method="POST" class="action-buttons">
                        <input type="hidden" name="log_id" value="<?php echo $log['id']; ?>">
                        <button type="submit" name="approve" class="approve-button">Approve</button>
                        <button type="submit" name="deny" class="deny-button">Deny</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

       <a class="button cancel" href="hours.php" style="margin-top: .5rem">Return to Dashboard</a>
    </div>
</body>
</html>
