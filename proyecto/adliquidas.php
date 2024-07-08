<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Liquidas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales aquí */
    </style>
</head>
<body>
    <div class="container">
        <h1>Agregar Producto</h1>
        <form action="adliquidash.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number"  class="form-control" id="precio" name="precio" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label for="imagen1">Imagen 1:</label>
                <input type="file" class="form-control-file" id="imagen1" name="imagen1" required>
            </div>
            <div class="form-group">
                <label for="imagen2">Imagen 2:</label>
                <input type="file" class="form-control-file" id="imagen2" name="imagen2" required>
            </div>
            <div class="form-group">
                <label for="imagen3">Imagen 3:</label>
                <input type="file" class="form-control-file" id="imagen3" name="imagen3" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
            <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='TablaProductos.php'">volver</button>

            <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='eliliquidas.php'">eliminar/editar</button>



        </form>
    </div>
</body>
</html>


