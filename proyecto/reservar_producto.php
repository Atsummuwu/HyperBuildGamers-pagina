<?php
session_start(); // Iniciar sesión para acceder a las variables de sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: InicioSesion.php");
    exit;
}

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

if (mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener los datos del formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;
    $categoria_producto = isset($_POST['categoria_producto']) ? mysqli_real_escape_string($conexion, $_POST['categoria_producto']) : '';

    // Verificar que el producto y la categoría no estén vacíos
    if ($id_producto > 0 && !empty($categoria_producto)) {
        // Obtener datos de sesión
        $nombre_usuario = isset($_SESSION['usuario']['nombre']) ? $_SESSION['usuario']['nombre'] : '';
        $correo_usuario = isset($_SESSION['usuario']['correo']) ? $_SESSION['usuario']['correo'] : '';

        // Generar token único para el voucher
        $token = uniqid();

        // Insertar reserva en la base de datos
        $sql_insert = "INSERT INTO bauches (nombre, fecha, correo, token)
                       VALUES ('$nombre_usuario', NOW(), '$correo_usuario', '$token')";

        if (mysqli_query($conexion, $sql_insert)) {
            // Redirigir a bauches.jsp con el token como parámetro
            header("Location: bauches.jsp?token=$token");
            exit;
        } else {
            echo "Error al realizar la reserva: " . mysqli_error($conexion);
        }
    } else {
        echo "Datos del producto no válidos.";
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>
