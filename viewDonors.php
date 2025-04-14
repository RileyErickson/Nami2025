<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection and header/footer
require_once('database/dbinfo.php');
require_once('header.php');

// Connect to the database
$conn = connect();

// Process deletion if a delete button was clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM dbPersons WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("s", $delete_id);
        if ($stmt->execute()) {
            $message = "Donor deleted successfully.";
        } else {
            $error = "Error deleting donor: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Failed to prepare deletion query: " . $conn->error;
    }
}

// Allowed columns for sorting (only for sortable columns)
$allowed_columns = ['first_name', 'last_name', 'start_date'];

// Get ordering parameters from GET; default to sorting by first_name ascending
$orderby = (isset($_GET['orderby']) && in_array($_GET['orderby'], $allowed_columns))
    ? $_GET['orderby'] : 'first_name';
$order = (isset($_GET['order']) && strtolower($_GET['order']) === 'desc')
    ? 'desc' : 'asc';

// Build the query to retrieve donors (including the primary key id for deletion)
$sql = "SELECT id, first_name, last_name, phone1, email, start_date 
        FROM dbPersons 
        WHERE type = 'donor' 
        ORDER BY $orderby $order";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donors List | NAMI Rappahannock</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f8f8f8;
        }
        h1 { 
            text-align: center; 
            margin-top: 2em;
        }
        table { 
            width: 80%; 
            margin: 2em auto; 
            border-collapse: collapse; 
            background: #fff;
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 0.8em; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
        }
        th a { 
            text-decoration: none; 
            color: inherit; 
        }
        /* Style for the red delete button */
        .delete-btn {
            background-color: red; 
            color: white; 
            border: none; 
            padding: 0.5em 1em; 
            cursor: pointer;
        }
        /* Message styles */
        .message { text-align: center; color: green; }
        .error { text-align: center; color: red; }
    </style>
</head>
<body>
    <h1>Donors List</h1>
    <?php if (isset($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <main>
        <table>
            <thead>
                <tr>
                    <?php
                    // Define headers with their respective keys.
                    // The order: first_name, last_name, start_date (sortable), then email and phone (non-sortable).
                    $headers = [
                        'first_name' => 'First Name',
                        'last_name'  => 'Last Name',
                        'start_date' => 'First Donation',
                        'email'      => 'Email',
                        'phone1'     => 'Phone'
                    ];
                    
                    foreach ($headers as $col => $label) {
                        if (in_array($col, $allowed_columns)) {
                            // Determine the next order: toggle if this is the active sorting column.
                            $nextOrder = ($orderby === $col && $order === 'asc') ? 'desc' : 'asc';
                            echo "<th><a href=\"?orderby={$col}&order={$nextOrder}\">{$label}</a></th>";
                        } else {
                            echo "<th>{$label}</th>";
                        }
                    }
                    // Add an extra header for the Delete action.
                    echo "<th>Remove From Donors</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone1']) . "</td>";
                        echo "<td>
                                <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this donor?\");'>
                                    <input type='hidden' name='delete_id' value='" . htmlspecialchars($row['id']) . "'>
                                    <button type='submit' class='delete-btn'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No donors found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php require_once('footer.php'); ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
