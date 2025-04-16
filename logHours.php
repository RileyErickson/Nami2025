<?php

session_start();

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once('header.php');
require_once('universal.inc');
require_once('domain/Person.php');
require_once('database/dbPersons.php');
require_once('database/dbinfo.php');

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
            $variableForToastDisplay = TRUE;
         //echo  "<div class=\"happy-toast\">Log successfully submitted!</div>";
        } else {
            $variableForToastDisplay = FALSE;
           // echo  "<div class=\"error-toast\">Error submitting log.</div>";
        }

        $stmt->close();
    } else {
        echo  "<div class=\"error-toast\">All fields are required.</div>";
    }
}

mysqli_close($conn);
?>




<!DOCTYPE html>
<html>
<head>
     <title>Log Volunteer Hours</title>
</head>
<body>
    <h1>Log Volunteer Hours</h1>
    <?php
        if (isset($variableForToastDisplay)){
            if ($variableForToastDisplay == TRUE){
                echo  "<div class=\"happy-toast\">Log successfully submitted!</div>";
            }
            if ($variableForToastDisplay == FALSE){
                 echo  "<div class=\"error-toast\">Error submitting log.</div>";
            }
        }
    ?>
    <main class="dashboard">
        <div>
            <p><strong>Logged in as:</strong> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></p>
            <form method="POST">
                <label for="date">Date</label>
                <input type="date" name="date" required>

                <label for="what">What did you do?</label>
                <textarea name="what" required></textarea>

                <label for="hours">Hours Worked</label>
                <input type="number" name="hours" min="1" required>

                <input type="submit" value="Submit Log">
            </form>
          <a class="button cancel" href="hours.php" style="margin-top: .5rem">Return to Hours Management Dashboard</a>
            <?php if (!empty($message)) : ?>
                <br><p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
        </div>
    </main>

</body>
<?php require('footer.php'); ?>
</html>
