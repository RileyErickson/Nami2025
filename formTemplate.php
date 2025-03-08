<?php
    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
    session_cache_expire(30);
    session_start();

    $loggedIn = false;
    $accessLevel = 0;
    $userID = null;
    $isAdmin = false;
    if (!isset($_SESSION['access_level']) || $_SESSION['access_level'] < 1) {
        header('Location: login.php');
        die();
    }
    if (isset($_SESSION['_id'])) {
        $loggedIn = true;
        // 0 = not logged in, 1 = standard user, 2 = manager (Admin), 3 super admin (TBI)
        $accessLevel = $_SESSION['access_level'];
        $isAdmin = $accessLevel >= 2;
        $userID = $_SESSION['_id'];
    } else {
        header('Location: login.php');
        die();
    }
    if ($isAdmin && isset($_GET['id'])) {
        require_once('include/input-validation.php');
        $args = sanitize($_GET);
        $id = strtolower($args['id']);
    } else {
        $id = $userID;
    }
    require_once('database/dbPersons.php');
    if (isset($_GET['removePic'])) {
      if ($_GET['removePic'] === 'true') {
        remove_profile_picture($id);
      }
    }

    $user = retrieve_person($id);
    $viewingOwnForms = $id == $userID;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <link rel="stylesheet" href="css/editprofile.css" type="text/css" />
        <title>Step VA | View User</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
	
    <body>
        <?php 
            require_once('header.php'); 
            require_once('include/output.php');
        ?>
		
		<h1>
			Form Submission
		</h1>
				
        <main class="general">
		
			<!-- if form has been submitted already
			<?php //if ($user->getApplicationId($id) != null): ?>
                <div class="error-toast">The root user does not have a profile.</div>
                </main></body></html>
                <?php //die() ?>
			-->
			
			<!-- if form hasn't been submitted -->
			<?php //else: ?>
				<fieldset class="section-box">
					<legend>
						<?php echo 'LINK TO FORM NAME' ?>
					</legend>
					
					<form action="" method="POST">
						<label>Reason to become <?php echo 'FORM TYPE' ?></label>
						<input type="text" name="reasontobecome"><br>
						
						<label>Why is now the right time?</label>
						<input type="text" name="whyisnowtherighttime"><br>
					
						<label>Status in recovery journey?</label>
						<input type="text" name="statusinrecoveryjourney"><br>
						
						<label>Screener name?</label>
						<select name="screenername" id="screenername">
							<option value="name1">Name 1</option>
							<option value="name2">Name 2</option>
							<option value="name3">Name 3</option>
						</select>
						
						<label>Screening date?</label>
						<input type="date" name="screeningdate"><br>
						
						<input type="submit">
					</form>
					
				</fieldset>
			<?php //endif ?>
        </main>
    </body>
</html>