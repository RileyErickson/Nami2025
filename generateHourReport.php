<?php
// Include FPDF library
require('fpdf186/fpdf.php');
require_once('fpdi/src/autoload.php');

// Include database connection
require_once('database/dbinfo.php');
$conn = connect();

// Fetch volunteer hours from database using your original query
$query = "SELECT f_name, l_name, date, hours FROM volunteerHours ORDER BY l_name, f_name, date ASC";
$result = mysqli_query($conn, $query);

// Fetch all rows into an array
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

if (empty($rows)) {
    die("No volunteer hours found.");
}

// Use the first row's name as the volunteer's name
$fName = $rows[0]['f_name'];
$lName = $rows[0]['l_name'];

// Calculate total hours worked (as an integer)
$totalHours = 0;
foreach ($rows as $row) {
    $totalHours += $row['hours'];
}
$totalHours = number_format($totalHours, 0); // Format as integer

// Sort rows so the most recent date comes first
usort($rows, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// Create FPDF instance and add a page
$pdf = new FPDF();
$pdf->AddPage();

// --- Header: Centered Logo ---
// For an A4 page (210mm wide), center an image with width=100mm by setting x = (210-100)/2 = 55.
$pdf->Image('images/logoLong.jpg', 55, 10, 100);
$pdf->Ln(40); // Vertical spacing after the logo

// --- Centered Paragraph with User Info ---
$pdf->SetFont('Arial','',12);
$today = date('F j, Y');
$paragraph = "$fName $lName has worked a total of $totalHours hours as of $today. "
           . "Your dedication and hard work are invaluable to our community. Thank you for making a difference!";
//siteground no likey
//$pdf->MultiCell(0, 8, utf8_decode($paragraph), 0, 'C');
//siteground likey
$pdf->MultiCell(0, 8, mb_convert_encoding($paragraph, 'ISO-8859-1', 'UTF-8'), 0, 'C');

$pdf->Ln(10);

// --- Table: Volunteer Hour Breakdown ---
// Define column widths for two columns: Hours and Date.
$colHours = 40;
$colDate = 50;
$tableWidth = $colHours + $colDate;
$centerX = ($pdf->GetPageWidth() - $tableWidth) / 2;

// Table title
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Volunteer Hour Breakdown', 0, 1, 'C');
$pdf->Ln(5);

// Table Headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230,230,230);
$pdf->SetX($centerX);
$pdf->Cell($colHours, 10, 'Hours', 1, 0, 'C', true);
$pdf->Cell($colDate, 10, 'Date', 1, 1, 'C', true);

// Table Content
$pdf->SetFont('Arial', '', 12);
foreach ($rows as $row) {
    $pdf->SetX($centerX);
    $pdf->Cell($colHours, 10, number_format($row['hours'], 0), 1, 0, 'C'); // No decimals
    $pdf->Cell($colDate, 10, date('M j, Y', strtotime($row['date'])), 1, 1, 'C');
}

mysqli_close($conn);

// Output the PDF to the browser
$pdf->Output('I', 'volunteer_hours.pdf');
?>
