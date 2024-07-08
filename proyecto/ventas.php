<?php
session_start();

// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

if (mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener los parámetros de la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$categoria = isset($_GET['categoria']) ? mysqli_real_escape_string($conexion, $_GET['categoria']) : '';

// Obtener los detalles del producto
$sql = "SELECT * FROM $categoria WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $producto = mysqli_fetch_assoc($resultado);
} else {
    echo "<p>Producto no encontrado.</p>";
    exit();
}

// Obtener el nombre del producto para mostrarlo en la página
$nombreProducto = $producto['nombre']; // Obtener el nombre del producto

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto: <?php echo htmlspecialchars($nombreProducto); ?></title>
    <link rel="stylesheet" href="styleventas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <!-- Columna para el contenedor de las imágenes -->
        <div class="col-md-4">
            <div class="row">
                <div class="col">
                    <img id="imagenPrincipal" src="<?php echo $producto['imagen']; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($nombreProducto); ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="img-thumbnails">
                        <img onclick="cambiarImagen('<?php echo $producto['imagen']; ?>')" src="<?php echo $producto['imagen']; ?>" alt="Thumbnail 1">
                        <img onclick="cambiarImagen('<?php echo $producto['imagen2']; ?>')" src="<?php echo $producto['imagen2']; ?>" alt="Thumbnail 2">
                        <img onclick="cambiarImagen('<?php echo $producto['imagen3']; ?>')" src="<?php echo $producto['imagen3']; ?>" alt="Thumbnail 3">
                    </div>
                </div>
            </div>
        </div>
        <!-- Columna para el contenedor de los detalles del producto -->
        <div class="col-md-8">
            
            <h1 class="main-title"><?php echo htmlspecialchars($nombreProducto); ?></h1>
            
           
            <div class="price">
                <?php echo $producto['precio']; ?>
            </div>

            <!-- Formulario para reservar el producto -->
            <form action="generar_boleta.php" method="POST" target="_blank">
                <input type="hidden" name="id_producto" value="<?php echo $id; ?>">
                <input type="hidden" name="categoria_producto" value="<?php echo $categoria; ?>">
                <input type="hidden" name="nombre_producto" value="<?php echo htmlspecialchars($nombreProducto); ?>">
                <button type="submit" class="btn btn-primary mt-3">Reservar</button>
            </form>

            <!-- Botón para agregar al Armador de PC -->
            <form action="ArmadorPc.php" method="POST">
                <input type="hidden" name="id_componente" value="<?php echo $id; ?>">
                <input type="submit" name="agregar_componente" value="Agregar al Armador de PC" class="btn btn-success mt-3">
            </form>

            <div class="mt-4">
                <h5>Disponibilidad</h5>
                <ul>
                    <li>Stock en tienda: <?php echo $producto['stock']; ?> unidades</li>
                </ul>
            </div>
            <div class="mt-4">
                <h5>Descripción</h5>
                <p><?php echo $producto['marca']; ?></p>
                <p><?php echo $producto['descripcion']; ?></p>
            </div>
        </div>
    </div>
</div>

<script>
    function cambiarImagen(nuevaImagen) {
        document.getElementById("imagenPrincipal").src = nuevaImagen;
    }
</script>

</body>

</html>
