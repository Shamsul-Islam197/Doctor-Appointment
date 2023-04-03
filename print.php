<?PHP
include 'connection.php';
require('fpdf/fpdf.php');

$query = "SELECT slot,patient_name,gender,patient_age,patient_phone,appointment_type,date,remarks FROM `appointment_info` order by slot asc ";
$result = mysqli_query($con, $query);


$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);



$pdf->Image('aalok.jpg', 1, 1, -900);
/* --- Text --- */
$pdf->SetTextColor(0, 0, 0);
$pdf->Text(30, 10, 'AALOK Healthcare Ltd.(Unit-1)');
$pdf->SetTextColor(0);
/* --- Text --- */
$pdf->SetTextColor(60, 60, 60);
$pdf->SetFontSize(10);
$pdf->Text(30, 15, 'House # 1, Road # 2, Block # B,');
$pdf->SetTextColor(0);
/* --- Text --- */
$pdf->SetTextColor(60, 60, 60);
$pdf->SetFontSize(10);
$pdf->Text(30, 20, 'Sector - 10, Mirpur, Dhaka - 1216.');
$pdf->SetTextColor(0);
/* --- Text --- */
$pdf->Text(171, 18, 'From 26/02/2023');
/* --- Text --- */
$pdf->Text(171, 22, 'Upto 26/02/2023');

$pdf->SetXY(50, 10);
$pdf->Text(25, 28, 'OPD Appointment Report');
$pdf->Line(10, 30, 200, 30);
$pdf->Ln(21);
$pdf->Cell(191, 12, '', 1, 1, 'C');
$pdf->Text(25, 35, 'Doctor Name:');
$pdf->Text(25, 40, 'Degree:');
$pdf->Text(140, 35, 'Department:');
$pdf->Text(140, 40, 'Shift:');






$pdf->Cell(8, 7, "Slot", 1, 0, 'C');
$pdf->Cell(40, 7, "Patient Name", 1, 0, 'C');
$pdf->Cell(15, 7, "Gender", 1, 0, 'C');
$pdf->Cell(10, 7, "Age", 1, 0, 'C');
$pdf->Cell(30, 7, "Phone", 1, 0, 'C');
$pdf->Cell(25, 7, "Patient Type", 1, 0, 'C');
$pdf->Cell(25, 7, "Date", 1, 0, 'C');
$pdf->Cell(38, 7, "Remarks", 1, 0, 'C');

$pdf->Ln();

while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(8, 7, $row['slot'], 1);
    $pdf->Cell(40, 7, $row['patient_name'], 1);
    $pdf->Cell(15, 7, $row['gender'], 1);
    $pdf->Cell(10, 7, $row['patient_age'], 1);
    $pdf->Cell(30, 7, $row['patient_phone'], 1);
    $pdf->Cell(25, 7, $row['appointment_type'], 1);
    $pdf->Cell(25, 7, $row['date'], 1);
    $pdf->Cell(38, 7, $row['remarks'], 1);
    $pdf->Ln();
}
$pdf->AddPage('P', 'A4');
$pdf->Output('created_pdf.pdf', 'I');
