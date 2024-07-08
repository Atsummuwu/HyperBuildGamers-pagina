<?php
session_start();

// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

if (mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error();
    exit();
}

$productoReservado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = mysqli_real_escape_string($conexion, $_POST['token']);

    // Consulta SQL para obtener el producto reservado basado en el token
    $sql = "SELECT producto, token, fecha FROM bauches WHERE token = '$token'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $bauche = mysqli_fetch_assoc($resultado);
        $nombreProducto = $bauche['producto'];
        $fecha = $bauche['fecha'];
        $token = $bauche['token'];
        $productoReservado = "Producto: $nombreProducto<br>Fecha: $fecha<br>Token: $token";
    } else {
        $productoReservado = "No se encontró ninguna reserva con el token proporcionado.";
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobar Bauche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1>Comprobar Bauche</h1>
    <form action="comprobarbauches.php" method="POST">
        <div class="mb-3">
            <label for="token" class="form-label">Token</label>
            <input type="text" class="form-control" id="token" name="token" required>
        </div>
        <button type="submit" class="btn btn-primary">Comprobar</button>
    </form>

    <?php if ($productoReservado): ?>
    <div class="mt-4">
        <h2>Detalles del Producto Reservado</h2>
        <p><?php echo $productoReservado; ?></p>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
