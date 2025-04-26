<?php
session_cache_expire(30);
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $date     = $_POST["date"] ?? "";
    $time     = $_POST["time"] ?? "";
    $doing    = $_POST["doing"] ?? "";
    $happened = $_POST["happened"] ?? "";
    $expected = $_POST["expected"] ?? "";

    // Compose the bug report content
    $reportContent = "Date: " . $date . "\n" .
                     "Time: " . $time . "\n" .
                     "What you were doing: " . $doing . "\n" .
                     "What happened: " . $happened . "\n" .
                     "What you expected to have happened: " . $expected . "\n";

    // Ensure the bugreports directory exists
    if (!is_dir("bugreports")) {
        mkdir("bugreports", 0777, true);
    }

    // Determine the next available bug report file name inside the bugreports folder
    $i = 1;
    while (file_exists("bugreports/bugreport" . $i . ".txt")) {
        $i++;
    }
    $filename = "bugreports/bugreport" . $i . ".txt";

    // Save the bug report to the file
    file_put_contents($filename, $reportContent);

    // Redirect to index.php after saving
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php require('universal.inc'); ?>
    <title>Report a Bug</title>

</head>
<body>
    <?php require('header.php'); ?>
    <div class="container">
        <h1>Report a Bug</h1>
        <form method="POST" action="bugreport.php">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>

            <label for="time">Time:</label>
            <input type="time" name="time" id="time" required>

            <label for="doing">What you were doing:</label>
            <textarea name="doing" id="doing" required></textarea>

            <label for="happened">What happened:</label>
            <textarea name="happened" id="happened" required></textarea>

            <label for="expected">What you expected to have happened:</label>
            <textarea name="expected" id="expected" required></textarea>

            <button type="submit">Submit Bug Report</button>
            <a class="button cancel" href="index.php" style="margin-top: .5rem">Return to Home Dashboard</a>
        </form>
        
    </div>
</body>
</html>
