<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'header.php';
require_once 'universal.inc';
require_once 'database/dbinfo.php';

$conn = connect();

// Get person ID from URL
$id = isset($_GET['id']) ? trim($_GET['id']) : '';
if ($id === '') {
    die('Error: id parameter required.');
}

// Lookup first and last name
$stmt = $conn->prepare(
    "SELECT first_name, last_name FROM dbpersons WHERE id = ?"
);
$stmt->bind_param('s', $id);
$stmt->execute();
$stmt->bind_result($firstName, $lastName);

if (!$stmt->fetch()) {
    $stmt->close();
    $conn->close();
    die('Error: person not found.');
}
$stmt->close();

// Fetch volunteer hours
$stmt = $conn->prepare(
    "SELECT date, hours
     FROM volunteerHours
     WHERE f_name = ? AND l_name = ?
     ORDER BY date ASC"
);
$stmt->bind_param('ss', $firstName, $lastName);
$stmt->execute();
$result = $stmt->get_result();

$hoursLog = [];
$totalHours = 0;
while ($row = $result->fetch_assoc()) {
    $hoursLog[] = $row;
    $totalHours += $row['hours'];
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Volunteer Hours: <?php echo htmlspecialchars("$firstName $lastName"); ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 700px; margin: 40px auto; padding: 20px; }
        h1 { text-align: center; margin-bottom: 30px; }
        .box { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .total { display: flex; justify-content: space-between; align-items: center;
                  border: 2px solid #ddd; border-radius: 10px; background: #f9f9f9;
                  padding: 10px 20px; max-width: 300px; margin: 0 auto 25px; }
        .total span { font-weight: bold; }
        .entry { background: #fff; padding: 15px; border-radius: 10px;
                  box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 15px; }
        .download { display: block; margin: 30px auto 0; background: #4CAF50;
                     color: #fff; padding: 10px 18px; text-decoration: none;
                     border-radius: 5px; font-size: 15px; text-align: center; }
        .none { text-align: center; font-style: italic; margin-top: 20px; }
        .cancel { display: block; text-align: center; margin-top: .5rem; }
    </style>
</head>
<body>
    <h1>Volunteer Hours: <?php echo htmlspecialchars("$firstName $lastName"); ?></h1>
    <div class="container">
        <div class="box">
            <div class="total">
                <span>Total Hours</span>
                <span><?php echo $totalHours; ?></span>
            </div>

            <?php if (empty($hoursLog)): ?>
                <p class="none">No volunteer hours to display.</p>
            <?php else: ?>
                <?php foreach ($hoursLog as $e): ?>
                    <div class="entry">
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($e['date']); ?></p>
                        <p><strong>Hours:</strong> <?php echo htmlspecialchars($e['hours']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="generateHourReportAdminView.php?id=<?php echo urlencode($id); ?>" target="_blank" class="download">
                Download Report
            </a>
        </div>

        <a href="hours.php" class="cancel">Return to Dashboard</a>
    </div>

    <?php require 'footer.php'; ?>
</body>
</html>
