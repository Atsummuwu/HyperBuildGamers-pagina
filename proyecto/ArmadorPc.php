<?php
session_start();

// Verificar si el usuario está autenticado, de lo contrario redirigir al inicio de sesión
if (!isset($_SESSION['correo'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

// Inicializar o recuperar la lista de componentes seleccionados desde la sesión
if (!isset($_SESSION['componentes_seleccionados'])) {
    $_SESSION['componentes_seleccionados'] = [];
}

// Procesar el formulario para añadir componentes seleccionados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_componente'])) {
    $id_componente = $_POST['id_componente'];

    // Añadir el componente seleccionado a la lista de componentes en sesión
    if (!in_array($id_componente, $_SESSION['componentes_seleccionados'])) {
        $_SESSION['componentes_seleccionados'][] = $id_componente;
    }
}

// Procesar el formulario para remover componentes seleccionados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remover_componente'])) {
    $id_componente = $_POST['id_componente'];

    // Remover el componente seleccionado de la lista de componentes en sesión
    $_SESSION['componentes_seleccionados'] = array_diff($_SESSION['componentes_seleccionados'], [$id_componente]);
}

// Mostrar la lista de componentes seleccionados
if (!empty($_SESSION['componentes_seleccionados'])) {
    echo "<h2>Componentes seleccionados:</h2>";
    echo "<ul>";
    foreach ($_SESSION['componentes_seleccionados'] as $id) {
        // Aquí podrías consultar la base de datos para obtener detalles del componente
        // y mostrarlos, pero esto dependerá de la estructura de tu base de datos y cómo
        // almacenas la información de cada componente.
        echo "<li>Componente ID: " . htmlspecialchars($id) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No has seleccionado ningún componente.</p>";
}

?>




<!-- Archivo: ArmadorPc.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armador de PC</title>
    <!-- Aquí puedes incluir tus estilos CSS -->
    <style>
        /* Estilos CSS para personalizar la apariencia */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
        }
        .componentes-list {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .componente {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Armador de PC</h1>

    <div class="componentes-list">
        <h2>Componentes seleccionados:</h2>
        <ul>
            <?php
            // Aquí puedes incluir lógica adicional para mostrar los componentes seleccionados
            // Por ejemplo, si vienen de un formulario POST
            ?>
        </ul>
    </div>

    <!-- Aquí puedes añadir más contenido según sea necesario -->

</body>
</html>
