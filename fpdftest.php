<?php
// Include FPDF library
require('fpdf186/fpdf.php');
require_once('fpdi/src/autoload.php');

// Include database connection
require_once('database/dbinfo.php');
$conn = connect();

// Fetch volunteer hours from database
$query = "SELECT f_name, l_name, date, hours FROM volunteerHours ORDER BY l_name, f_name, date ASC";
$result = mysqli_query($conn, $query);

// Create FPDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set Font
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0, 10, 'Volunteer Hours', 0, 1, 'C');

// Table headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Date', 1);
$pdf->Cell(80, 10, 'Name', 1);
$pdf->Cell(40, 10, 'Hours', 1);
$pdf->Ln();

// Set font for table content
$pdf->SetFont('Arial', '', 12);

// Populate PDF with database content
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(50, 10, $row['date'], 1);
    $pdf->Cell(80, 10, $row['f_name'] . ' ' . $row['l_name'], 1);
    $pdf->Cell(40, 10, $row['hours'], 1);
    $pdf->Ln();
}

mysqli_close($conn);

// Output the PDF
$pdf->Output('I', 'volunteer_hours.pdf');