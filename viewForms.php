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
        <link rel="stylesheet" href="css/base.css" type="text/css" />
        <title>Step VA | View User</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
	
    <body>
        <?php 
            require_once('header.php'); 
            require_once('include/output.php');
        ?>
		
		<?php if ($accessLevel == 0): ?>
        <h1>Consumer Forms</h1>
		<?php elseif ($accessLevel == 1): ?>
        <h1>Volunteer Forms</h1>
		<?php elseif ($accessLevel == 2 || $accessLevel == 3): ?>
        <h1>Forms</h1>
		<?php endif ?>
				
        <main class="general">
            <?php if ($id == 'vmsroots'): ?>
                <div class="error-toast">The root user cannot submit forms.</div>
                </main></body></html>
                <?php die() ?>
            <?php elseif (!$user): ?>
                <div class="error-toast">Must be signed in to submit forms.</div>
                </main></body></html>
                <?php die() ?>
            <?php endif ?>
			
            <?php if ($viewingOwnForms): ?>
                <h2>Your Forms</h2>
            <?php else: ?>
                <h2>Viewing <?php echo $user->get_first_name() . ' ' . $user->get_last_name() ?>'s Forms</h2>
            <?php endif ?>

            <fieldset class="section-box">
				
				<?php if($accessLevel == 1 || $accessLevel == 2 || $accessLevel == 3): ?>
					<!-- Links to volunteer forms can be added here -->
					<div>
						<div class="field-pair">
							<label>F2F Application</label>
							<p>
								This is a consumer form. A longer description of the form to be submitted can be added here.
								<br>
							</p>
							<form action="editForm.php" method="POST">
								<input type="hidden" id="formname" name="formname" value="F2FApplication">
								<button style="width:16%;">Submit/Edit</button>
							</form>
						</div>
						
						<div class="field-pair">
							<label>FSG Application</label>
							<p>
								This is a volunteer form. A longer description of the form to be submitted can be added here.
								<br>
							</p>
							<form action="editForm.php" method="POST">
								<input type="hidden" id="formname" name="formname" value="FSGApplication">
								<button style="width:16%;">Submit/Edit</button>
							</form>
						</div>
						
						<div class="field-pair">
							<label>HF Application</label>
							<p>
								This is a volunteer form. A longer description of the form to be submitted can be added here.
								<br>
							</p>
							<form action="editForm.php" method="POST">
								<input type="hidden" id="formname" name="formname" value="HFApplication">
								<button style="width:16%;">Submit/Edit</button>
							</form>
						</div>

						<div class="field-pair">
							<label>P2P Application</label>
							<p>
								This is a consumer form. A longer description of the form to be submitted can be added here.
								<br>
							</p>
							<form action="editForm.php" method="POST">
								<input type="hidden" id="formname" name="formname" value="P2PApplication">
								<button style="width:16%;">Submit/Edit</button>
							</form>
						</div>
						
						<div class="field-pair">
							<label>IOOV Application</label>
							<p>
								This is a consumer form. A longer description of the form to be submitted can be added here.
								<br>
							</p>
							<form action="editForm.php" method="POST">
								<input type="hidden" id="formname" name="formname" value="IOOVApplication">
								<button style="width:16%;">Submit/Edit</button>
							</form>
						</div>
						
						<div class="field-pair">
							<label>CSG Application</label>
							<p>
								This is a consumer form. A longer description of the form to be submitted can be added here.
								<br>
							</p>
							<form action="editForm.php" method="POST">
								<input type="hidden" id="formname" name="formname" value="CSGApplication">
								<button style="width:16%;">Submit/Edit</button>
							</form>
						</div>
					</div>
				<?php endif ?>
            </fieldset>
			<a class="button cancel" href="index.php">Return to Dashboard</a>
        </main>
    </body>
</html>