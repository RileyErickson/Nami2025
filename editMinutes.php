<?php
session_start();
ini_set("display_errors", 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

include_once('database/dbinfo.php');
$conn = connect();

$checkTableExists = mysqli_query($conn, "SHOW TABLES LIKE 'minutes_keywords'");
if (mysqli_num_rows($checkTableExists) == 0) {
    $createQuery = "CREATE TABLE minutes_keywords (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        keyword VARCHAR(255) NOT NULL
    )";
    if (!mysqli_query($conn, $createQuery)) {
        die("Error creating keywords table: " . mysqli_error($conn));
    }
}

$date = $_GET['date'] ?? "";
if (empty($date)) {
    header("Location: selectMinutes.php");
    exit;
}
$date = mysqli_real_escape_string($conn, $date);
$formattedDate = date("m-d-Y", strtotime($date));

$minutesName = "";
$result = mysqli_query($conn, "SELECT name FROM minutes_link WHERE date = '$date' LIMIT 1");
if ($row = mysqli_fetch_assoc($result)) {
    $minutesName = $row['name'];
}

$keywords = [];
$result = mysqli_query($conn, "SELECT * FROM minutes_keywords WHERE date = '$date'");
while ($row = mysqli_fetch_assoc($result)) {
    $keywords[] = $row;
}

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addKeyword'])) {
    $keyword = trim($_POST['keyword']);
    if (!empty($keyword)) {
        $keyword = mysqli_real_escape_string($conn, $keyword);

        $checkKeyword = mysqli_query($conn, "SELECT 1 FROM minutes_keywords WHERE date = '$date' AND keyword = '$keyword' LIMIT 1");
        if (mysqli_num_rows($checkKeyword) > 0) {
            $errorMessage = "Keyword already exists for this date.";
        } else {
            mysqli_query($conn, "INSERT INTO minutes_keywords (date, keyword) VALUES ('$date', '$keyword')");
            header("Location: editMinutes.php?date=$date");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteKeyword'])) {
    $keywordId = mysqli_real_escape_string($conn, $_POST['keywordId']);
    mysqli_query($conn, "DELETE FROM minutes_keywords WHERE id = '$keywordId'");
    header("Location: editMinutes.php?date=$date");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['deleteAll'])) {
    mysqli_query($conn, "DELETE FROM minutes_keywords WHERE date = '$date'");
    mysqli_query($conn, "DELETE FROM minutes_link WHERE date = '$date'");
    header("Location: index.php");
    exit();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once('universal.inc') ?>
    <title>Edit Minutes</title>
</head>
<body>
    <?php require_once('header.php') ?>
    <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
        <h1>Edit Minutes for <?php echo htmlspecialchars($formattedDate); ?></h1>
        <a href="minutes.php" style="background-color: #104C9C; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px; text-decoration: none; margin-bottom: 20px; align-self: flex-start;">Back to Minutes</a>
        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); width: 400px; text-align: center; margin-bottom: 20px;">
            <strong>Link:</strong>
            <?php if (!empty($minutesName)): ?>
                <a href="<?php echo htmlspecialchars($minutesName); ?>" target="_blank">Open Minutes</a>
            <?php else: ?>
                <em>No link available</em>
            <?php endif; ?>

            <form method="POST" style="margin-top: 20px;">
                <input type="text" name="keyword" placeholder="Enter new keyword" required>
                <input type="submit" name="addKeyword" style="background-color: #104C9C; color: white; padding: 10px; border-radius: 5px; cursor: pointer;" value="Add Keyword">
            </form>

            <?php if (!empty($errorMessage)): ?>
                <p style="color: red; margin-top: 10px;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>

            <h3>Keywords</h3>
            <?php foreach ($keywords as $keyword) : ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 5px;">
                    <span><?php echo htmlspecialchars($keyword['keyword']); ?></span>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="keywordId" value="<?php echo $keyword['id']; ?>">
                        <button type="submit" name="deleteKeyword" style="background-color: red; border: none; padding: 3px 6px; cursor: pointer; color: white; border-radius: 5px;">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>

            <form method="POST" style="margin-top: 20px;">
                <input type="submit" name="deleteAll" style="background-color: red; border: none; padding: 5px 10px; cursor: pointer; color: white; border-radius: 5px;" value="Delete Minutes (CANNOT BE UNDONE)">
            </form>
        </div>
    </div>
</body>
<?php require('footer.php'); ?>
</html>
