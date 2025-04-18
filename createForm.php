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
	if (isset($_POST['mode'])) {
		$mode = $_POST['mode'];
	}
	
	// create a new form on submission
	if (isset($_POST['create'])) {
		$numquestions = $_POST['numquestions'];
		$formname = $_POST['formname'];
		addForm($formname);
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
			<?php
			if (!(isset($mode))) {?>
			
			<!-- VIEWING CREATED FORMS -->
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
						<input type="submit" value="Create New Form">
					</form>
					
				</fieldset>
			<?php
			} else if ($mode == "create") {?>
			
			<!-- NEW FORM SETUP -->
				<fieldset class="section-box">
					<legend>
						Create Form:
					</legend>
					
					<form action="createForm.php" method="POST" style="margin-top:10px;">
						<!-- go back to view page after creating a new form -->
						<input type="hidden" id="mode" name="mode" value="edit"> 
						
						<label>Form Title: </label>
						<input type="text" id="formname" name="formname">
						
						<label>Number of Questions: </label>
						<select name="numquestions" id="numquestions" style="margin-bottom:40px;">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
						
						<input type="Make New Form">
					</form>
				</fieldset>
			<?php
			} else if ($mode == "edit") {
			?>
			
			<!-- EDITING FORM -->
				<fieldset class="section-box">
					<legend>
						Editing Form: 
						<?php
						if (isset($_POST['formname'])) {
							$formname = $_POST['formname'];
							echo $formname;
						}
						?>
					</legend>
					
					<form action="createForm.php" method="POST" style="margin-top:10px;">
						<!-- go back to view page after creating a new form -->
						<input type="hidden" id="mode" name="mode" value="view">
						<input type="hidden" id="createform" name="createform" value="true">
						<!-- ensure name gets passed to creation -->
						<input type="hidden" id="formname" name="formname" value="<?php echo $formname; ?>">
							<?php
								if (isset($_POST['numquestions'])) {
									$numquestions = $_POST['numquestions'];
								}
								
								for ($i=0; $i < $numquestions; $i++) {
									echo "<label>Question " . $i . ":</label>";
									echo "<input type=\"text\" id=\"" . $i . "\" name=\"" . $i . "\">";
								}
							?>
						<input type="submit" value="Submit New Form">
					</form>
				</fieldset>
			<?php
			}
			?>
		
		</main>
    </body>
</html>