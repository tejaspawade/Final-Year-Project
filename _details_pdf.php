<?php
require "fpdf/fpdf.php";
require "_dbconnect.php";
session_start();
$hostel=$_SESSION['hostel_id'];
$result =mysqli_query($conn,"SELECT * FROM $hostel; ");
$header = mysqli_query($conn,"SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_NAME`='$hostel'");


$pdf = new FPDF('L','mm','A3');
$pdf->AddPage();
$pdf->SetFont('Arial','',4);		
foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(19,10,$column_heading,1);
}
foreach($result as $row) {
	$pdf->SetFont('Arial','',4);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(19,10,$column,1);
}
$pdf->Output();
ob_end_flush();
?>