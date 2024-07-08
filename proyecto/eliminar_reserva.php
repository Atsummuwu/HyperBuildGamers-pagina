<?php
// Verificar si se proporcionó un ID de reserva en la URL
if (isset($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "cocacola");

    // Verificar la conexión
    if (mysqli_connect_errno()) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Recuperar el ID de la reserva desde la URL
    $id_reserva = $_GET['id'];

    // Consulta SQL para eliminar la reserva con el ID proporcionado
    $sql = "DELETE FROM ReservasSoporteTecnico WHERE id = $id_reserva";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        echo "Reserva eliminada con éxito";
    } else {
        echo "Error al eliminar la reserva: " . mysqli_error($conexion);
    }

    // Cerrar conexión
    mysqli_close($conexion);
} else {
    echo "ID de reserva no proporcionado.";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales aquí */
    </style>
</head>
<body>
  
     

        <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='Formulario_reserva.php'">Volver</button>



    </div>
</body>
</html>