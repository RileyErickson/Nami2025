<?php
// Start session to access stored user information
session_start();

// Enable error reporting for debugging
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include the necessary user class
require_once('../domain/Person.php');
require_once('../database/dbPersons.php');
require_once('../database/dbinfo.php');

$conn = connect();

// Ensure the 'pendingHourLogs' table exists
$createTableQuery = "CREATE TABLE IF NOT EXISTS pendingHourLogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    what TEXT NOT NULL,
    hours INT NOT NULL
)";

if (!mysqli_query($conn, $createTableQuery)) {
    echo json_encode(["error" => "Error creating table: " . mysqli_error($conn)]);
    exit();
}

// Check if the user is logged in
if (isset($_SESSION['_id'])) {
    $username = $_SESSION['_id'];
    $user = retrieve_person($username);
    
    if ($user) {
        $_SESSION['f_name'] = $user->get_first_name();
        $_SESSION['l_name'] = $user->get_last_name();
        $firstName = $_SESSION['f_name'];
        $lastName = $_SESSION['l_name'];
    } else {
        echo json_encode(["error" => "User not found"]);
        exit();
    }
} else {
    echo json_encode(["error" => "No user logged in"]);
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'] ?? '';
    $what = $_POST['what'] ?? '';
    $hours = $_POST['hours'] ?? '';
    
    if (!empty($date) && !empty($what) && !empty($hours)) {
        $stmt = $conn->prepare("INSERT INTO pendingHourLogs (first_name, last_name, date, what, hours) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $firstName, $lastName, $date, $what, $hours);
        if ($stmt->execute()) {
            $message = "Log successfully submitted!";
        } else {
            $message = "Error submitting log: " . $conn->error;
        }
        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Volunteer Hours</title>
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
        .button {
            background-color: #808080;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            display: block;
            margin: 10px auto;
        }
        .button:hover {
            background-color: #696969;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <a href="../index.php" class="button" style="position: absolute; top: 10px; left: 10px;">Back</a>
    <div class="container">
        <h2>Log Volunteer Hours</h2>
        <p><strong>Logged in as:</strong> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></p>
        <form method="POST">
            <label for="date">Date</label>
            <input type="date" name="date" required>
            
            <label for="what">What did you do?</label>
            <textarea name="what" required></textarea>
            
            <label for="hours">Hours Worked</label>
            <input type="number" name="hours" min="1" required>
            
            <input type="submit" value="Submit Log" class="button">
        </form>
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
