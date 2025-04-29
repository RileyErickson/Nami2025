<?php
    // Template for new VMS pages. Base your new page on this one

    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
    session_cache_expire(30);
    session_start();

    $loggedIn = false;
    $accessLevel = 0;
    $userID = null;
    if (isset($_SESSION['_id'])) {
        $loggedIn = true;
        // 0 = not logged in, 1 = standard user, 2 = manager (Admin), 3 super admin (TBI)
        $accessLevel = $_SESSION['access_level'];
        $userID = $_SESSION['_id'];
    }
    // admin-only access
    if ($accessLevel < 2) {
        header('Location: index.php');
        die();
    }
    

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once('universal.inc');
require_once('header.php');
require_once('database/dbinfo.php');


$conn = connect();

// Fetch all volunteer hours
$query = "SELECT f_name, l_name, date, hours FROM volunteerHours ORDER BY l_name, f_name, date ASC";
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
    <title>NAMI | Generate Reports</title>
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
<h1>Generate Volunteer Hours Report</h1>
<main>
    <div class="container">
        <div class="content-box">
            <form action="generateOneReport.php" method="POST" target="_blank" style="text-align: center;">
                <input name="volID" type="text" id="volID" required placeholder="Enter Volunteer ID" required>
                <button type="submit" class="download-button">Download Report</button>
            </form>
        </div>
        <a class="button cancel" href="index.php" style="display: block; text-align: center; margin-top: 0.5rem;">Return to Dashboard</a>
    </div>
</main>
</body>
<?php require('footer.php'); ?>
</html>
