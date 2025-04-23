<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

include_once('database/dbinfo.php');
$conn = connect();

$keywordQuery = "SELECT DISTINCT keyword FROM minutes_keywords ORDER BY keyword ASC";
$keywordsResult = mysqli_query($conn, $keywordQuery);
$keywords = [];
while ($row = mysqli_fetch_assoc($keywordsResult)) {
    $keywords[] = $row['keyword'];
}

$selectedKeywords = $_GET['keywords'] ?? [];
$sortOrder = $_GET['sort'] ?? 'ASC';

$searchQuery = "SELECT date, name AS link FROM minutes_link ORDER BY date $sortOrder";

if (!empty($selectedKeywords)) {
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
            margin-right: 20px;
        }
        #content {
            flex: 1;
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
        .keyword-box {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-bottom: 8px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php require_once('header.php') ?>
    <h1>Search Minutes</h1>
    <div style="display: flex;">
        <div id="sidebar" class="container">
            <h3>Select Keywords</h3>
            <form action="searchMinutes.php" method="GET">
                <?php foreach ($keywords as $keyword): ?>
                    <div class="keyword-box">
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
                                <a href="editMinutes.php?date=<?php echo urlencode($minutes['date']); ?>" class="clickable">
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
    </div>
</body>
<?php require('footer.php'); ?>
</html>
