<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: InicioSesion.php");
    exit;
}

if (!isset($_GET['token'])) {
    echo "Token no especificado.";
    exit;
}

$token = $_GET['token'];

require('jsPDF/jspdf.php');

$pdf = new jsPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10, '¡Gracias por tu reserva!');
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10, 'Tu token de reserva es: ' . $token);

$pdf->Output('bauche.pdf', 'I');
?>
