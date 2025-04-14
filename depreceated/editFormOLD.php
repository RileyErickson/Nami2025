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
		case "f2fapplication":
			$formattedName = "f2f";
			break;
		case "p2papplication":
			$formattedName = "p2p";
			break;
		case "ioovapplication":
			$formattedName = "ioov";
			break;
		case "csgapplication":
			$formattedName = "csg";
			break;
		case "fsgapplication":
			$formattedName = "fsg";
			break;
		case "hfapplication":
			$formattedName = "hf";
			break;
	}

    $user = retrieve_person($id);
    $viewingOwnForms = $id == $userID;
	
	$appID = get_appID($userID, $formname);
	
	/* setting values for editing */
	if (isset($_POST['submitted']) && ($_POST['reasontobecome'] == "" || $_POST['whyisnowrighttime'] == "" || $_POST['statusinrecoveryjourney'] == "" || $_POST['screeningdate'] == "")) {
		$message = "All fields are required.";
		$toast = "error";
	} else if ($appID != 0 && isset($_POST['submitted'])) {
		/* update old application */
		update_reasontobecome($appID, $formname, $_POST['reasontobecome']);
		update_whyisnowrighttime($appID, $formname, $_POST['whyisnowrighttime']);
		if (isset($_POST['statusinrecoveryjourney'])) {
			update_statusinrecoveryjourney($appID, $formname, $_POST['statusinrecoveryjourney']);
		}
		update_screenername($appID, $formname, $_POST['screenername']);
		update_screeningdate($appID, $formname, $_POST['screeningdate']);
		
		unset($_POST['submitted']);
		unset($_POST['reasontobecome']);
		unset($_POST['whyisnowrighttime']);
		unset($_POST['statusinrecoveryjourney']);
		unset($_POST['screenername']);
		unset($_POST['screeningdate']);
		
		$message = "application updated!";
		$toast = "happy";
	} else if (isset($_POST['submitted'])) {
		/* new application creation */
		if (!(isset($_POST['statusinrecoveryjourney']))) {
			$_POST['statusinrecoveryjourney'] = NULL;
		}
		
		create_application($formname, $userID, $_POST['reasontobecome'], $_POST['whyisnowrighttime'], $_POST['statusinrecoveryjourney'], $_POST['screenername'], $_POST['screeningdate']);
		
		unset($_POST['submitted']);
		unset($_POST['reasontobecome']);
		unset($_POST['whyisnowrighttime']);
		unset($_POST['statusinrecoveryjourney']);
		unset($_POST['screenername']);
		unset($_POST['screeningdate']);
		
		$message = "application created!";
		$toast = "happy";
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
		
		<?php 
			if (isFormOpen($formname) == 0) {
				echo "<div class=\"error-toast\"> Submissions for this form are closed, please contact an administrator if you believe you are seeing this page in error.</div>";
				echo "</main></body></html>";
				die();
			}
		
			if (isset($message)) {
				echo "<div class=\"" . $toast ."-toast\">" . $message . "</div>";
			}
		?>
		
				
        <main class="general">
			
				<fieldset class="section-box">
					<legend>
						<?php echo $formattedName; ?> application
					</legend>
					
					<form action="" method="POST">
						<label>Reason to become <?php echo $formattedName; ?>?</label>
						<input type="text" name="reasontobecome" value="<?php echo get_reasontobecome($appID, $formname); ?>"><br>
						
						<label>Why is now the right time?</label>
						<input type="text" name="whyisnowrighttime" value="<?php echo get_whyisnowrighttime($appID, $formname); ?>"><br>
					
						<?php if ($formname != 'fsgapplication' && $formname != 'hfapplication' && $formname != 'f2fapplication') {
							echo "<label>Status in recovery journey?</label>";
							echo "<input type=\"text\" name=\"statusinrecoveryjourney\" value=\"" . get_statusinrecoveryjourney($appID, $formname) . "\"><br>";
						}
						?>
						
						<label>Screener name?</label>
						<select name="screenername" id="screenername" value="<?php echo get_screenername($appID, $formname); ?>" style="margin-bottom:10px;">
							<option value="name1">Name 1</option>
							<option value="name2">Name 2</option>
							<option value="name3">Name 3</option>
						</select>
						
						<label>Screening date?</label>
						<input type="date" name="screeningdate" value="<?php echo get_screeningdate($appID, $formname); ?>"><br>
						
						<input type="hidden" name="submitted" id="submitted" value="true">
						
						<input type="hidden" name="formname" id="formname" value="<?php echo $formname; ?>">

						<?php 
						
						if ($formname == 'fsgapplication') {

							echo "<br>";
							echo "<legend>NAMI Family Support Group Program Eligibility Checklist</legend>";
							echo "<p><i>Please confirm you meet the guidelines by checking each requirement.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am a family member, close friend, or someone with a &quot;like family&quot; relationship with a loved one living with mental illness.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to complete training and uphold the fidelity of the NAMI Family Support Group model.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am open to identifying and encouraging potential new facilitators from the support group.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to provide participant data as required.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have experience with or a positive regard for mutual support groups.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have a support system (friends, peers, family, support groups, etc.) to help me succeed in this role and other areas of my life.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have access to a computer and the internet to complete online training and maintain communication with my affiliate, NAMI Virginia, and NAMI.</p>";
							echo "<br>";

						}

						if ($formname == 'hfapplication') {

							echo "<br>";
							echo "<legend>NAMI Homefront Program Eligibility Checklist</legend>";
							echo "<p><i>Please confirm you meet the guidelines by checking each requirement.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am a family member, close friend, or someone with a &quot;like family&quot; relationship with a veteran living with mental illness.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am comfortable reading aloud, as parts of the course must be read to the class.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to complete training and uphold the fidelity of the NAMI Homefront class.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have the stamina and stability to carry out course duties (logistics, data entry, and co-facilitating the 8-week course).</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have a support system (friends, peers, family, support groups, etc.) to help me succeed in this role and other areas of my life.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have access to a computer and the internet to complete online training and maintain communication with my affiliate, NAMI Virginia, and NAMI.</p>";
							echo "<br>";

						}

						if ($formname == 'csgapplication') {

							echo "<br>";
							echo "<legend>NAMI Connection Support Group Program Eligibility Checklist</legend>";
							echo "<p><i>Please confirm you meet the guidelines by checking each requirement.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have lived experience with mental health symptoms.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to complete training and uphold the fidelity of the NAMI Connection Support Group model.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am on the path of recovery.</p>";
							echo "<p><i>Recovery is defined as a process through which individuals improve their health and wellness, live a self-directed life, and strive to reach their full potential.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am open to identifying and encouraging potential new facilitators from the support group.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to provide participant data as required.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have experience with or a positive regard for mutual support groups.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have a support system (friends, peers, family, support groups, etc.) to help me succeed in this role and other areas of my life.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have access to a computer and the internet to complete online training and maintain communication with my affiliate, NAMI Virginia, and NAMI.</p>";
							echo "<br>";

						}

						if ($formname == 'p2papplication') {

							echo "<br>";
							echo "<legend>NAMI Peer-to-Peer Program Eligibility Checklist</legend>";
							echo "<p><i>Please confirm you meet the guidelines by checking each requirement.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have lived experience with mental health symptoms.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am comfortable reading aloud, as parts of the course must be read to the class.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to complete training and uphold the fidelity of the NAMI Peer-to-Peer class.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am on the path of recovery.</p>";
							echo "<p><i>Recovery is defined as a process through which individuals improve their health and wellness, live a self-directed life, and strive to reach their full potential.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have the stamina and stability to carry out course duties (logistics, data entry, and co-facilitating the 8-week course).</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have a support system (friends, peers, family, support groups, etc.) to help me succeed in this role and other areas of my life.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have access to a computer and the internet to complete online training and maintain communication with my affiliate, NAMI Virginia, and NAMI.</p>";
							echo "<br>";

						}

						if ($formname == 'ioovapplication') {

							echo "<br>";
							echo "<legend>NAMI In Our Own Voice Program Eligibility Checklist</legend>";
							echo "<p><i>Please confirm you meet the guidelines by checking each requirement.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to undergo training and adhere to the NAMI In Our Own Voice program model.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have lived experience with mental health symptoms.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am on the path of recovery.</p>";
							echo "<p><i>Recovery is defined as a process through which individuals improve their health and wellness, live a self-directed life, and strive to reach their full potential.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I will report presentation data.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have a support system (friends, peers, family, support groups, etc.) to help me succeed in this role and other areas of my life.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to share my experience with mental illness in front of a group.</p>";
							echo "<br>";

						}

						if ($formname == 'f2fapplication') {

							echo "<br>";
							echo "<legend>NAMI Family-to-Family Program Eligibility Checklist</legend>";
							echo "<p><i>Please confirm you meet the guidelines by checking each requirement.</i></p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am a family member, close friend, or someone with a &quot;like family&quot; relationship with a loved one living with mental illness.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am comfortable reading aloud, as parts of the course must be read to the class.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I am willing to complete training and uphold the fidelity of the NAMI Family-to-Family class.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have the stamina and stability to carry out course duties (logistics, data entry, and co-facilitating the 8-week course).</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have a support system (friends, peers, family, support groups, etc.) to help me succeed in this role and other areas of my life.</p>";
							echo "<p><input type=\"checkbox\" class=\"check-item\" name=\"eligibility\" required> I have access to a computer and the internet to complete online training and maintain communication with my affiliate, NAMI Virginia, and NAMI.</p>";
							echo "<br>";

						}


						?>
						
						<input type="submit">
						
						<a class="button cancel" href="viewForms.php" style="margin-top: .5rem">Return to Forms Dashboard Without Saving</a>
					</form>
					
				</fieldset>
				
			<?php //endif ?>
        </main>
    </body>
	<?php require('footer.php'); ?>
</html>