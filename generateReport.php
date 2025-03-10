<?php
    // Template for new VMS pages. Base your new page on this one

    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
    session_cache_expire(30);
    session_start();

    $loggedIn = false;
    $accessLevel = 0;
    $userID = null;
    if (isset($_SESSION['_id'])) {
        $loggedIn = true;
        // 0 = not logged in, 1 = standard user, 2 = manager (Admin), 3 super admin (TBI)
        $accessLevel = $_SESSION['access_level'];
        $userID = $_SESSION['_id'];
    }
    // admin-only access
    if ($accessLevel < 2) {
        header('Location: index.php');
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title>NAMI | Generate Reports</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Generate Volunteer Reports</h1>
        <form id="hours-report" class="general" method="get">
            <h2>Generate Volunteer Report</h2>
            <p>Use the form to find hour information for a volunteer. All criteria must be filled in.</p>
            <label for="id">Username</label>
            <input type="text" id="id" name="id" value="<?php if (isset($id)) echo htmlspecialchars($_GET['id']) ?>" placeholder="Enter the user's username (login ID)">
            <label for="eventID">Include Event</label>
            <select id="eventID" name="eventID">
                <option value="">Exclude</option>
                <option value="Include" <?php if (isset($eventID) && $eventID == 'Include') echo 'selected' ?>>Include</option>
            </select>
            <label for="startEnd">Include Time</label>
            <select id="startEnd" name="startEnd">
                <option value="">Exclude</option>
                <option value="startOnly">Start Time Only</option>
                <option value="endOnly">End Time Only</option>
                <option value="both">Both</option>
            </select>
            <label for="totalHours">Total Hours</label>
            <select id="totalHours" name="totalHours">
                <option value="">Exclude</option>
                <option value="Include">Include</option>
            </select>
            <input type="submit" value="Generate Report">
            <a class="button cancel" href="index.php">Return to Dashboard</a>
        </form>
    </body>
</html>