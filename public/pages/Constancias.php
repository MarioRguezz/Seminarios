<?php
require('../fpdf/fpdf.php');
include '../php/conexion.php';
//include '../../php/funciones_BaseDatos.php'; //funciones de la base de datos 
header('Content-Type: text/html; charset=UTF-8'); 

$pdf = new FPDF('L','mm', 'A4');

//for($x=0; $x < 2; $x++)
//{
$pdf->AddPage();	
//$pdf->Image('../../img/Constancia.jpg' , 0 ,0, 295 , 209,'jpg');
$pdf->Image('../img/Constancias/Constancia.jpg' , 0 ,0, 297 , 210,'jpg');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(250, 46, utf8_decode('TECNOLÓGICO NACIONAL DE MÉXICO'), 0, 1,'R');
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(275, 10, utf8_decode('Otorga la presente'), 0, 1,'C');
$pdf->SetFont('Arial', 'B', 45);
$pdf->Cell(275, 20, utf8_decode('Constancia'), 0, 1,'C');
$pdf->SetFont('Arial', '', 20);
$pdf->Cell(275, 15, utf8_decode('a'), 0, 1,'C');
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(275, 20, utf8_decode('Aqui va el nombre de la consulta'), 0, 1,'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(275, 15, utf8_decode('Por su valiosa participación alumno en el curso:'), 0, 1,'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(275, 1, utf8_decode('Programación avanzada'), 0, 1,'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(275, 20, utf8_decode('León, Gto., a  "fecha del día".'), 0, 1,'C');
$pdf->Cell(275, 15, utf8_decode('ING. RAFAEL RODRÍGUEZ GALLEGOS.'), 0, 1,'C');
$pdf->Cell(275, 1, utf8_decode('DIRECTOR DEL INSTITUTO TECNOLÓGICO DE LEÓN'), 0, 1,'C');
//}
/*
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, 'LISTADO DE PRODUCTOS', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(80, 8, 'Nombre', 0);
$pdf->Cell(40, 8, 'Tipo', 0);
$pdf->Cell(25, 8, 'P. Unitario', 0);
$pdf->Cell(25, 8, 'P. Distribuidor', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


$item = 0;
$totaluni = 0;
$totaldis = 0;

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Total Unitario: S/. '.$totaluni,0);
$pdf->Cell(32,8,'Total Dist: S/. '.$totaldis,0);
//*/

$pdf->Output();
?>

