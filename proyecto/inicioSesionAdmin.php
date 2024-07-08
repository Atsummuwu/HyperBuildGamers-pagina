<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión, si es así, redirigirlo a la página de inicio
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: PaginaPrincipalAdmin.php");
    exit;
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "cocacola");

    // Verificar la conexión
    if (mysqli_connect_errno()) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Recuperar el correo electrónico y la contraseña del formulario
    $correo = $_POST['loginEmail'];
    $contrasena = $_POST['loginPassword'];

    // Preparar la consulta SQL para buscar el usuario en la base de datos
    $sql = "SELECT id, nombres, correo_electronico, contrasena FROM admins WHERE correo_electronico = '$correo'";

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si se encontró el usuario
    if (mysqli_num_rows($resultado) == 1) {
        // Obtener la fila del resultado como un array asociativo
        $fila = mysqli_fetch_assoc($resultado);
        // Verificar la contraseña
        if ($contrasena == $fila['contrasena']) {
            // Iniciar la sesión
            session_start();
            // Almacenar datos de sesión
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $fila['id'];
            $_SESSION["correo"] = $fila['correo_electronico'];
            $_SESSION["usuario"] = $fila['nombres'];
            // Redirigir al usuario a la página de bienvenida
            header("location: PaginaPrincipalAdmin.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El correo electrónico ingresado no está registrado.";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="PaginaPrincipal.php">MiTienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="RegistroAdmin.php">Registrarse</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form id="loginForm" method="post" action="InicioSesionAdmin.php">
            <div class="form-group">
                <label for="loginEmail">Correo electrónico</label>
                <input type="email" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp"
                    placeholder="Ingrese su correo electrónico">
                <small id="emailHelp" class="form-text text-muted">No compartiremos su correo electrónico con nadie más.</small>
            </div>
            <div class="form-group">
                <label for="loginPassword">Contraseña</label>
                <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            
            <button type="button" class="btn btn-outline-secondary ml-2"
                onclick="location.href='paginaprincipal.php'">Volver</button>

                <button type="button" class="btn btn-outline-secondary ml-2"
                onclick="location.href='InicioSesion.php'">No eres funcionario? Entra aca</button>


        </form>
    </div>

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript Personalizado -->
    <script src="script.js"></script>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">© 2024 HyperBuild Gamers. Todos los derechos reservados.</span>
        </div>
    </footer>

</body>

</html>
