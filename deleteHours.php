<?php
// Start session to access stored user information
session_start();

// Enable error reporting for debugging
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
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
        <?php require_once('universal.inc') ?>
        <link rel="stylesheet" href="css/editprofile.css" type="text/css" />
        <title>NAMI Rappahannock | Manage Volunteer Hours</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <?php 
            require_once('header.php'); 
            require_once('include/output.php');
        ?>
    <h1>Manage Volunteer Hours</h1>
    <div class="container">
        <?php foreach ($volunteerHours as $entry) : ?>
            <div class="container" style="margin-top: .5rem">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($entry['date']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($entry['f_name'] . ' ' . $entry['l_name']); ?></p>
                <p><strong>Hours:</strong> <?php echo htmlspecialchars($entry['hours']); ?></p>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="log_id" value="<?php echo $entry['id']; ?>">
                    <button type="submit" name="delete" class="delete-button">Remove</button>
                </form>
            </div>
        <?php endforeach; ?>
        
        <a class="button cancel" href="hours.php" style="margin-top: .5rem">Return to Dashboard</a>
    </div>
</body>
</html>
