<?php
// Start session and enable error reporting
session_cache_expire(30);
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('database/dbinfo.php');
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
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock | Upload Minutes</title>
    </head>
    <body>
        <?php require_once('header.php') ?>   
        <h1>Add Minutes</h1>
    <div class="container">
   
        <h2>Upload PDF</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfFile" required>
            <input type="date" name="date" required>
            <input type="submit" value="Upload PDF">
            
        </form>
        <a class="button cancel" href="minutes.php" style="margin-top: .5rem">Return to Dashboard</a>; 
    </div>
    
    <?php if (!empty($message)) : ?>
        <p class="message <?php echo ($message == 'Only PDF files are allowed.' || $message == 'Error uploading file.' || $message == 'Date is required.' || $message == 'A file with this name or date already exists.') ? 'error' : ''; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
    <main class="date">
    
</body>
</html>
