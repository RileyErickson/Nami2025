<?php
// Include necessary functions
require_once('include/input-validation.php');
require_once('database/dbPersons.php'); 
require_once('email.php');
session_cache_expire(30);
session_start();
$error = '';
$results = [];
$loggedIn = false;
    $accessLevel = 0;
    $userID = null;
 if (isset($_SESSION['_id'])) {
        $loggedIn = true;
        // 0 = not logged in, 1 = standard user, 2 = manager (Admin), 3 super admin (TBI)
        $accessLevel = $_SESSION['access_level'];
        $userID = $_SESSION['_id'];
    } 
    // Require admin privileges
    if ($accessLevel < 2) {
        header('Location: login.php');
        echo 'bad access level';
        die();
    }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $args = sanitize($_POST, ['fromUser', 'subject', 'body']);
    $fromUser = trim($args['fromUser'] ?? 'NAMI');
    $subject  = trim($args['subject'] ?? '');
    $body     = trim($args['body']    ?? '');

    if ($subject === '' || $body === '') {
        $error = 'Please provide both a subject and a message body.';
    } else {
        $allResults = [];

        // Check if "Everyone" is selected; if yes, disregard other checkboxes.
        if (!empty($_POST['all'])) {
            $allResults[] = emailAll($fromUser, $subject, $body);
        } else {
            // Process individual groups only if "Everyone" is not selected.
            if (!empty($_POST['admin']))       { $allResults[] = emailAdmin($fromUser, $subject, $body); }
            if (!empty($_POST['volunteer']))   { $allResults[] = emailVolunteer($fromUser, $subject, $body); }
            if (!empty($_POST['board']))       { $allResults[] = emailBoardMember($fromUser, $subject, $body); }
            if (!empty($_POST['donator']))     { $allResults[] = emailDonor($fromUser, $subject, $body); }
            if (!empty($_POST['participant'])) { $allResults[] = emailParti($fromUser, $subject, $body); }
        }

        // Merge all results into one array
        foreach ($allResults as $list) {
            $results = array_merge($results, $list);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('universal.inc'); ?>
    <title>Send Bulk Emails</title>
    <style>
        .error { color: red; }
        table { border-collapse: collapse; width: 100%; margin-top: 1em; }
        th, td { border: 1px solid #ccc; padding: 0.5em; text-align: left; }
    </style>
</head>
<body>
    <?php require_once('header.php'); ?>
    <main>
        <h1>Send Bulk Emails</h1>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post">
            <!-- Recipient Selection placed at the top -->
            <fieldset>
                <legend>Send To:</legend>
                <label><input type="checkbox" name="admin" <?php if(!empty($_POST['admin'])) echo 'checked'; ?>> Admins</label><br>
                <label><input type="checkbox" name="volunteer" <?php if(!empty($_POST['volunteer'])) echo 'checked'; ?>> Volunteers</label><br>
                <label><input type="checkbox" name="board" <?php if(!empty($_POST['board'])) echo 'checked'; ?>> Board Members</label><br>
                <label><input type="checkbox" name="donator" <?php if(!empty($_POST['donator'])) echo 'checked'; ?>> Donors</label><br>
                <label><input type="checkbox" name="participant" <?php if(!empty($_POST['participant'])) echo 'checked'; ?>> Participants</label><br>
                <label><input type="checkbox" name="all" <?php if(!empty($_POST['all'])) echo 'checked'; ?>> Everyone</label>
            </fieldset>
            
            <!-- From Field -->
            <div style="margin-top:1em;">
                <label for="fromUser">From:</label><br>
                <input type="text" id="fromUser" name="fromUser" value="<?php echo htmlspecialchars($_POST['fromUser'] ?? 'NAMI'); ?>" required style="width:100%;">
            </div>
            
            <div style="margin-top:1em;">
                <label for="subject">Subject:</label><br>
                <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" required style="width:100%;">
            </div>
            <div style="margin-top:1em;">
                <label for="body">Message Body:</label><br>
                <textarea id="body" name="body" rows="8" required style="width:100%;"><?php echo htmlspecialchars($_POST['body'] ?? ''); ?></textarea>
            </div>
            <div style="margin-top:1em;">
                <button type="submit">Send Emails</button>
            </div>
        </form>

        <?php if (!empty($results)): ?>
            <h2>Results</h2>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $email => $status): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($email); ?></td>
                            <td><?php echo $status ? 'Sent' : 'Failed'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
<?php require('footer.php'); ?>
</html>
