<?php
// Include database connection
include('dbConnection.php');

// Sanitize and capture form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birthdate = $_POST['birthdate'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

// Insert data into the users table
$sql = "INSERT INTO users (first_name, last_name, birthdate, username, email, password) 
        VALUES ('$first_name', '$last_name', '$birthdate', '$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! You can now log in.";
    // Optionally redirect the user to a login page
    header("Location: login.php");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
