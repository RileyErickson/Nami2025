<?php
session_cache_expire(30);
session_start();

$loggedIn   = false;
$accessLevel = 0;
$userID     = null;

if (isset($_SESSION['_id'])) {
    $loggedIn    = true;
    // 0 = not logged in, 1 = standard user, 2 = manager (Admin), 3 = super admin (TBI)
    $accessLevel = $_SESSION['access_level'];
    $userID      = $_SESSION['_id'];
}

// admin-only access
if ($accessLevel < 2) {
    header('Location: index.php');
    die();
}

require_once('database/dbPersons.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$pending      = fetchCurrentVolunteer();
$boardMembers = fetchCurrentBoardMembers();
$admins       = fetchCurrentAdmins();
$allMembers   = fetchEveryone();
$access_level = $_SESSION['access_level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('universal.inc'); ?>
    <link rel="stylesheet" href="css/event.css" type="text/css" />
    <link rel="stylesheet" href="css/messages.css" />
    <title>Current Member List</title>

    <!-- Shrink-to-fit table CSS -->
    <style>
        .table-wrapper {
            width: 100%;
            overflow-x: visible;
        }
        table.general {
            width: 100%;
            table-layout: fixed;
        }
        table.general th,
        table.general td {
            white-space: normal;
            word-wrap: break-word;
            padding: 0.5em;
        }
        img, .some-large-element {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php require_once('header.php'); ?>

    <h1 style="margin-bottom:0">Current Member List</h1>

    <main class="general">
        <?php if (isset($_GET['rscSuccess'])): ?>
            <div class="happy-toast">
                <?= htmlspecialchars($_GET['id']) ?>'s role and/or status updated successfully!
            </div>
        <?php endif ?>

        <center>
            <a href="personSearch.php">
                <button class="button" style="width:30%">
                    Click here to search for a specific User
                </button>
            </a>
        </center>
        <br>

        <?php if (count($pending) === 0): ?>
            <b><div style="text-align:center">There are currently no volunteers.</div></b>
        <?php elseif (count($pending) === 1): ?>
            <b><div style="text-align:center">There is 1 volunteer.</div></b>
        <?php else: ?>
            <b>
                <div style="text-align:center">
                    There are currently <?= count($pending) ?> volunteers.
                </div>
            </b>
        <?php endif; ?>

        <?php if (count($boardMembers) === 0): ?>
            <b><div style="text-align:center">There are currently no board members.</div></b>
        <?php elseif (count($boardMembers) === 1): ?>
            <b><div style="text-align:center">There is 1 board member.</div></b>
        <?php else: ?>
            <b>
                <div style="text-align:center">
                    There are currently <?= count($boardMembers) ?> board members.
                </div>
            </b>
        <?php endif; ?>

        <?php if (count($admins) === 0): ?>
            <b><div style="text-align:center">There are currently no admins.</div></b>
        <?php elseif (count($admins) === 1): ?>
            <b><div style="text-align:center">There is 1 admin.</div></b>
        <?php else: ?>
            <b>
                <div style="text-align:center">
                    There are currently <?= count($admins) ?> admins.
                </div>
            </b>
        <?php endif; ?>

        <?php if (count($allMembers) > 0): ?>
            <div class="table-wrapper">
                <table class="general">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role</th>
                            <?php if ($access_level >= 2): ?>
                                <th><center>View Profile</center></th>
                                <th><center>Edit Profile</center></th>
                                <th><center>Change Role</center></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allMembers as $member): 
                            $user_id = $member['id'];
                            $first   = htmlspecialchars($member['first_name']);
                            $last    = htmlspecialchars($member['last_name']);
                            switch ($member['type']) {
                                case 'donor':     $role = 'Donor'; break;
                                case 'volunteer':
                                case 'v':         $role = 'Volunteer'; break;
                                case 'admin':     $role = 'Admin'; break;
                                case 'board':     $role = 'Board Member'; break;
                                default:          $role = htmlspecialchars($member['type']);
                            }
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($user_id) ?></td>
                                <td><?= $first ?></td>
                                <td><?= $last ?></td>
                                <td><?= $role ?></td>
                                <?php if ($access_level >= 2): ?>
                                    <td>
                                        <a href="viewProfile.php?id=<?= urlencode($user_id) ?>">
                                            <center>
                                                <button class="button">View <?= $first ?></button>
                                            </center>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="editProfile.php?id=<?= urlencode($user_id) ?>">
                                            <center>
                                                <button class="button">Edit <?= $first ?></button>
                                            </center>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="modifyUserRole.php?id=<?= urlencode($user_id) ?>">
                                            <center>
                                                <button class="button">Change <?= $first ?></button>
                                            </center>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <a class="button cancel" href="volunteerDirectory.php">
            Return to Volunteer Management Dashboard
        </a>
    </main>

    <?php require('footer.php'); ?>
</body>
</html>
