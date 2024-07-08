<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header("location: InicioSesion.php");
exit;
?>