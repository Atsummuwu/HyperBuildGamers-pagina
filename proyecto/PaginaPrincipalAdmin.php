<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    $nombreUsuario = $_SESSION['usuario']; // Obtener el nombre de usuario desde la sesión
    //echo 'Usuario Iniciado';
} else {
    //echo 'Usuario NO Iniciado';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyperBuild Gamers</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="styles2.css" />
    <!-- Estilos adicionales para el deslizador -->
    <style>
        .navbar {
            background-image: url('imagenes/.png');
            /* Reemplaza 'ruta/a/tu/imagen.jpg' con la ruta de tu imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <style>
        /* Estilo para el fondo de toda la página */
        body {
            background-image: url('imagenes/wallpaper3.jpg');
            /* Si deseas ajustar la repetición de la imagen */
            background-repeat: no-repeat;
            /* Evita que la imagen se repita */
            background-size: cover;
            /* Ajusta el tamaño de la imagen para cubrir toda la pantalla */
            /* Opcional: puedes agregar más propiedades para personalizar el aspecto del fondo */
        }
    </style>
</head>

<body>
    <div class="container-navbar">
        <!-- Mostrar el saludo si el usuario ha iniciado sesión -->
        <?php if (isset($nombreUsuario)): ?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="card">
                        <div class="card-body">
                            ¡Hola, <?php echo $nombreUsuario; ?>!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <nav class="navbar container">
            <i class="fa-solid fa-bars"></i>
            <ul class="menu">
                <li class="nav-item active">
                    <a class="navbar-brand" href="PaginaPrincipalAdmin.php">HyperBuild Gamers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productosAdmin.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Crea tu pc</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($nombreUsuario)) {
                        echo '<a class="nav-link" href="cerrar_sesionAdmin.php">Cerrar sesión</a>';
                    } else {
                        echo '<a class="nav-link" href="InicioSesionAdmin.php">Iniciar sesión</a>';
                    }
                    ?>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="RegistroAdmin.php">registro administradores</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="comprobarbauches.php">Tokens</a>
                </li>



            </ul>
            <form class="search-form">
                <input type="search" placeholder="Buscar..." />
                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </nav>
    </div>
    <!-- Contenido principal -->
    <section class="banner">
        <div class="content-banner">
            <p>Componentes Nuevos</p>
            <h2>De la más alta calidad<br />100% Gamers</h2>
            <a href="productos.php">Comprar ahora</a>
        </div>
    </section>
    <section class="container top-categories">
        <h1 class="heading-1">Mejores Categorías</h1>
        <div class="container-categories">
            <div class="card-category category-moca">
                <p>Placas Madres</p>
                <a href="productos.php?categoria=placamadre">Ver más</a>
            </div>
            <div class="card-category category-expreso">
                <p>Tarjetas Gráficas</p>
                <a href="productos.php?categoria=GPU">Ver más</a>
            </div>
            <div class="card-category category-capuchino">
                <p>Procesadores</p>
                <a href="productos.php?categoria=cpu">Ver más</a>
            </div>
        </div>
    </section>
    <section class="container top-products">
        <h1 class="heading-1">Mejores Productos</h1>
        <div class="container-options">
            <span class="active">Destacados</span>
        </div>
        <div class="container-products">
            <?php
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "cocacola");

            if (mysqli_connect_errno()) {
                echo "Error al conectar con la base de datos: " . mysqli_connect_error();
                exit();
            }

            // Consulta SQL para obtener productos aleatorios de cada tabla
            $sql = "(
                    SELECT nombre, descripcion, precio, stock, imagen FROM almacenamiento ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM coolers ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM fuentes ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM cpu ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM liquidas ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM monitores ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM mousepads ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM pastatermica ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM placamadre ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM ram ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM ratones ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM sillas ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM GPU ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM teclados ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM audifonos ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM microfonos ORDER BY RAND() LIMIT 1
                    ) UNION (
                    SELECT nombre, descripcion, precio, stock, imagen FROM ventiladores ORDER BY RAND() LIMIT 1
                    )";

            $resultado = mysqli_query($conexion, $sql);

            // Mostrar los productos aleatorios
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<div class='card-product'>";
                echo "<div class='container-img'>";
                echo "<img src='{$fila['imagen']}' alt='{$fila['nombre']}' />";
                echo "</div>";
                echo "<div class='content-card-product'>";
                echo "<h3>{$fila['nombre']}</h3>";
                echo "<p class='price'>$ {$fila['precio']}</p>";
                echo "</div>";
                echo "</div>";
            }

            // Cerrar la conexión
            mysqli_close($conexion);
            ?>
        </div>
    </section>
    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript Personalizado -->
    <script src="script.js"></script>
</body>
</html>
