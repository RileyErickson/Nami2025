<?php
// Database connection
$servername = "localhost"; 
$username = "root";
$password = "";            
$dbname = "your_database"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all user records (or modify this query to fetch other data)
$sql = "SELECT id, username, email, created_at FROM users";
$result = $conn->query($sql);

// Check if there are any records to export
if ($result->num_rows > 0) {
    // Open the output stream to create the CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users_data.csv"');

    // Open PHP output stream
    $output = fopen('php://output', 'w');

    // Output CSV headers (column names)
    fputcsv($output, array('ID', 'Username', 'Email', 'Created At'));

    // Output each row of data from the query
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    // Close the output stream
    fclose($output);

} else {
    echo "No records found!";
}

// Close database connection
$conn->close();
?>
