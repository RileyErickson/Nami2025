<?php
    // Template for new VMS pages. Base your new page on this one

    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
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
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title>NAMI Rappahannock | Volunteer/Participant Search</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Volunteer/Participant Search</h1>
        <form id="person-search" class="general" method="get">
            <h2>Find Volunteer/Participant</h2>
            <?php 
                if (isset($_GET['name'])) {
                    require_once('include/input-validation.php');
                    require_once('database/dbPersons.php');
                    $args = sanitize($_GET);
                    $required = ['name', 'id', 'phone', 'zip', 'role', 'status'];
                    //var_dump($args);
                    if (!wereRequiredFieldsSubmitted($args, $required, true)) {
                        echo 'Missing expected form elements';
                    }
                    $name = $args['name'];
                    $id = $args['id'];
                    $phone = preg_replace("/[^0-9]/", "", $args['phone']);
					$zip = $args['zip'];
                    $role = $args['role'];
                    $status = $args['status'];
                    if (!($name || $id || $phone || $zip || $role || $status || FALSE)) {
                        echo '<div class="error-toast">At least <b>one search criterion is required.</b></div>';
                    } else if (!valueConstrainedTo($role, ['admin', 'participant', 'superadmin', 'volunteer', 'board', 'donator', ''])) {
                        echo '<div class="error-toast">The system did not understand your request.</div>';
                    } else if (!valueConstrainedTo($status, ['Active', 'Inactive', ''])) {
                        echo '<div class="error-toast">The system did not understand your request.</div>';
                    } 
                     else {
                        echo "<h3>Search Results</h3>";
                        $persons = find_users($name, $id, $phone, $zip, $role, $status, FALSE);
                        require_once('include/output.php');
                        if (count($persons) > 0) {
                            echo '
                            <div class="table-wrapper">
                                <table class="general">
                                    <thead>
                                        <tr>
                                            <th>First</th>
                                            <th>Last</th>
                                            <!--<th>Username</th>-->
                                            <th>Phone Number</th>
                                             <th>Email</th>
											<!--<th>Zip Code</th>-->
                                            <th>Role</th>
                                            <th>Archive Status</th>
                                            <th>Profile</th>
                                            <th>Edit Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="standout">';
                            $mailingList = '';
                            $notFirst = false;
                            foreach ($persons as $person) {
                                if ($notFirst) {
                                    $mailingList .= ', ';
                                } else {
                                    $notFirst = true;
                                }
                                $mailingList .= $person->get_email();
                                echo '
                                        <tr>
                                            <td>' . $person->get_first_name() . '</td>
                                            <td>' . $person->get_last_name() . '</td>
                                            <!--<td><a href="mailto:' . $person->get_id() . '">' . $person->get_id() . '</a></td>-->
                                            <td><a href="tel:' . $person->get_phone1() . '">' . formatPhoneNumber($person->get_phone1()) .  '</td>
                                            <td>' . $person->get_email() . '</td>
                                            <!--<td>' . $person->get_zip_code() . '</td>-->
                                            <td>';
                                             if (ucfirst($person->get_type()) == "Donator"){
                                                echo "Donor";
                                             }  
                                            else if (ucfirst($person->get_type()) == "Volunteer" || ucfirst($person->get_type()) == "V"){
                                                echo "Applicant";
                                             }  
                                             else 
                                             {
                                                echo ucfirst($person->get_type());}
                                             echo '</td>
                                            <td>' . ucfirst($person->get_status()) . '</td>
                                            <td><a href="viewProfile.php?id=' . $person->get_id() . '">Profile</a></td>
                                            <td><a href="modifyUserRole.php?id=' . $person->get_id() . '">Edit Permissions</a></td>

                                        </a></tr>';
                            }
                            echo '
                                    </tbody>
                                </table>
                            </div>';

                        } else {
                            echo '<div class="error-toast">Your search returned no results.</div>';
                        }
                    }
                    echo '<h3>Search Again</h3>';
                }
            ?>
            <p>Use the form below to find a volunteer or participant. At least one search criterion is required.</p>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php if (isset($name)) echo htmlspecialchars($_GET['name']) ?>" placeholder="Enter the user's first and/or last name">
            <label for="id">Username</label>
            <input type="text" id="id" name="id" value="<?php if (isset($id)) echo htmlspecialchars($_GET['id']) ?>" placeholder="Enter the user's username (login ID)">
           
		<label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?php if (isset($phone)) echo htmlspecialchars($_GET['phone']) ?>" placeholder="Enter the user's phone number">
            
		<label for="zip">Zip Code</label>
			<input type="text" id="zip" name="zip" value="<?php if (isset($zip)) echo htmlspecialchars($_GET['zip']) ?>" placeholder="Enter the user's zip code">
			<label for="role">Role</label>
 
           <select id="role" name="role">
                <option value="">Any</option>

                <option value="volunteer" <?php if (isset($role) && $role == 'volunteer') echo 'volunteer' ?>>volunteer</option>
                <option value="admin" <?php if (isset($role) && $role == 'admin') echo 'admin' ?>>Admin</option>
                <option value="board" <?php if (isset($role) && $role == 'board') echo 'board' ?>>Board Member</option>
                
                <option value="donator" <?php if (isset($role) && $role == 'donator') echo 'donator' ?>>Donor</option>
            </select>
  
          <label for="status">Archive Status</label>
            <select id="status" name="status">
                <option value="">Any</option>
                <option value="Active" <?php if (isset($status) && $status == 'Active') echo 'selected' ?>>Active</option>
                <option value="Inactive" <?php if (isset($status) && $status == 'Inactive') echo 'selected' ?>>Archived</option>
            </select>

                <?$photo_release = "Not Restricted"; ?>

            <div id="criteria-error" class="error hidden">You must provide at least one search criterion.</div>
            <input type="submit" value="Search">
            <a class="button cancel" href="volunteerDirectory.php">Return to Volunteer Management Dashboard</a>
        </form>
    </body>
    <?php require('footer.php'); ?>
</html>