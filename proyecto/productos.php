<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles2.css" />
    <link rel="stylesheet" href="styleproductos.css">
</head>

<body>

<header>
    <nav class="navbar container">
        <i class="fa-solid fa-bars"></i>
        <ul class="menu">
            <li class="nav-item active">
                <a class="navbar-brand" href="PaginaPrincipal.php">HyperBuild Gamers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contacto.php">Reserva tu hora</a>
            </li>
        </ul>
    </nav>
    <h1>Productos</h1>
    <form action="productos.php" method="GET">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"></div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <input type="text" name="busqueda" placeholder="Buscar productos..." class="form-control">
            </div>
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 text-start">
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
           



            </div>
        </div>
    </form>
    
</header>

<div class="container">
    <div class="text-center">
        <div class="dropdown col-12">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categorias
            </button>
            <ul class="dropdown-menu">
                <li><a href="productos.php" class="btn btn-light">Todos los productos</a></li>
                <li><a href="productos.php?categoria=almacenamiento" class="btn btn-light">Almacenamiento</a></li>
                <li><a href="productos.php?categoria=coolers" class="btn btn-light">Coolers</a></li>
                <li><a href="productos.php?categoria=cpu" class="btn btn-light">CPU</a></li>
                <li><a href="productos.php?categoria=liquidas" class="btn btn-light">Líquidas</a></li>
                <li><a href="productos.php?categoria=monitores" class="btn btn-light">Monitores</a></li>
                <li><a href="productos.php?categoria=mousepads" class="btn btn-light">Mousepads</a></li>
                <li><a href="productos.php?categoria=pastatermica" class="btn btn-light">Pasta térmica</a></li>
                <li><a href="productos.php?categoria=placamadre" class="btn btn-light">Placa madre</a></li>
                <li><a href="productos.php?categoria=ram" class="btn btn-light">RAM</a></li>
                <li><a href="productos.php?categoria=ratones" class="btn btn-light">Ratones</a></li>
                <li><a href="productos.php?categoria=audifonos" class="btn btn-light">Audifonos</a></li>
                <li><a href="productos.php?categoria=microfonos" class="btn btn-light">Microfonos</a></li>
                <li><a href="productos.php?categoria=sillas" class="btn btn-light">Sillas</a></li>
                <li><a href="productos.php?categoria=GPU" class="btn btn-light">Tarjetas gráficas</a></li>
                <li><a href="productos.php?categoria=fuentes" class="btn btn-light">Fuentes</a></li>
                <li><a href="productos.php?categoria=teclados" class="btn btn-light">Teclados</a></li>
                <li><a href="productos.php?categoria=ventiladores" class="btn btn-light">Ventiladores</a></li>
            </ul>
        </div>
    </div>

    <div class="productos row">
        <?php
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "cocacola");

        if (mysqli_connect_errno()) {
            echo "Error al conectar con la base de datos: " . mysqli_connect_error();
            exit();
        }

        // Construcción de la consulta SQL
        $sql = "SELECT id, nombre, descripcion, precio, stock, imagen, 'almacenamiento' AS categoria FROM almacenamiento ";

        // Aplicar filtros si se han enviado desde el formulario
        if (isset($_GET['busqueda'])) {
            echo 'primer busqueda';
            $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
            $sql .= "WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'coolers' AS categoria FROM coolers WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'fuentes' AS categoria FROM fuentes WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'audifonos' AS categoria FROM audifonos WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'microfonos' AS categoria FROM microfonos WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'cpu' AS categoria FROM cpu WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'liquidas' AS categoria FROM liquidas WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'monitores' AS categoria FROM monitores WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'mousepads' AS categoria FROM mousepads WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'pastatermica' AS categoria FROM pastatermica WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'placamadre' AS categoria FROM placamadre WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'ram' AS categoria FROM ram WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'ratones' AS categoria FROM ratones WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'sillas' AS categoria FROM sillas WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'GPU' AS categoria FROM GPU WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'teclados' AS categoria FROM teclados WHERE nombre LIKE '%$busqueda%' UNION ";
            $sql .= "SELECT id, nombre, descripcion, precio, stock, imagen, 'ventiladores' AS categoria FROM ventiladores WHERE nombre LIKE '%$busqueda%'";
        } elseif (isset($_GET['categoria'])) {
            $categoria = mysqli_real_escape_string($conexion, $_GET['categoria']);
            $sql = "SELECT id, nombre, descripcion, precio, stock, imagen, '$categoria' AS categoria FROM $categoria";
        } else {
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'coolers' AS categoria FROM coolers ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'fuentes' AS categoria FROM fuentes ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'audifonos' AS categoria FROM audifonos ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'microfonos' AS categoria FROM microfonos ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'cpu' AS categoria FROM cpu ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'liquidas' AS categoria FROM liquidas ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'monitores' AS categoria FROM monitores ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'mousepads' AS categoria FROM mousepads ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'pastatermica' AS categoria FROM pastatermica ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'placamadre' AS categoria FROM placamadre ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'ram' AS categoria FROM ram ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'ratones' AS categoria FROM ratones ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'sillas' AS categoria FROM sillas ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'GPU' AS categoria FROM GPU ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'teclados' AS categoria FROM teclados ";
            $sql .= "UNION SELECT id, nombre, descripcion, precio, stock, imagen, 'ventiladores' AS categoria FROM ventiladores ";
        }

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<div class='col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12'>";
                echo "<a href='ventas.php?id={$fila['id']}&categoria={$fila['categoria']}'>";
                echo "<div class='card mt-4 mb-4' style='width: 18rem;'>";
                echo "<img src='{$fila['imagen']}' class='card-img-top' alt='{$fila['nombre']}'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$fila['nombre']}</h5>";
               
                echo "<p class='card-text'>$ {$fila['precio']}</p>";
                echo "<p class='card-text'>Stock: {$fila['stock']}</p>";
                echo "<a href='ventas.php?id={$fila['id']}&categoria={$fila['categoria']}' class='btn btn-primary'>Ver detalles</a>";
                echo "</div></div></a></div>";
            }
        } else {
            echo "<p>No se encontraron productos.</p>";
        }

        // Cerrar la conexión
        mysqli_close($conexion);
        ?>
    </div>
</div>

</body>

</html>
