<?php

session_start();

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once('header.php');
require_once('universal.inc');
require_once('database/dbinfo.php');


$conn = connect();

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $log_id = intval($_POST['log_id']);
    $deleteQuery = "DELETE FROM volunteerHours WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $log_id);
    $stmt->execute();
    $stmt->close();

    header("Location: hours.php");
    exit();
}

// Fetch all volunteer hours, sorted by date (most recent first), then by first name alphabetically

$query = "SELECT id, f_name, l_name, date, hours FROM volunteerHours ORDER BY date DESC, f_name ASC";
$result = mysqli_query($conn, $query);
$volunteerHours = [];
while ($row = mysqli_fetch_assoc($result)) {
    $volunteerHours[] = $row;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>NAMI Rappahannock | Manage Volunteer Hours</title>
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
            margin-bottom: 15px;
        }

        .log-container p {
            margin: 5px 0;
        }

        .delete-button {
            background-color: #e53935;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
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
        <h1>Manage Volunteer Hours</h1>

        <?php if (empty($volunteerHours)) : ?>
            <p class="no-logs">No volunteer hour logs available.</p>
        <?php else : ?>
            <?php foreach ($volunteerHours as $entry) : ?>
                <div class="log-container">
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($entry['date']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($entry['f_name'] . ' ' . $entry['l_name']); ?></p>
                    <p><strong>Hours:</strong> <?php echo htmlspecialchars($entry['hours']); ?></p>
                    <form method="POST">
                        <input type="hidden" name="log_id" value="<?php echo $entry['id']; ?>">
                        <button type="submit" name="delete" class="delete-button">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <a class="button cancel" href="hours.php" style="margin-top: .5rem">Return to Dashboard</a>
    </div>
</body>
</html>
