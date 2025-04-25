<?php
// generateHourReport.php
// Generates a PDF report of volunteer hours for a given person ID

require 'fpdf186/fpdf.php';
require_once 'fpdi/src/autoload.php';
require_once 'database/dbinfo.php';

// Connect to database
$conn = connect();

// Get person ID from URL
$id = isset($_GET['id']) ? trim($_GET['id']) : '';
if ($id === '') {
    die('Error: id parameter required.');
}

// Lookup volunteer's name
$stmt = $conn->prepare(
    "SELECT first_name, last_name
     FROM dbpersons
     WHERE id = ?"
);
$stmt->bind_param('s', $id);
$stmt->execute();
$stmt->bind_result($firstName, $lastName);
if (!$stmt->fetch()) {
    $stmt->close();
    $conn->close();
    die('Error: person not found.');
}
$stmt->close();

// Fetch volunteer hours
$stmt = $conn->prepare(
    "SELECT date, hours
     FROM volunteerHours
     WHERE f_name = ? AND l_name = ?
     ORDER BY date ASC"
);
$stmt->bind_param('ss', $firstName, $lastName);
$stmt->execute();
$result = $stmt->get_result();

$rows = [];
$totalHours = 0;
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
    $totalHours += $row['hours'];
}
$stmt->close();
$conn->close();

if (empty($rows)) {
    die('No volunteer hours found.');
}

// Format total hours
$totalHours = number_format($totalHours, 0);

// Sort newest first
usort($rows, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

// Logo centered (100mm wide)
$pdf->Image(
    'images/logoLong.jpg',
    ($pdf->GetPageWidth() - 100) / 2,
    10,
    100
);
// Push content down to avoid overlap
$pdf->Ln(60);

// Intro paragraph
$pdf->SetFont('Arial', '', 12);
$today = date('F j, Y');
$text = "$firstName $lastName has worked a total of $totalHours hours as of $today. Your dedication and hard work are invaluable to our community. Thank you for making a difference!";
$pdf->MultiCell(0, 8, mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8'), 0, 'C');
$pdf->Ln(10);

// Table header
$colH = 40;
$colD = 50;
$startX = ($pdf->GetPageWidth() - ($colH + $colD)) / 2;
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Volunteer Hour Breakdown', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->SetX($startX);
$pdf->Cell($colH, 10, 'Hours', 1, 0, 'C', true);
$pdf->Cell($colD, 10, 'Date', 1, 1, 'C', true);

// Table rows
$pdf->SetFont('Arial', '', 12);
foreach ($rows as $r) {
    $pdf->SetX($startX);
    $pdf->Cell($colH, 10, number_format($r['hours'], 0), 1, 0, 'C');
    $pdf->Cell($colD, 10, date('M j, Y', strtotime($r['date'])), 1, 1, 'C');
}

// Output PDF
$pdf->Output('I', "{$firstName}_{$lastName}_hours.pdf");
?>
