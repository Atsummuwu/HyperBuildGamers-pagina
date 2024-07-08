<?php
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
    // Imprimir los resultados en una tabla HTML
    echo "<html><body><table border='1'>
    <tr>
    <th>ID</th>
    <th>Marca</th>
    <th>Nombre</th>
    <th>Stock</th>
    <th>Precio</th>
    <th>Descripción</th>
    <th>Imagen</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['marca'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['stock'] . "</td>";
        echo "<td>" . $row['precio'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td><img src='" . $row['imagen'] . "' height='100'></td>";
        echo "</tr>";
    }
    echo "</table></body></html>";
} else {
    echo "No se encontraron componentes electrónicos.";
}

$conn->close();
?>
