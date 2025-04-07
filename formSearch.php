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
        <title>NAMI Rappahannock | Submitted Form  Search</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Submitted Form Search</h1>
        <form id="person-search" class="general" method="get">
            <h2>Find Volunteer/Participant</h2>
            <?php 
                if (isset($_GET['role'])) {
                    require_once('include/input-validation.php');
                    require_once('database/dbForms.php');
                    $args = sanitize($_GET);
                    $required = ['role'];
                    //var_dump($args);
                    $role = $args['role'];
                    if (!($role)) {
                        echo '<div class="error-toast">At least one search criterion is required.</div>';
                    }
                     else {
                        echo "<h3>Search Results</h3>";
                    $persons = get_forms_id($role);
                    if ($role == "F2F"){
                        $formName = "Family to Family";
                        $formVariable = "f2fApplicationID";
                    }
                    else if ($role == "P2P"){
                        $formName = "Peer to Peer";
                        $formVariable = "p2pApplicationID";
                    }
                    else if ($role == "IOOV"){
                        $formName = "In Our Own Voice";
                        $formVariable = "ioovApplicationID";
                    }
                    else if ($role == "CSG"){
                        $formName = "Connection Support Group";
                        $formVariable = "csgApplicationID";                
                    }
                    else if ($role == "FSG"){
                        $formName = "Family Support Groups";
                        $formVariable = "fsgApplicationID";
                    }
                    else if ($role == "HF"){
                        $formName = "Homefront";
                        $formVariable = "hfApplicationID";
                    }
                    if ($persons == NULL){  
                        echo '<div class="error-toast">Your search returned no results.</div>';;}
                    else{
                        require_once('include/output.php');
                        if (count($persons) > 0) {
                            echo '
                            <div class="table-wrapper">
                                <table class="general">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Form Number</th>
                                            <th>Form</th>';
                                            if ($role=="F2F" OR  $role=="FSG" OR  $role=="HF"){
                                                echo '<th>Reason</th> <th>Why Now</th> <th>Screener Name</th> <th>Screener Date</th>';
                                            }
                                            else {
                                                echo '<th>Reason</th> <th>Why Now</th> <th>Recovery Status</th> <th>Screener Name</th> <th>Screener Date</th>';
                                            }

                                        echo '
                                        <th>Form Actions</th><th></th>
                                            </tr>
                                    </thead>
                                    <tbody class="standout">';
                            $mailingList = '';
                            $notFirst = false;
                            foreach ($persons as $person) {
                                echo '
                                        <tr>
                                            <td>'.get_name_from_id($person['id']).'</td>
                                            <td>' . $person['id'] . '</td>
                                            <td>' . $person[$formVariable] . '</td> <td>' . $formName . '</td>'
                                            ;

                                            
                                            if ($role=="F2F"){
                                                echo  '<td>' . $person['reasonToBecomeF2F'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="FSG"){
                                                echo  '<td>' . $person['reasonToBecomeFSG'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="HF"){
                                                echo  '<td>' . $person['reasonToBecomeHF'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="P2P"){
                                                echo  '<td>' . $person['reasonToBecomeP2P'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['statusInRecoveryJourney'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="IOOV"){
                                                echo  '<td>' . $person['reasonToBecomeIOOV'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['statusInRecoveryJourney'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="CSG"){	
                                                echo  '<td>' . $person['reasonToBecomeCSG'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['statusInRecoveryJourney'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            echo 
                                            '                            <td>
                            <a class="button" href="index.php">Approve</a> </td>
                                                                                                   <td>
                            <a class="button cancel" href="index.php">Reject</a> </td>
                            
                                           </a></tr>';
                            }}
                            echo '

                                    </tbody>
                                </table>
                            </div>';

                        //} else {
                        //    echo '<div class="error-toast">Your search returned no results.</div>';
                        //}
                    }}
                    echo '<h3>Search Again</h3>';
                }
            ?>
            <p>Use the form below to find a volunteer or participant. At least one search criterion is required.</p>

			<label for="role">Form Type</label>
 
           <select id="role" name="role">
                <option value="">Select</option>
                <option value="F2F" <?php if (isset($role) && $role == 'F2F') echo 'F2F' ?>>F2F</option>
                <option value="P2P" <?php if (isset($role) && $role == 'P2P') echo 'P2P' ?>>P2P</option>
                <option value="IOOV" <?php if (isset($role) && $role == 'IOOV') echo 'IOOV' ?>>IOOV</option>
                <option value="CSG" <?php if (isset($role) && $role == 'CSG') echo 'CSG' ?>>CSG</option>
                
                <option value="FSG" <?php if (isset($role) && $role == 'FSG') echo 'FSG' ?>>FSG</option>
                <option value="HF" <?php if (isset($role) && $role == 'HF') echo 'HF' ?>>HF</option>
            </select>


            <div id="criteria-error" class="error hidden">You must provide at least one search criterion.</div>
            <input type="submit" value="Search">
            <a class="button cancel" href="index.php">Return to Dashboard</a>
        </form>
    </body>
</html>