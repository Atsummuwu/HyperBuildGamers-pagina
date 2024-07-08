<?php
session_start();

// Verificar si el usuario está autenticado, de lo contrario redirigir al inicio de sesión
if (!isset($_SESSION['correo'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

// Establecer conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cocacola";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar todos los componentes electrónicos
$query = "SELECT * FROM almacenamiento 
          UNION ALL SELECT * FROM audifonos 
          UNION ALL SELECT * FROM coolers 
          UNION ALL SELECT * FROM cpu 
          UNION ALL SELECT * FROM fuentes 
          UNION ALL SELECT * FROM gpu 
          UNION ALL SELECT * FROM liquidas 
          UNION ALL SELECT * FROM microfonos 
          UNION ALL SELECT * FROM monitores 
          UNION ALL SELECT * FROM mousepads 
          UNION ALL SELECT * FROM pastatermica 
          UNION ALL SELECT * FROM placamadre 
          UNION ALL SELECT * FROM ram 
          ORDER BY id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Mostrar los componentes electrónicos disponibles
    echo "<html><body>";
    echo "<h2>Componentes electrónicos disponibles:</h2>";
    echo "<form action='ArmadorPc.php' method='post'>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acción</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['imagen']) . "' height='100'></td>";
        // Botón para agregar componente
        echo "<td>";
        echo "<input type='hidden' name='id_componente' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<input type='submit' name='agregar_componente' value='Agregar'>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</form>";
    echo "</body></html>";
} else {
    echo "No se encontraron componentes electrónicos.";
}

$conn->close();
?>
