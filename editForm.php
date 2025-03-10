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
	
	if (isset($_POST["formname"])) {
		$formname = $_POST["formname"];
	}

    require_once('database/dbForms.php');
	switch ($formname) {
		case "F2FApplication":
			$formattedName = "F2F";
			break;
		case "P2PApplication":
			$formattedName = "P2P";
			break;
		case "IOOApplication":
			$formattedName = "IOO";
			break;
		case "CSGApplication":
			$formattedName = "CSG";
			break;
		case "FSGApplication":
			$formattedName = "FSG";
			break;
		case "HFApplication":
			$formattedName = "HF";
			break;
	}

    $user = retrieve_person($id);
    $viewingOwnForms = $id == $userID;
	
	$appID = get_application_id($id, $formname);
	
	/* setting values for editing */
	if ($appID != 0 && isset($_POST['submitted'])) {
		update_reasontobecome($id, $formname, $_POST['reasontobecome']);
		update_whyisnowrighttime($id, $formname, $_POST['whyisnowrighttime']);
		if (isset($_POST['statusinrecoveryjourney'])) {
			update_statusinrecoveryjourney($id, $formname, $_POST['statusinrecoveryjourney']);
		}
		update_screenername($id, $formname, $_POST['screenername']);
		update_screeningdate($id, $formname, $_POST['screeningdate']);
		
		unset($_POST['submitted']);
		unset($_POST['reasontobecome']);
		unset($_POST['whyisnowrighttime']);
		unset($_POST['statusinrecoveryjourney']);
		unset($_POST['screenername']);
		unset($_POST['screeningdate']);
	}
	
	/* setting values for a new application */
	if ($appID == 0 && isset($_POST['submitted'])) {
		
		if (!(isset($_POST['statusinrecoveryjourney']))) {
			$_POST['statusinrecoveryjourney'] = NULL;
		}
		
		create_application($formname, $id, $_POST['reasontobecome'], $_POST['whyisnowrighttime'], $_POST['statusinrecoveryjourney'], $_POST['screenername'], $_POST['screeningdate']);
		
		unset($_POST['submitted']);
		unset($_POST['reasontobecome']);
		unset($_POST['whyisnowrighttime']);
		unset($_POST['statusinrecoveryjourney']);
		unset($_POST['screenername']);
		unset($_POST['screeningdate']);
	}
	
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <link rel="stylesheet" href="css/base.css" type="text/css" />
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
			
				<fieldset class="section-box">
					<legend>
						<?php echo $formattedName; ?> Application
					</legend>
					
					<form action="" method="POST">
						<label>Reason to become <?php echo $formattedName; ?>?</label>
						<input type="text" name="reasontobecome" value="<?php echo get_reasontobecome($appID, $formname); ?>"><br>
						
						<label>Why is now the right time?</label>
						<input type="text" name="whyisnowrighttime" value="<?php echo get_whyisnowrighttime($appID, $formname); ?>"><br>
					
						<?php if ($formname != 'FSGApplication' && $formname != 'HFApplication' && $formname != 'F2FApplication') {
							echo "<label>Status in recovery journey?</label>";
							echo "<input type=\"text\" name=\"statusinrecoveryjourney\" value=\"" . get_statusinrecoveryjourney($appID, $formname) . "\"><br>";
						}
						?>
						
						<label>Screener name?</label>
						<select name="screenername" id="screenername" value="<?php echo get_screenername($appID, $formname); ?>">
							<option value="name1">Name 1</option>
							<option value="name2">Name 2</option>
							<option value="name3">Name 3</option>
						</select>
						
						<label>Screening date?</label>
						<input type="date" name="screeningdate" value="<?php echo get_screeningdate($appID, $formname); ?>"><br>
						
						<input type="hidden" name="submitted" id="submitted" value="true">
						
						<input type="hidden" name="formname" id="formname" value="<?php echo $formname; ?>">
						
						<input type="submit">
					</form>
					
				</fieldset>
			<?php //endif ?>
        </main>
    </body>
</html>