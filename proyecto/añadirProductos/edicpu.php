<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

// Verificar la conexión
if (mysqli_connect_errno()) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener el ID del producto de la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Consulta SQL para obtener los datos del producto
    $sql_select = "SELECT * FROM cpu WHERE id = $id_producto";
    $resultado = mysqli_query($conexion, $sql_select);

    // Comprobar si el producto existe
    if (mysqli_num_rows($resultado) == 1) {
        $producto = mysqli_fetch_assoc($resultado);
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto no proporcionado.";
    exit();
}

// Actualizar el producto si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $marca = $_POST['marca'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Consulta SQL para actualizar el producto
    $sql_update = "UPDATE cpu SET marca = '$marca', nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock' WHERE id = $id_producto";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql_update)) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }
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
    <div class="container">
        <h1>Editar Producto</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $producto['id']); ?>" method="POST">
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $producto['marca']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
            </div>



            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
            </div>



            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>

        <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='eliminar_cpu.php'">Volver</button>



    </div>
</body>
</html>


<?php
// Cerrar la conexión
mysqli_close($conexion);
?>