<?php

session_cache_expire(30);
    session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);


require_once('database/dbinfo.php');
//require_once('database/dbpersons.php');
require_once('domain/Person.php');

$conn = connect();

// Fetch all volunteer hours
 
$query = "
  SELECT vh.f_name,
         vh.l_name,
         vh.date,
         vh.hours
  FROM volunteerHours AS vh
  JOIN dbpersons   AS dp
    ON vh.f_name = dp.first_name
   AND vh.l_name = dp.last_name
  WHERE dp.id = '{$_SESSION['_id']}'
  ORDER BY vh.date ASC
";
$result = mysqli_query($conn, $query);
$volunteerHours = [];
$totalHours = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $volunteerHours[] = $row;
    $totalHours += $row['hours'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once('universal.inc'); ?>
    <title>Volunteer Hours</title>
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

        .content-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .total-hours {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            padding: 10px 20px;
            margin-bottom: 25px;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .total-hours-label {
            font-size: 18px;
            font-weight: bold;
        }

        .total-hours-value {
            font-size: 20px;
            font-weight: bold;
        }

        .log-container {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .download-button {
            display: block;
            margin: 30px auto 0;
            background-color: #4CAF50;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            text-align: center;
        }

        .no-logs {
            text-align: center;
            font-style: italic;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php require_once('header.php'); ?>
<h1>Volunteer Hours</h1>
<main>
    <div class="container">
        <div class="content-box">
            <div class="total-hours">
                <span class="total-hours-label">Total Hours</span>
                <span class="total-hours-value"><?php echo $totalHours; ?></span>
            </div>

            <?php if (empty($volunteerHours)) : ?>
                <p class="no-logs"><div class="error-toast">No volunteer hours to display.</div></p>
            <?php else : ?>
                <?php foreach ($volunteerHours as $entry) : ?>
                    <div class="log-container">
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($entry['date']); ?></p>
                        <p><strong>Hours:</strong> <?php echo htmlspecialchars($entry['hours']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="generateHourReport.php" target="_blank" class="download-button">Download Report</a>
        </div>
        <a class="button cancel" href="hours.php" style="margin-top: .5rem">Return to Hours Management Dashboard</a>
    </div>
</main>
</body>
<?php require('footer.php'); ?>
</html>
