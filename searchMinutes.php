<?php
// Start session and enable error reporting
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Include database connection
include_once('database/dbinfo.php');
$conn = connect();

// Fetch all unique keywords for sidebar
$keywordQuery = "SELECT DISTINCT keyword FROM minutes_keywords ORDER BY keyword ASC";
$keywordsResult = mysqli_query($conn, $keywordQuery);
$keywords = [];
while ($row = mysqli_fetch_assoc($keywordsResult)) {
    $keywords[] = $row['keyword'];
}

// Initialize variables
$selectedKeywords = $_GET['keywords'] ?? [];
$sortOrder = $_GET['sort'] ?? 'ASC'; // Default sort order

// Start with a basic query to fetch all dates and links
$searchQuery = "SELECT date, name AS link FROM minutes_link ORDER BY date $sortOrder";

if (!empty($selectedKeywords)) {
    // Apply keyword filter if provided
    $keywordFilter = "'" . implode("','", array_map(function($keyword) use ($conn) { 
        return mysqli_real_escape_string($conn, $keyword); 
    }, $selectedKeywords)) . "'";
    $searchQuery = "SELECT minutes_link.date, minutes_link.name AS link FROM minutes_link
                    JOIN minutes_keywords ON minutes_link.date = minutes_keywords.date
                    WHERE minutes_keywords.keyword IN ($keywordFilter)
                    GROUP BY minutes_link.date
                    ORDER BY minutes_link.date $sortOrder";
}

$result = mysqli_query($conn, $searchQuery);
$minutesResults = [];
while ($row = mysqli_fetch_assoc($result)) {
    $minutesResults[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Minutes</title>
    <?php require_once('universal.inc') ?>
    <style>
        #sidebar {
            width: 200px;
            float: left;
        }
        #content {
            margin-left: 210px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            cursor: pointer;
        }
        .clickable {
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 5px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <?php require_once('header.php') ?>
    <h1>Search Minutes</h1>
    <div id="sidebar" class="container">
        <h3>Select Keywords</h3>
        <form action="searchMinutes.php" method="GET">
            <?php foreach ($keywords as $keyword): ?>
                <div>
                    <input type="checkbox" name="keywords[]" value="<?php echo htmlspecialchars($keyword); ?>" 
                        <?php echo in_array($keyword, $selectedKeywords) ? 'checked' : ''; ?>>
                    <?php echo htmlspecialchars($keyword); ?>
                </div>
            <?php endforeach; ?>
            <input type="submit" value="Search">
        </form>
    </div>
    <div id="content">
        <div class="container">
            <h3>Sort Results</h3>
            <form action="searchMinutes.php" method="GET">
                <!-- Include keywords in the sort form to preserve filter settings -->
                <?php foreach ($selectedKeywords as $keyword): ?>
                    <input type="hidden" name="keywords[]" value="<?php echo htmlspecialchars($keyword); ?>">
                <?php endforeach; ?>
                <input type="radio" name="sort" value="ASC" <?php echo $sortOrder === 'ASC' ? 'checked' : ''; ?>> Ascending
                <input type="radio" name="sort" value="DESC" <?php echo $sortOrder === 'DESC' ? 'checked' : ''; ?>> Descending
                <input type="submit" value="Sort">
            </form>
        </div>
        <div class="container">
            <h3>Minutes Results</h3>
            <?php if (!empty($minutesResults)): ?>
                <ul style="padding-left: 0;">
                    <?php foreach ($minutesResults as $minutes): ?>
                        <li class="clickable">
                            <!-- Assuming 'link' is the URL to open, and it's not empty -->
                            <a href="<?php echo htmlspecialchars($minutes['link']); ?>" target="_blank" class="clickable">
                                <?php echo htmlspecialchars($minutes['date']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
<?php require('footer.php'); ?>
</html>

        
