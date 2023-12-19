<?php
require "fpdf/fpdf.php";
require "_dbconnect.php";
session_start();
$hostel=$_SESSION['hostel_id'];
$tablename = $hostel . "_attendance";
$result =mysqli_query($conn,"SELECT * FROM $tablename;");
$header = mysqli_query($conn,"SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_NAME`='$tablename'");


$pdf = new FPDF('L','mm','A3');
$pdf->AddPage();
$pdf->SetFont('Arial','',3);		
foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(15,5,$column_heading,1);
}
foreach($result as $row) {
	$pdf->SetFont('Arial','',3);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(15,5,$column,1);
}
$pdf->Output();
ob_end_flush();
?>