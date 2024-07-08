<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

// Verificar la conexión
if (mysqli_connect_errno()) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Eliminar el producto si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $id_producto = $_POST["id_producto"];

    // Consulta SQL para eliminar el producto
    $sql_delete = "DELETE FROM almacenamiento WHERE id = $id_producto";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql_delete)) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
}

// Consulta SQL para obtener todos los productos
$sql_select = "SELECT * FROM almacenamiento";
$resultado = mysqli_query($conexion, $sql_select);

// Comprobar si hay productos
if (mysqli_num_rows($resultado) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Producto</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            /* Estilos adicionales aquí */
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Eliminar Producto</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                            <tr>
                                <td><?php echo $fila['id']; ?></td>
                                <td><?php echo $fila['marca']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['descripcion']; ?></td>
                                <td><?php echo $fila['precio']; ?></td>
                                <td><?php echo $fila['stock']; ?></td>
                                <td>
                                    <a href="edidiscos.php?id=<?php echo $fila['id']; ?>" class="btn btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-danger" name="eliminar">Eliminar</button>
                                    <input type="hidden" name="id_producto" value="<?php echo $fila['id']; ?>">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>

<button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='addiscos.php'">Volver</button>

    </body>
    </html>
    <?php
} else {
    echo "No hay productos para mostrar.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
