<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('../database/dbinfo.php');
$conn = connect();

// Ensure the 'minutes' table exists
$createMinutesTableQuery = "CREATE TABLE IF NOT EXISTS minutes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date DATE NOT NULL
)";

if (!mysqli_query($conn, $createMinutesTableQuery)) {
    echo "Error creating table: " . mysqli_error($conn);
}

// Check if upload directory exists, if not, create it
$uploadDir = 'minutespdf/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$message = "";

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfFile'])) {
    $file = $_FILES['pdfFile'];
    $fileName = basename($file['name']);
    $targetFilePath = $uploadDir . $fileName;
    $fileDate = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : "";

    // Validate file type
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    if ($fileType != "pdf") {
        $message = "Only PDF files are allowed.";
    } elseif (empty($fileDate)) {
        $message = "Date is required.";
    } else {
        // Check if file or date already exists in database
        $checkQuery = "SELECT * FROM minutes WHERE name = '$fileName' OR date = '$fileDate'";
        $checkResult = mysqli_query($conn, $checkQuery);
        
        if (mysqli_num_rows($checkResult) > 0) {
            $message = "A file with this name or date already exists.";
        } else {
            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                $insertQuery = "INSERT INTO minutes (name, date) VALUES ('$fileName', '$fileDate')";
                if (mysqli_query($conn, $insertQuery)) {
                    header("Location: editMinutes.php?date=$fileDate");
                    exit();
                } else {
                    $message = "Error saving record: " . mysqli_error($conn);
                }
            } else {
                $message = "Error uploading file.";
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #add8e6;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin-bottom: 20px;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .message {
            margin-top: 10px;
            font-size: 16px;
            color: green;
        }
        .error {
            color: red;
        }
        input[type="file"], input[type="date"] {
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #808080;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #696969;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #808080;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #696969;
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-button">Back</a>
    <div class="container">
        <h2>Upload PDF</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfFile" required>
            <input type="date" name="date" required>
            <input type="submit" value="Upload PDF">
        </form>
    </div>
    
    <?php if (!empty($message)) : ?>
        <p class="message <?php echo ($message == 'Only PDF files are allowed.' || $message == 'Error uploading file.' || $message == 'Date is required.' || $message == 'A file with this name or date already exists.') ? 'error' : ''; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
</body>
</html>
