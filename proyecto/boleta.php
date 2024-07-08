<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    $nombreUsuario = $_SESSION['usuario']; // Obtener el nombre de usuario desde la sesión
    //echo 'Usuario Iniciado';
} else {
    //echo 'Usuario NO Iniciado';
}

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

if (mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener los datos del formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria_producto = isset($_POST['categoria_producto']) ? mysqli_real_escape_string($conexion, $_POST['categoria_producto']) : '';
    $correo_sesion = isset($_POST['correo_sesion']) ? $_POST['correo_sesion'] : '';

    // Verificar que la categoría no esté vacía
    if (!empty($categoria_producto)) {
        // Obtener datos de sesión
        $nombre_usuario = isset($_SESSION['usuario']['nombre']) ? $_SESSION['usuario']['nombre'] : '';
        
        // Generar token único para el voucher
        $token = uniqid();

        // Insertar reserva en la base de datos
        $sql_insert = "INSERT INTO bauches (nombre, fecha, correo, token)
                       VALUES ('$nombre_usuario', NOW(), '$correo_sesion', '$token')";

        if (mysqli_query($conexion, $sql_insert)) {
            // Redireccionar a la página de generación de boleta con el token
            header("Location: generar_boleta.php?token=$token");
            exit();
        } else {
            echo "Error al realizar la reserva: " . mysqli_error($conexion);
        }
    } else {
        echo "Categoría del producto no válida.";
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>
