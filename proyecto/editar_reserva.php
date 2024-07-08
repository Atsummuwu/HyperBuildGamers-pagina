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

    // Verificar si se envió el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $mensaje = $_POST['mensaje'];

        // Preparar la consulta SQL para actualizar la reserva
        $sql = "UPDATE ReservasSoporteTecnico SET nombre='$nombre', telefono='$telefono', fecha='$fecha', hora='$hora', mensaje='$mensaje' WHERE id=$id_reserva";

        // Ejecutar la consulta SQL
        if (mysqli_query($conexion, $sql)) {
            echo "Reserva actualizada con éxito";
        } else {
            echo "Error al actualizar la reserva: " . mysqli_error($conexion);
        }
    }

    // Consulta SQL para obtener los detalles de la reserva con el ID proporcionado
    $sql = "SELECT * FROM ReservasSoporteTecnico WHERE id = $id_reserva";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si se encontró la reserva
    if ($fila = mysqli_fetch_assoc($resultado)) {
        // Mostrar un formulario prellenado con los detalles de la reserva
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Reserva</title>


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
            <h1>Editar Reserva</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_reserva; ?>" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>" required><br><br>
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo $fila['telefono']; ?>"><br><br>
                <label for="fecha">Fecha preferida:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>" required><br><br>
                <label for="hora">Hora preferida:</label>
                <input type="time" id="hora" name="hora" value="<?php echo $fila['hora']; ?>" required><br><br>
                <label for="mensaje">Mensaje:</label><br>
                <textarea id="mensaje" name="mensaje" rows="4" cols="50" required><?php echo $fila['mensaje']; ?></textarea><br><br>
                <input type="submit" value="Guardar cambios">
            </form>
        </body>

        <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='Formulario_reserva.php'">Volver</button>

        </html>
<?php
    } else {
        echo "No se encontró la reserva.";
    }

    // Liberar resultado y cerrar conexión
    mysqli_free_result($resultado);
    mysqli_close($conexion);
} else {
    echo "ID de reserva no proporcionado.";
}
?>
