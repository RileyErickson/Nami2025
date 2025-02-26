<?php
//noah stafford branching test

$ages = [
    "0", "1", "2", "3", "4", "5", "6", "7",
    "8", "9", "10", "11", "12", "13", "14", "15", 
    "16", "17", "18", "19", "20"
];

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
        require_once('database/dbAnimals.php');
        $args = sanitize($_POST, null);
        $required = array(
			"name", "breed", "age", "gender", "spay_neuter_done", "microchip_done"
		);
        if (!wereRequiredFieldsSubmitted($args, $required)) {
            echo 'bad form data';
            die();
        } else {
            $id = create_animal($args);
            if(!$id){
                echo "Oopsy!";
                die();
            }
            require_once('include/output.php');
            
            $name = htmlspecialchars_decode($args['name']);
            require_once('database/dbMessages.php');
            header("Location: animal.php?id=$id&createSuccess");
            die();
        }
    }
    $date = null;

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title> NAMIRAPP | Search Emails</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Generate Email List</h1>
        <main class="date">
            <h2>Generate Email List</h2>
            <form id="new-animal-form" method="post">

                <label for="admin">Admin *</label>
                <select id="admin" name="admin" required>
                <option value="n">Exclude</option>
                    <option value="y">Include</option>
                </select>
                <label for="volunteer">Volunteer *</label>
                <select id="volunteer" name="volunteer" required>
                <option value="n">Exclude</option>
                    <option value="y">Include</option>
                </select>
                <label for="board">Board Member *</label>
                <select id="board" name="board" required>
                <option value="n">Exclude</option>
                    <option value="y">Include</option>
                </select>
                <label for="donator">Donator *</label>
                <select id="donator" name="donator" required>
                    <option value="n">Exclude</option>
                    <option value="y">Include</option>
                    
                </select>

               
                <input type="submit" value="Generate List">
            </form>
                <?php if ($date): ?>
                    <a class="button cancel" href="calendar.php?month=<?php echo substr($date, 0, 7) ?>" style="margin-top: -.5rem">Return to Calendar</a>
                <?php else: ?>
                    <a class="button cancel" href="index.php" style="margin-top: -.5rem">Return to Dashboard</a>
                <?php endif ?>
        </main>
    </body>
</html>