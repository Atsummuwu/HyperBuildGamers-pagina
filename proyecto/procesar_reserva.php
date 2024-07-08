<?php
session_start();

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['usuario'])) {
    // Si no hay una sesión iniciada, redirigir al usuario a la página de inicio de sesión
    header("Location: iniciosesion.php");
    exit; // Finaliza la ejecución del script después de redirigir
}

// Recuperar los demás datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$mensaje = $_POST['mensaje'];

// Obtener el correo electrónico de la sesión
$correo_sesion = $_SESSION['usuario'];

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

// Verificar la conexión
if (mysqli_connect_errno()) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Preparar la consulta SQL para insertar los datos en la tabla ReservasSoporteTecnico
$sql = "INSERT INTO ReservasSoporteTecnico (nombre, email, telefono, fecha, hora, mensaje) 
        VALUES ('$nombre','$correo_sesion', '$telefono', '$fecha', '$hora', '$mensaje')";

// Ejecutar la consulta SQL
if (mysqli_query($conexion, $sql)) {
    echo "Reserva realizada con éxito";
} else {
    echo "Error al realizar la reserva: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
