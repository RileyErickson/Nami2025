<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('../database/dbinfo.php');
$conn = connect();

// Handle sorting order
$order = $_GET['order'] ?? 'ASC';
$newOrder = $order === 'ASC' ? 'DESC' : 'ASC';

// Fetch all keywords
$keywords = [];
$result = mysqli_query($conn, "SELECT DISTINCT keyword FROM keywords ORDER BY keyword ASC");
while ($row = mysqli_fetch_assoc($result)) {
    $keywords[] = $row['keyword'];
}

// Fetch all minutes based on filters
$selectedKeywords = $_GET['keywords'] ?? [];
$minutes = [];
$query = "SELECT m.* FROM minutes m";
if (!empty($selectedKeywords)) {
    $query .= " JOIN keywords k ON m.date = k.date WHERE k.keyword IN ('" . implode("','", array_map(function($keyword) use ($conn) { return mysqli_real_escape_string($conn, $keyword); }, $selectedKeywords)) . "')";
    $query .= " GROUP BY m.date HAVING COUNT(DISTINCT k.keyword) = " . count($selectedKeywords);
}
$query .= " ORDER BY m.date $order";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $minutes[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Minutes</title>
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
            width: 500px;
            text-align: center;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #808080;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .button:hover {
            background-color: #696969;
        }
        .filter-container {
            display: flex;
            justify-content: space-between;
            width: 80%;
        }
        .keyword-list {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 30%;
            padding: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .minutes-list {
            width: 65%;
        }
        .minute-container {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <a href="minutes.php" class="button" style="position: absolute; top: 10px; left: 10px;">Back</a>
    <div class="container">
        <h2>Search Minutes</h2>
        <form method="GET">
            <button type="submit" name="order" value="<?php echo $newOrder; ?>" class="button">Sort by Date (<?php echo $newOrder; ?>)</button>
            <input type="submit" value="Filter" class="button">
            <div class="filter-container">
                <div class="keyword-list">
                    <h3>Select Keywords</h3>
                    <?php foreach ($keywords as $keyword) : ?>
                        <label>
                            <input type="checkbox" name="keywords[]" value="<?php echo htmlspecialchars($keyword); ?>" 
                                <?php echo in_array($keyword, $selectedKeywords) ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($keyword); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <div class="minutes-list">
                    <h3>Minutes</h3>
                    <?php foreach ($minutes as $minute) : ?>
                        <div class="minute-container">
                            <a href="minutespdf/<?php echo str_replace('+', ' ', urlencode($minute['name'])); ?>" download>
                                <?php echo date("m-d-Y", strtotime($minute['date'])) . " - " . htmlspecialchars($minute['name']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
