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

$pending = pendingPerson($userID);
$access_level = $_SESSION['access_level']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('universal.inc'); ?>
    <link rel="stylesheet" href="css/event.css" type="text/css" />

    <title>View Event Details | <?php /*echo htmlspecialchars($event_info['name']); */ ?></title>
    <link rel="stylesheet" href="css/messages.css" />

    <script>
        function showResolutionConfirmation(ei, ui) {
            document.getElementById('resolution-confirmation-wrapper-' + ei + '-' + ui).classList.remove('hidden');

            return false;
        }
        function showApprove(ei, ui) {
            document.getElementById('resolution-confirmation-wrapper-' + ei + '-' + ui).classList.add('hidden');
            document.getElementById('reject-confirmation-wrapper-' + ei + '-' + ui).classList.add('hidden');
            document.getElementById('approve-confirmation-wrapper-' + ei + '-' + ui).classList.remove('hidden');
            return false;
        }
        function showReject(ei, ui) {
            document.getElementById('resolution-confirmation-wrapper-' + ei + '-' + ui).classList.add('hidden');
            document.getElementById('approve-confirmation-wrapper-' + ei + '-' + ui).classList.add('hidden');
            document.getElementById('reject-confirmation-wrapper-' + ei + '-' + ui).classList.remove('hidden');
            return false;
        }
    </script>
</head>

<body>
<?php require_once('header.php'); ?>

<h1>Pending Volunteer Sign-Ups List</h1>
<?php if (isset($_GET['pendingSignupSuccess'])): ?>
    <div class="happy-toast">Sign-up request resolved successfully.</div>
<?php endif ?>

<main class="general">

    <p>
        <?php if (sizeof($pending) === 0):
            echo "There are 0 pending signups awaiting resolution.";
            ?>
        <?php elseif (sizeof($pending) === 1):
            echo "There is 1 pending signup awaiting resolution"; ?>
        <?php else: ?>
            <?php echo "There are " . htmlspecialchars(string: sizeof($pending)) . " pending signups awaiting resolution"; ?>
        <?php endif; ?>
    </p>

    <?php if (count(value: $pending) > 0): ?>
        <div class="table-wrapper">
            <table class="general">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Start Date</th>
                    <?php if ($access_level >= 2): ?>
                        <th>Demographic</th>
                    <?php endif; ?>
                    <?php if ($access_level >= 2): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php for ($x = 0; $x < sizeof($pending); $x++): ?>
                    <h2><?php $name = $pending[$x]['first_name']; ?></h2>

                    <?php
                    #$event = $pending[$x]['first_name'];
                    $user_id = $pending[$x]['id'];

                    //foreach ($events as $event):
                    #$user_info = ($event);
                    $position_label = 'p';
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user_id); ?></td>
                        <td><?php echo htmlspecialchars($name); ?></td>
                        <td><?php echo htmlspecialchars($pending[$x]['last_name']); ?></td>
                        <td>
                                  <!--  <?php echo htmlspecialchars($pending[$x]['start_date']); ?> -->
                                  <?php echo htmlspecialchars((string)$variable, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
<!--                        <td>--><?php //echo htmlspecialchars($position_label); ?><!--</td>-->
                        <!-- Demographic -->
                        <td>

                            <a
                                    href="viewProfile.php?id=<?php echo urlencode($user_id); ?>"><button class="button"><?php echo 'View ',htmlspecialchars($user_id); ?></button>
                            </a>
                        </td>
                        <!--Actions-->
                        <?php if ($access_level >= 2): ?>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="event_id" value="<?= $user_id; ?>">
                                    <input type="hidden" name="user_id"
                                           value="<?php echo htmlspecialchars($name); ?>">
                                </form>
                                <?php $ei = $user_id;
                                $ui = $name; ?>
                                <button onclick="showResolutionConfirmation('<?=$ei?>', '<?=$ui?>')" class="button">Decision</button>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <div id="resolution-confirmation-wrapper-<?= $user_id ?>-<?= $name ?>" class="modal-content hidden" style = "margin:auto">
                        <div class="modal-content">
                            <?php $en = $user_id;
                            $un = $name; ?>
                            <p>Would you like to approve or reject this sign-up request?</p>
                            <button onclick="showApprove('<?=$en?>', '<?=$un?>')" class="button success">Approve</button>
                            <button onclick="showReject('<?=$en?>', '<?=$un?>')" class="button danger">Reject</button>
                            <button
                                    onclick="document.getElementById('resolution-confirmation-wrapper-<?= $user_id ?>-<?= $name ?>').classList.add('hidden')"
                                    id="cancel-cancel" class="button cancel">Cancel</button>
                        </div>
                    </div>
                    <div id="approve-confirmation-wrapper-<?= $user_id ?>-<?= $name ?>" class="modal-content hidden" style = "margin:auto">
                        <div class="modal-content">
                            <p>Are you sure you want to approve this sign-up request?</p>
                            <p>This action cannot be undone</p>
                            <form method="post" action="approvedPendingVolunteer.php">
                                <input type="submit" value="Approve" class="button success">
                                <input type="hidden" name="id" value="<?= $user_id ?>">
                                <input type="hidden" name="user_id" value="<?= $name ?>">
<!--                                <input type="hidden" name="position" value="--><?php //= $position_label ?><!--">-->
<!--                                <input type="hidden" name="notes" value="--><?php //= $pending['notes'] ?><!--">-->
                            </form>
                            <button
                                    onclick="document.getElementById('approve-confirmation-wrapper-<?= $user_id ?>-<?= $name ?>').classList.add('hidden')"
                                    id="cancel-cancel" class="button cancel">Cancel</button>
                        </div>
                    </div>
                    <div id="reject-confirmation-wrapper-<?= $user_id ?>-<?= $name ?>" class="modal-content hidden" style = "margin:auto">
                        <div class="modal-content">
                            <p>Are you sure you want to reject this sign-up request?</p>
                            <p>This action cannot be undone </p>
                            <form method="post" action="deniedPendingVolunteer.php">
                                <input type="submit" value="Reject" class="button danger">
                                <input type="hidden" name="id" value="<?= $user_id ?>">
                                <input type="hidden" name="user_id" value="<?= $name ?>">
<!--                                <input type="hidden" name="position" value="--><?php //= $position_label ?><!--">-->
<!--                                <input type="hidden" name="notes" value="--><?php //= $pending['notes'] ?><!--">-->
                            </form>
                            <button
                                    onclick="document.getElementById('reject-confirmation-wrapper-<?= $user_id ?>-<?= $name ?>').classList.add('hidden')"
                                    id="cancel-cancel" class="button cancel">Cancel</button>
                        </div>
                    </div>
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