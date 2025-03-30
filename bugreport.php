<?php
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-size: 18px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        button {
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #0c499c;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
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
        </form>
    </div>
</body>
</html>
