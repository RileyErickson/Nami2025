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
	
	if (isset($_POST['action'])) {
		if ($_POST['action'] == "create") {
			// Create a new form in the database
			if (isset($_POST['numquestions'])) {
				$numquestions = $_POST['numquestions'];
			}
			if (isset($_POST['formname'])) {
				$formname = $_POST['formname'];
			}
			if (isset($_POST['isopen'])) {
				$isopen = $_POST['isopen'];
			} else {
				$isopen = 0;
			}
			$formnameclean = str_replace(' ', '', $formname);
			$formnameclean = strtolower($formnameclean);
			
			$errorcount = 0;
			
			[$toast, $message] = addForm($formnameclean, $formname, $numquestions, $isopen);
			if ($toast == "error") {
					$errorcount++;
			}
			
			if ($errorcount == 0) {
				// add questions to form
				for ($i=1; $i<=$numquestions; $i++) {
					[$toast, $message] = addQuestion($formnameclean, $formname, $i, $_POST[$i]);
					if ($toast == "error") {
						$errorcount++;
					}
				}
			}
			
			[$toast, $message] = createAnswerTable($formnameclean, $numquestions);
			if ($toast == "error") {
					$errorcount++;
			}
			
			// if everything gets done
			if ($errorcount == 0) {
				$message = "Form created successfully!";
				$toast = "happy";
			}
			
		} else if ($_POST['action'] == "update") {
			
			// Editing a form, not creating a new one
			if (isset($_POST['numquestions'])) {
				$numquestions = $_POST['numquestions'];
			}
			if (isset($_POST['formname'])) {
				$formname = $_POST['formname'];
			}
			if (isset($_POST['isopen'])) {
				$isopen = $_POST['isopen'];
			} else {
				$isopen = 0;
			}
			$formnameclean = str_replace(' ', '', $formname);
			$formnameclean = strtolower($formnameclean);
			
			$errorcount = 0;
			
			for ($i=1; $i<=$numquestions; $i++) {
				$q = getQuestion($formnameclean, $i);
				[$toast, $message] = editQuestion($formnameclean, $formname, $i, $_POST[$i]);
				if ($toast == "error") {
					$errorcount++;
				}
			}
			
			[$toast, $message] = editOpen($formnameclean, $isopen);
			if ($toast == "error") {
					$errorcount++;
			}
			
		} else if ($_POST['action'] == "delete") {
			
			// Deleting a form from the database
			if (isset($_POST['formnameclean'])) {
				$formnameclean = $_POST['formnameclean'];
			}
			
			[$toast, $message] = dropForm($formnameclean);
			$button = "
					<form action=\"createForm.php\" method=\"POST\" style=\"margin:10px;\">
						<input type=\"hidden\" id=\"mode\" name=\"mode\" value=\"view\">
						<input type=\"submit\" value=\"Return to Form Manager\">
					</form>
					";
		}
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
			Form Management
		</h1>
		
		<?php 
			if ($accessLevel < 2) {
				echo "<div class=\"error-toast\"> This page is only accessible to administrators.</div>";
				echo "</main></body></html>";
				die();
			}
			
			if (isset($message)) {
				echo "<div class=\"" . $toast ."-toast\">" . $message . "</div>";
			}
		?>
		
		<main class="general">
			<?php
			if (!(isset($mode)) || $mode == "view") {?>
			
			<!-- VIEWING CREATED FORMS -->
				<fieldset class="section-box">
					<legend>
						Current Forms:
					</legend>
						
					<table>
						<?php
							$forms = getForms();
							if ($forms->num_rows !== 0) {
								while ($row = mysqli_fetch_array($forms, MYSQLI_NUM)) {
									echo "<tr>";
									
									echo "<td style=\"padding:10px; width:60%;\">";
									echo "<form action=\"createForm.php\" method=\"POST\">";
									echo "<input type=\"hidden\" id=\"mode\" name=\"mode\" value=\"edit\">";
									echo "<input type=\"hidden\" id=\"numquestions\" name=\"numquestions\" value=\"" . getNumQuestions($row[0]) . "\">";
									echo "<input type=\"hidden\" id=\"formnameclean\" name=\"formnameclean\" value=\"" . $row[0] . "\">";
									echo "<input type=\"hidden\" id=\"formname\" name=\"formname\" value=\"" . getFormName($row[0]) . "\">";
									echo getFormName($row[0]);
									echo "</td>";
									
									echo "<td style=\"padding:10px;\">";
									echo "<input type=\"submit\" value=\"Edit Form\">";
									echo "</form>";
									echo "</td>";
									
									echo "<td style=\"padding:10px;\">";
									echo "<form action=\"createForm.php\" method=\"POST\">";
									echo "<input type=\"hidden\" id=\"mode\" name=\"mode\" value=\"delete\">";
									echo "<input type=\"hidden\" id=\"formnameclean\" name=\"formnameclean\" value=\"" . $row[0] . "\">";
									echo "<input type=\"submit\" value=\"Delete Form\">";
									echo "</form>";
									echo "</td>";
									echo "</tr>";
								}
							} else {
								echo "No forms created yet!";
							}
						?>
					</table>
					
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
						
						<input type="submit" value="Make New Form">
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
						if (isset($_POST['formnameclean'])) {
							$formnameclean = $_POST['formnameclean'];
							$formname = getFormName($formnameclean);
							echo $formname;
						} else {
							if (isset($_POST['formname'])) {
								$formname = $_POST['formname'];
								$formnameclean = str_replace(' ', '', $formname);
								$formnameclean = strtolower($formnameclean);
								echo $formname;
							}
						}
						?>
					</legend>
					
					<form action="createForm.php" method="POST" style="margin-top:10px;">
						<!-- go back to view page after creating a new form -->
						<input type="hidden" id="mode" name="mode" value="view">
						<?php
							if (checkForm($formnameclean)) {
								echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"update\">";
							} else {
								echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"create\">";
							}
						?>
						<!-- ensure name gets passed to creation -->
						<input type="hidden" id="formname" name="formname" value="<?php echo $formname; ?>">
							<?php
								if (isset($_POST['numquestions'])) {
									$numquestions = $_POST['numquestions'];
								}
								echo "<input type=\"hidden\" id=\"numquestions\" name=\"numquestions\" value=\"" . $numquestions . "\">";
								
								for ($i=1; $i <= $numquestions; $i++) {
									echo "<label>Question " . $i . ":</label>";
									echo "<input type=\"text\" id=\"" . $i . "\" name=\"" . $i . "\" value=\"";
									// if editing a pre-existing form
									if (checkForm($formnameclean)) {
										echo getQuestion($formnameclean, $i);
									}
									echo "\">";
								}
							?>
							<label for="isopen">Submissions open?</label>
							<label class="switch">
							<input type="checkbox" name="isopen" id="isopen" value="1" <?php if (checkForm($formnameclean)) { if (getOpen($formnameclean)) { echo "checked"; } } ?>>
							<span class="slider"></span>
							</label>
							
						<input type="submit" value="Edit Form">
					</form>
				</fieldset>
			<?php
			} else if ($mode == "delete") {
			?>
			
				<!-- DELETING A FORM -->
				<fieldset class="section-box">
					<legend>
						Deleting Form: 
						<?php
						if (isset($_POST['formnameclean'])) {
							$formnameclean = $_POST['formnameclean'];
							$formname = getFormName($formnameclean);
							echo $formname;
						} else {
							if (isset($_POST['formname'])) {
								$formname = $_POST['formname'];
								echo $formname;
							}
						}
						?>
					</legend>
					
					<form action="createForm.php" method="POST" style="margin-top:10px;">
						<!-- go back to view page after deleting a new form -->
						<input type="hidden" id="mode" name="mode" value="view">
						<input type="hidden" id="action" name="action" value="delete">
						<!-- ensure name gets passed to creation -->
						<input type="hidden" id="formnameclean" name="formnameclean" value="<?php echo $formnameclean; ?>">
						<p style="color:red; text-align:center; font-weight:bold;">WARNING: This action will delete all data associated with the selected form, including user responses. Be absolutely certain that this data is no longer needed. </p>
						<input type="submit" value="Yes, I'm sure. Delete this form.">
					</form>
					<a href="/createForm.php" style="text-align:center;">No, go back.</a>
				</fieldset>
			<?php
			}
			?>
		
		</main>
    </body>
</html>