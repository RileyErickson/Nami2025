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
            <h2>Find Form</h2>
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
                    $formname = $args['role'];
                    if (!($formname)) {
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
                      //  $persons = get_forms_id($role,$status);
                    
                    $formID = findFormFromName($formname);
                    $formIDnew=mysqli_fetch_assoc($formID);
                    if (!isset($formIDnew['managerID'])){  
                        echo '<div class="error-toast">Your search returned no results.</div>';}
                    else{
                        require_once('include/output.php');
/*                        if (count($persons) > 0) {
                            echo '<div class="table-wrapper">
                                <table class="general">
                                    <thead>
                                        <tr>';
                                           
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

                    */}}
                    echo '<h3>Search Again</h3>';
                }
            ?>
            <p>Use the form below to find a volunteer or participant. At least one search criterion is required.</p>
			<label for="role">Form Type</label>
           <input type="text" name="role"><br>


            <label for="Status">Form Status</label>
            <select id="status" name="status">
            <option value="">Select</option>
                <option value="approved" <?php if (isset($role) && $role == 'approved') echo 'approved' ?>>Approved</option>
                <option value="denied" <?php if (isset($role) && $role == 'denied') echo 'denied' ?>>Denied</option>
                <option value="pending" <?php if (isset($role) && $role == 'pending') echo 'pending' ?>>Pending</option>
                </select>
            <div id="criteria-error" class="error hidden">You must provide at least one search criterion.</div>
            <input type="submit" value="Search">
            <a class="button cancel" href="forms.php">Return to Home Dashboard</a>
        </form>
    </main>
    </body>
    <?php require('footer.php'); ?>
</html>