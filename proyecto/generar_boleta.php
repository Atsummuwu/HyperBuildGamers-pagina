<?php
session_start(); // Iniciar la sesión para acceder a las variables de sesión

// Verificar si los datos están presentes en el POST
if (!isset($_POST['id_producto'], $_POST['categoria_producto'], $_POST['nombre_producto'])) {
    echo "Datos insuficientes para generar el bauche.";
    exit;
}

// Obtener los datos del POST
$id_producto = $_POST['id_producto'];
$categoria_producto = $_POST['categoria_producto'];
$nombre_producto = $_POST['nombre_producto'];

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

if (mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error();
    exit();
}

// Generar un token único para el bauche (boleta)
$token = uniqid();

// Obtener la fecha actual
$fecha = date('Y-m-d H:i:s');

// Iniciar una transacción para asegurar la consistencia de la base de datos
mysqli_autocommit($conexion, false);

// Insertar el bauche en la base de datos
$sql_insert = "INSERT INTO bauches (fecha, token, producto) VALUES ('$fecha', '$token', '$nombre_producto')";
$resultado_insert = mysqli_query($conexion, $sql_insert);

if (!$resultado_insert) {
    mysqli_rollback($conexion); // Revertir la transacción si falla la inserción del bauche
    echo "Error al generar el bauche en la base de datos: " . mysqli_error($conexion);
    exit;
}

// Actualizar el stock del producto
$sql_update = "UPDATE $categoria_producto SET stock = stock - 1 WHERE id = $id_producto";
$resultado_update = mysqli_query($conexion, $sql_update);

if (!$resultado_update) {
    mysqli_rollback($conexion); // Revertir la transacción si falla la actualización del stock
    echo "Error al actualizar el stock del producto: " . mysqli_error($conexion);
    exit;
}

// Confirmar la transacción
mysqli_commit($conexion);

// Cerrar la conexión
mysqli_close($conexion);

// Incluir la clase FPDF
require('fpdf.php');

// Crear instancia de PDF
$pdf = new FPDF();
$pdf->AddPage();

// Títulos y datos del bauche
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Bauche de Reserva', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Token: ' . $token, 0, 1);
$pdf->Cell(0, 10, 'Producto: ' . htmlspecialchars($nombre_producto), 0, 1);
$pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1);

// Salida del PDF (descarga como archivo)
$pdf->Output('D', 'bauche.pdf');
?>
