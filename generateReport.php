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
        <title>NAMI | Generate Reports</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <h1>Generate Volunteer Reports</h1>
        <form id="hours-report" class="general" method="get">
            <h2>Generate Volunteer Report</h2>
            <?php
                if (isset($_GET['id'])){
                    require_once('include/input-validation.php');
                    require_once('database/dbPersonHours.php');
                    $args = sanitize($_GET);
                    $required = ['id', 'eventID', 'startEnd', 'totalHours'];
                    if (!wereRequiredFieldsSubmitted($args, $required, true)){
                        echo 'Missing expected form elements';
                    }
                    $id = $args['id'];
                    $eventID = $args['eventID'];
                    $startEnd = $args['startEnd'];
                    $totalHours = $args['totalHours'];
                    $PersonHours = getPersonHours($id);
                    require_once('include/output.php');
                    if (is_array($PersonHours) && count($PersonHours) > 0){
                        require('fpdf.php');
                        ob_start();
                        $pdf = new FPDF();
                        $pdf->SetFont('times','B',30);
                        $pdf->AddPage();
                        $pdf->Cell(60, 20, $id);
                        $pdf->Ln();
                        $pdf->SetFont('times','B',15);
                        $pdf->Cell(35, 10, 'Event ID');
                        $pdf->Cell(60, 10, 'Start Time');
                        $pdf->Cell(60, 10, 'End Time');
                        $pdf->Cell(45, 10, 'Total Hours');
                        $pdf->Ln();
                        $entire = 0;
                        foreach($PersonHours as $p){
                            $totTime = strtotime($p["end_time"]) - strtotime($p["start_time"]);
                            $divTime = (int)$totTime;
                            $divTime = $divTime / 3600;
                            $entire += $divTime;
                            $pdf->Cell(35, 10, $p['eventID']);
                            $pdf->Cell(60, 10, $p['start_time']);
                            $pdf->Cell(60, 10, $p['end_time']);
                            $pdf->Cell(45, 10, number_format($divTime, 2));
                            $pdf->Ln();
                        }
                        $pdf->Cell(140, 10, '');
                        $pdf->Cell(15, 10, 'total: ');
                        $pdf->Cell(45, 10, number_format($entire, 2)); 
                        $pdf->Output();
                    }
                }
            ?>
            <p>Use the form to find hour information for a volunteer. All criteria must be filled in.</p>
            <label for="id">Username</label>
            <input type="text" id="id" name="id" value="<?php if (isset($id)) echo htmlspecialchars($_GET['id']) ?>" placeholder="Enter the user's username (login ID)">
            <input type="submit" value="Generate Report">
            <a class="button cancel" href="index.php">Return to Dashboard</a>
        </form>
    </body>
</html>