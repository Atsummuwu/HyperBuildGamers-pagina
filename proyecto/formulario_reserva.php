<?php
session_start();

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['usuario'])) {
    // Si no hay una sesión iniciada, redirigir al usuario a la página de inicio de sesión
    header("Location: iniciosesion.php");
    exit; // Finaliza la ejecución del script después de redirigir
}

// Obtener el nombre de usuario de la sesión
$nombre_usuario = $_SESSION['usuario'];
$correo_usuario = $_SESSION['correo']; // Nuevo: Obtener el correo electrónico de la sesión

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cocacola");

// Verificar la conexión
if (mysqli_connect_errno()) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Consulta SQL para obtener las reservas del usuario actual
$sql_reservas = "SELECT * FROM ReservasSoporteTecnico WHERE email = '$correo_usuario'";
$resultado_reservas = mysqli_query($conexion, $sql_reservas);

// Verificar si se encontraron resultados
if (!$resultado_reservas) {
    die("Error al obtener las reservas: " . mysqli_error($conexion));
}

// Procesar el formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $correo_usuario; // Nuevo: Usar el correo electrónico de la sesión
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $mensaje = $_POST['mensaje'];

    // Preparar la consulta SQL para insertar los datos en la tabla ReservasSoporteTecnico
    $sql = "INSERT INTO ReservasSoporteTecnico (nombre, email, telefono, fecha, hora, mensaje) 
            VALUES ('$nombre','$email', '$telefono', '$fecha', '$hora', '$mensaje')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        echo "Reserva realizada con éxito";
        // Redirigir al usuario para evitar envío de formulario al recargar
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error al realizar la reserva: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva</title>
    <link rel="stylesheet" href="stylehora.css">


    <style>
        /* Estilo del formulario */
        form {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilo de la tabla de reservas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>






</head>

<body>
    <!-- Contenido del formulario de reserva -->
    <h1>Formulario de Reserva</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <!-- El campo de correo electrónico ya no es necesario -->
        <!-- <label for="email">Correo electrónico:</label> -->
        <!-- Permitir al usuario ingresar el correo manualmente -->
        <!-- <input type="text" id="email" name="email" required><br><br> -->

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"><br><br>

        <label for="fecha">Fecha preferida:</label>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="hora">Hora preferida:</label>
        <input type="time" id="hora" name="hora" required><br><br>

        <label for="mensaje">Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Enviar reserva">

        <!-- Botón de Volver -->
        <div class="back-button" onclick="location.href='PaginaPrincipal.php'">
            <button>Volver</button>
        </div>
    </form>

    <!-- Tabla de reservas -->
    <h2>Reservas realizadas por <?php echo $nombre_usuario; ?></h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Mensaje</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado_reservas)) { ?>
            <tr>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
                <td><?php echo $fila['fecha']; ?></td>
                <td><?php echo $fila['hora']; ?></td>
                <td><?php echo $fila['mensaje']; ?></td>
                <td>
                    <a href="editar_reserva.php?id=<?php echo $fila['id']; ?>">Editar</a> |
                    <a href="eliminar_reserva.php?id=<?php echo $fila['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
