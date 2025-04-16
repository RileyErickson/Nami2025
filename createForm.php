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

    require_once('database/dbForms.php');

    $user = retrieve_person($id);
    $viewingOwnForms = $id == $userID;
	if (!(isset($mode))) {
		$mode = "view";
	} else {
		$mode = $_POST['mode'];
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
			Form Creation
		</h1>
		
		<?php 
			if ($accessLevel < 2) {
				echo "<div class=\"error-toast\"> This page is only accessible to administrators.</div>";
				echo "</main></body></html>";
				die();
			}
		?>
		
		<main class="general">
			
			<!-- VIEWING CREATED FORMS -->
			<?php
			if ($mode == "view") {?>
				<fieldset class="section-box">
					<legend>
						Current Forms:
					</legend>
						
					<p>
						<?php
							$forms = getForms();
							if ($forms != 0) {
								for ($i = 0; $i < count($forms); $i++) {
									echo "<form action=\"editForm.php\" method=\"POST\">";
									echo "<input type=\"hidden\" id=\"formname\" name=\"formname\" value=\"" . $forms[$i] . "\">";
									echo "<button style=\"width:50%;\">" . $forms[$i] . "</button>";
								}
							} else {
								echo "No forms created yet!";
							}
						?>
					</p>
					
					<form action="createForm.php" method="POST" style="margin-top:10px;">
						<input type="hidden" id="mode" name="mode" value="create">
						<button style="width:24%; align-self:center;">Create New Form</button>
					</form>
				</fieldset
			<?php
			} else if ($mode == "create") {?>
			
			
			<!-- CREATING NEW FORM -->
			<?php
			}
			?>
		
		</main>
    </body>
</html>