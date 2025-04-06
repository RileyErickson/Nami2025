<?php
//noah stafford branching test

    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
    session_cache_expire(30);
    session_start();

    ini_set("display_errors",1);
    error_reporting(E_ALL);

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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('include/input-validation.php');
        require_once('database/dbPersons.php');
        $args = sanitize($_POST, null);
        $required = array(

		);
        if (!wereRequiredFieldsSubmitted($args, $required)) {
            echo 'bad form data';
            die();
        }
        else if (!isset($_POST['volunteer']) && !isset($_POST['board']) && !isset($_POST['donator']) && !isset($_POST['admin'])){}
        else {
            $query = "email IS NOT NULL";
            $addedAny=FALSE;
            if (isset($_POST['admin'])){
                $query = $query . " AND (type='admin'";
                $addedAny=TRUE;
            }
            if (isset($_POST['volunteer'])){
                if ($addedAny==FALSE){
                    $addedAny=TRUE;
                    $query = $query . " AND (type='volunteer' OR type ='v'";
                }
                else{
                    $query = $query . " OR type='volunteer' OR type ='v'";
                }
            }
            if (isset($_POST['board'])){
                if ($addedAny==FALSE){
                    $addedAny=TRUE;
                    $query = $query . " AND (type='board'";
                }
                else{
                    $query = $query . " OR type='board'";
                }
            }
            if (isset($_POST['donator'])){
                if ($addedAny==FALSE){
                    $addedAny=TRUE;
                    $query = $query . " AND (type='donator'";
                }
                else{
                    $query = $query . " OR type='donator'";
                }
            }
            $query = $query . ")";
            $row = get_email($query);

        }
        
    }
    $date = null;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock | Search Emails</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Generate Email List</h1>
        <main class="date">
            <h2>Generate Email List</h2>
            <form id="new-animal-form" method="post">

                 <label><input type="checkbox" name = "admin" value = "y">  ADMIN   </label>

                 <label><input type="checkbox" name = "volunteer" value = "y">  VOLUNTEER   </label>

                 <label> <input type="checkbox" name = "board" value = "y">  BOARD MEMBER  </label>

                 <label><input type="checkbox" name = "donator" value = "y"> DONOR    </label>

                <label for="s"> </label>
               
                <input type="submit" value="Generate List">
            </form>
                <?php if ($date): ?>
                    <a class="button cancel" href="calendar.php?month=<?php echo substr($date, 0, 7) ?>" style="margin-top: -.5rem">Return to Calendar</a>
                <?php else: ?>
                    <a class="button cancel" href="index.php" style="margin-top: -.5rem">Return to Home Dashboard</a>
                <?php endif ?>

                <?php
                if (isset($row)){
                    echo '
                    <div class="table-wrapper">
                        <table class="general">
                            <thead>
                                <tr>
                                    <th>Email List</th>
                                </tr>
                            </thead>
                            <tbody class="standout">';
                    foreach($row as $x){
                        foreach($x as $z){
                            echo '
                                <tr>
                                    <td>' . $z . '</td>
                                </tr>';
                    }
                }
            }
            else{
                echo "Either there are no emails with the selected parameters, or you have yet to make a selection.";
            }
                ?>
        </main>
    </body>
    <?php require('footer.php'); ?>
</html>