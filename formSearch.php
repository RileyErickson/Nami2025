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
    <main>
        <form id="person-search" class="general" method="get">
            <h2>Find Volunteer/Participant</h2>
            <?php 
            require_once('database/dbForms.php');
                    if (isset($_GET['formType'])){
                        approve_form($_GET["formNumber"],$_GET["formType"]);
                        echo '<div class="happy-toast">The '.$_GET["formType"].' form has been approved!</div>';
                    }
                    else if (isset($_GET['unformType'])){
                        unapprove_form($_GET["unformNumber"],$_GET["unformType"]);
                        echo '<div class="happy-toast">The '.$_GET["unformType"].' form has been unapproved!</div>';
                    }
                    if (isset($_GET['role'])) {
                    require_once('include/input-validation.php');
                    
                    $args = sanitize($_GET);
                    $required = ['role'];
                    $role = $args['role'];
                    if (!($role)) {
                            if (!isset($_GET['formType']) && !isset($_GET['unformType'])){
                                echo '<div class="error-toast">The "Form Type" criterion is required.</div>';   
                            }
                    }
                     else {
                        echo "<h3>Search Results</h3>";
                    if (!isset($_GET['status'])){
                        $status="*";
                    }
                    else{
                        $status=$_GET['status'];
                    }
                        $persons = get_forms_id($role,$status);
                    
                    if ($role == "f2f"){
                        $formName = "Family to Family";
                        $formVariable = "f2fApplicationID";
                    }
                    else if ($role == "p2p"){
                        $formName = "Peer to Peer";
                        $formVariable = "p2pApplicationID";
                    }
                    else if ($role == "ioov"){
                        $formName = "In Our Own Voice";
                        $formVariable = "ioovApplicationID";
                    }
                    else if ($role == "csg"){
                        $formName = "Connection Support Group";
                        $formVariable = "csgApplicationID";                
                    }
                    else if ($role == "fsg"){
                        $formName = "Family Support Groups";
                        $formVariable = "fsgApplicationID";
                    }
                    else if ($role == "hf"){
                        $formName = "Homefront";
                        $formVariable = "hfApplicationID";
                    }
                    if ($persons == NULL){  
                        echo '<div class="error-toast">Your search returned no results.</div>';}
                    else{
                        require_once('include/output.php');
                        if (count($persons) > 0) {
                            echo '<div class="table-wrapper">
                                <table class="general">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Form</th>';
                                            if ($role=="F2F" OR  $role=="FSG" OR  $role=="HF"){
                                                echo '<th>Reason</th> <th>Why Now</th> <th>Screener Name</th> <th>Screener Date</th>';
                                            }
                                            else {
                                                echo '<th>Reason</th> <th>Why Now</th> <th>Recovery Status</th> <th>Screener Name</th> <th>Screener Date</th>';
                                            }

                                        echo '
                                       <th>Form Status </th>;
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
                                            <td>' . $formName . '</td>'
                                            ;

                                            
                                            if ($role=="f2f"){
                                                echo  '<td>' . $person['reasonToBecomeF2F'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="fsg"){
                                                echo  '<td>' . $person['reasonToBecomeFSG'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                                
                                            }
                                            else if ($role=="hf"){
                                                echo  '<td>' . $person['reasonToBecomeHF'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';

                                            }
                                            else if ($role=="p2p"){
                                                echo  '<td>' . $person['reasonToBecomeP2P'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['statusInRecoveryJourney'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="ioov"){
                                                echo  '<td>' . $person['reasonToBecomeIOOV'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['statusInRecoveryJourney'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';
                                            }
                                            else if ($role=="csg"){	
                                                echo  '<td>' . $person['reasonToBecomeCSG'] . '</td>';
                                                echo  '<td>' . $person['whyIsNowRightTime'] . '</td>';
                                                echo  '<td>' . $person['statusInRecoveryJourney'] . '</td>';
                                                echo  '<td>' . $person['screenerName'] . '</td>';
                                                echo  '<td>' . $person['screeningDate'] . '</td>';

                                            }
                                            if ($person['approved'] == 0 || $person['approved'] == 'R'){
                                                if ($person['approved'] == 0){
                                                    echo '<td> Pending </td> ';
                                                }
                                                else{
                                                    echo '<td> Rejected </td>';
                                                }
                                            echo '
                                            <td> 
                                                <form method="GET" action="formApprove.php">
                                                <input type="hidden" name="formNumber" value="'.$person[$formVariable].'">
                                                <input type="hidden" name="formType" value="'.$role.'">
                                                <input type="submit" value="Approve">
                                                </form>
                                            
                                            </td>';
                                        }
                                        else{
                                            echo '<td> Approved </td>';
                                            echo '                                            <td> 
                                                <form method="GET" action="formApprove.php">
                                                <input type="hidden" name="unformNumber" value="'.$person[$formVariable].'">
                                                <input type="hidden" name="unformType" value="'.$role.'">
                                                <input type="submit" value="Unapprove">
                                                </form>
                                            
                                            </td>';
                                        }
                                           echo '</a></tr>';
                            }}
                            echo '

                                    </tbody>
                                </table>
                            </div>';

                    }}
                    echo '<h3>Search Again</h3>';
                }
            ?>
            <p>Use the form below to find a volunteer or participant. At least one search criterion is required.</p>

			<label for="role">Form Type</label>
 
           <select id="role" name="role">
                <option value="">Select</option>
                <option value="f2f" <?php if (isset($role) && $role == 'f2f') echo 'f2f' ?>>f2f</option>
                <option value="p2p" <?php if (isset($role) && $role == 'p2p') echo 'p2p' ?>>p2p</option>
                <option value="ioov" <?php if (isset($role) && $role == 'ioov') echo 'ioov' ?>>ioov</option>
                <option value="csg" <?php if (isset($role) && $role == 'csg') echo 'csg' ?>>csg</option>
                
                <option value="fsg" <?php if (isset($role) && $role == 'fsg') echo 'fsg' ?>>fsg</option>
                <option value="hf" <?php if (isset($role) && $role == 'hf') echo 'hf' ?>>hf</option>
            </select>

            <label for="Status">Form Status</label>
            <select id="status" name="status">
            <option value="">Select</option>
                <option value="approved" <?php if (isset($role) && $role == 'approved') echo 'approved' ?>>Approved</option>
                <option value="denied" <?php if (isset($role) && $role == 'denied') echo 'denied' ?>>Denied</option>
                <option value="pending" <?php if (isset($role) && $role == 'pending') echo 'pending' ?>>Pending</option>
                </select>
            <div id="criteria-error" class="error hidden">You must provide at least one search criterion.</div>
            <input type="submit" value="Search">
            <a class="button cancel" href="index.php">Return to Home Dashboard</a>
        </form>
    </main>
    </body>
    <?php require('footer.php'); ?>
</html>