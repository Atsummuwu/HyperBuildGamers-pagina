<?php
session_start(); // Inicia la sesión para acceder a las variables de sesión

// Verificar si hay una sesión iniciada
if (isset($_SESSION['usuario'])) {
    // Si hay una sesión iniciada, puedes realizar acciones específicas aquí
    echo "¡La sesión está iniciada para el usuario: " . $_SESSION['usuario']['correo_electronico'] . "!";
} else {
    // Si no hay una sesión iniciada, puedes redirigir al usuario a la página de inicio de sesión
    echo "No hay una sesión iniciada.";
    // También podrías redirigir al usuario a la página de inicio de sesión utilizando header()
    // header("Location: iniciar_sesion.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Sesión</title>
</head>

<body>
    <!-- Contenido de la página -->
</body>

</html>
