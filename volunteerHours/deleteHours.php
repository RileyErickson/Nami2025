<?php
// Start session to access stored user information
session_start();

// Enable error reporting for debugging
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
require_once('../database/dbinfo.php');
$conn = connect();

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $log_id = intval($_POST['log_id']);
    $deleteQuery = "DELETE FROM volunteerHours WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $log_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manageVolunteerHours.php");
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
    <title>Manage Volunteer Hours</title>
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
            position: relative;
        }
        .delete-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
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
        <h2>Manage Volunteer Hours</h2>
        <?php foreach ($volunteerHours as $entry) : ?>
            <div class="log-container">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($entry['date']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($entry['f_name'] . ' ' . $entry['l_name']); ?></p>
                <p><strong>Hours:</strong> <?php echo htmlspecialchars($entry['hours']); ?></p>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="log_id" value="<?php echo $entry['id']; ?>">
                    <button type="submit" name="delete" class="delete-button">Remove</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
