<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection and header
require_once('database/dbinfo.php'); // Defines connect()
require_once('header.php');

$error = '';
$success = '';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and trim the form inputs
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $phone1     = trim($_POST['phone1'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $start_date = trim($_POST['start_date'] ?? ''); // Displayed as "First Donation"

    // Validate required fields: first name, last name, and email must be provided
    if ($first_name === '' || $last_name === '' || $email === '') {
        $error = "Please fill in all required fields: First Name, Last Name, and Email.";
    } else {
        // Set the donor type automatically
        $type = 'donor';

        // Connect to the database
        $conn = connect();

        // Query to get the total number of rows in dbPersons
        $query = "SELECT COUNT(*) AS total FROM dbPersons";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalRows = $row['total'];
        } else {
            // If count query fails, default to 0
            $totalRows = 0;
        }

        // Create the unique id string in the format: firstname_totalnumberofrows_lastname
        $id = $first_name . "_" . $totalRows . "_" . $last_name;

        // Prepare the SQL statement to insert a new donor record with the calculated id
        $stmt = $conn->prepare("INSERT INTO dbPersons (id, first_name, last_name, phone1, email, start_date, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $error = "Failed to prepare statement: " . htmlspecialchars($conn->error);
        } else {
            $stmt->bind_param("sssssss", $id, $first_name, $last_name, $phone1, $email, $start_date, $type);
            if ($stmt->execute()) {
                $success = "Donor added successfully!";
            } else {
                $error = "Error inserting donor: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Donor | NAMI Rappahannock</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; }
        form { 
            max-width: 400px; 
            margin: 2em auto; 
            padding: 1em; 
            background: #fff; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }
        label { font-weight: bold; display: block; margin-top: 0.5em; }
        input, button { width: 100%; padding: 0.5em; margin-bottom: 1em; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Add Donor</h1>
    <main>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">

            <label for="phone1">Phone:</label>
            <input type="text" id="phone1" name="phone1" value="<?php echo htmlspecialchars($_POST['phone1'] ?? ''); ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

            <label for="start_date">First Donation:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($_POST['start_date'] ?? ''); ?>">

            <button type="submit">Add Donor</button>
        </form>
    </main>
    <?php require_once('footer.php'); ?>
</body>
</html>
