<?php
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

#require_once('include/input-validation.php');
#require_once('database/dbEvents.php');
require_once('database/dbPersons.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once('database/dbPersons.php');

$pending = fetchCurrentVolunteer();
$boardMembers = fetchCurrentBoardMembers();
$admins = fetchCurrentAdmins();
$allMembers = fetchEveryone();
$access_level = $_SESSION['access_level']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('universal.inc'); ?>
    <link rel="stylesheet" href="css/event.css" type="text/css" />

    <title>View Event Details | <?php /*echo htmlspecialchars($event_info['name']); */ ?></title>
    <link rel="stylesheet" href="css/messages.css" />

</head>

<body>
<?php require_once('header.php'); ?>

<h1 style="margin-bottom:0">Current Member List</h1>

<main class="general">
    <?php if (isset($_GET['rscSuccess'])): ?>
        <div class="happy-toast"><?php
        echo $_GET['id'];?>'s role and/or status updated successfully!</div>
        <?php header("Refresh: 2; jenniferp161.sg-host.com/displayCurrentVolunteers.php"); ?>

    <?php endif ?>
    <p>
        <center><a
                href="personSearch.php"><button class="button" style="width:30%"><?php echo 'Click here to search for a specific User' ?></button>
        </center></a>
        <?php if (sizeof($pending) === 0): ?>
    <b><?php
            echo "<div style=\"text-align:center\">";
            echo "There are currently no volunteers.";
        ?></b>
        <?php elseif (sizeof($pending) === 1): ?>
        <b><?php
            echo "<div style=\"text-align:center\">";
            echo "There is 1 volunteer."; ?></b>
        <?php else: ?>
            <b><?php
                    echo "<div style=\"text-align:center\">";
                    echo "There are currently " . htmlspecialchars(string: sizeof($pending)) . " volunteers."; ?></b>
        <?php endif; ?>
        <?php if (sizeof($boardMembers) === 0): ?>
        <b><?php
            echo "<div style=\"text-align:center\">";
            echo "There are currently no board members.";
            ?></b>
        <?php elseif (sizeof($boardMembers) === 1): ?>
            <b><?php
            echo "<div style=\"text-align:center\">";
                echo "There is 1 board member."; ?></b>
        <?php else: ?>

            <b><?php
                echo "<div style=\"text-align:center\">";
                echo "There are currently " . htmlspecialchars(string: sizeof($boardMembers)) . " board members."; ?></b>
        <?php endif; ?>
        <?php if (sizeof($admins) === 0): ?>
                <b><?php
            echo "<div style=\"text-align:center\">";
            echo "There are currently no admins.";
                    ?></b>
        <?php elseif (sizeof($admins) === 1): ?>
                    <b><?php
            echo "<div style=\"text-align:center\">";
                        echo "There is 1 admin."; ?></b>
        <?php else: ?>
            <b><?php
                    echo "<div style=\"text-align:center\">";
                    echo "There are currently " . htmlspecialchars(string: sizeof($admins)) . " admins."; ?></b>
        <?php endif; ?>
    </p>
    <br>

<!--    <p>-->
<!--        --><?php //if (sizeof($pending) === 0):
//            echo "There are 0 pending signups awaiting resolution.";
//            ?>
<!--        --><?php //elseif (sizeof($pending) === 1):
//            echo "There is 1 pending signup awaiting resolution"; ?>
<!--        --><?php //else: ?>
<!--            --><?php //echo "There are " . htmlspecialchars(string: sizeof($pending)) . " pending signups awaiting resolution"; ?>
<!--        --><?php //endif; ?>
<!--    </p>-->

    <?php if (count(value: $allMembers) > 0): ?>
        <div class="table-wrapper">
            <table class="general">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
<!--                    <th>Start Date</th>-->
                    <?php if ($access_level >= 2): ?>
                        <th><center>View Profile</center></th>
                        <th><center>Edit Profile</center></th>
                        <th><center>Change Role</center></th>
                    <?php endif; ?>
<!--                    --><?php //if ($access_level >= 2): ?>
<!--                        <th>Change Role</th>-->
<!--                    --><?php //endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php for ($x = 0; $x < sizeof($allMembers); $x++): ?>
                    <h2><?php $name = $allMembers[$x]['first_name']; ?></h2>

                    <?php
                    #$event = $pending[$x]['first_name'];
                    $user_id = $allMembers[$x]['id'];

                    //foreach ($events as $event):
                    #$user_info = ($event);
                    $position_label = 'p';
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user_id); ?></td>
                        <td><?php echo htmlspecialchars($name); ?></td>
                        <td><?php echo htmlspecialchars($allMembers[$x]['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($allMembers[$x]['type']); ?></td>
<!--                        <td>-->
<!--                            --><?php //echo htmlspecialchars($pending[$x]['start_date']); ?>
<!--                        </td>-->
                        <!--                        <td>--><?php //echo htmlspecialchars($position_label); ?><!--</td>-->
                        <!-- Demographic -->
                        <td>

                            <a
                                href="viewProfile.php?id=<?php echo urlencode($user_id); ?>"><center><button class="button""><?php echo 'View ',htmlspecialchars($name); ?></center></button>
                            </a>
                        </td>

                        <td>

                            <a
                                    href="editProfile.php?id=<?php echo urlencode($user_id); ?>"><center><button class="button""><?php echo 'Edit ',htmlspecialchars($name); ?></center></button>
                            </a>
                        <td>

                            <a
                                    href="modifyUserRole.php?id=<?php echo urlencode($user_id); ?>"><center><button class="button""><?php echo 'Change ',htmlspecialchars($name); ?></center></button>
                            </a>
                        </td>
                        <!--Actions-->

                    </tr>

                <?php endfor ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>

    <a class="button cancel" href="volunteerDirectory.php">Return to Volunteer Management Dashboard</a>
</main>


</body>
<?php require('footer.php'); ?>
</html>