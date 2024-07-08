<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "cocacola");

    // Verificar la conexión
    if (mysqli_connect_errno()) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Recuperar datos del formulario
    $marca = $_POST['marca'];
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    // Ruta donde se guardarán las imágenes
    $carpeta_destino = "fotos/";



    // Manejo de la primera imagen
    $nombre_temporal1 = $_FILES["imagen1"]["tmp_name"];
    $nombre_archivo1 = $_FILES["imagen1"]["name"];
    $extension1 = pathinfo($nombre_archivo1, PATHINFO_EXTENSION);
    $nombre_final1 = uniqid() . "." . $extension1; // Renombrar archivo
    $ruta_imagen1 = $carpeta_destino . $nombre_final1;
    move_uploaded_file($nombre_temporal1, $ruta_imagen1);

    // Manejo de la segunda imagen
    $nombre_temporal2 = $_FILES["imagen2"]["tmp_name"];
    $nombre_archivo2 = $_FILES["imagen2"]["name"];
    $extension2 = pathinfo($nombre_archivo2, PATHINFO_EXTENSION);
    $nombre_final2 = uniqid() . "." . $extension2; // Renombrar archivo
    $ruta_imagen2 = $carpeta_destino . $nombre_final2;
    move_uploaded_file($nombre_temporal2, $ruta_imagen2);

    // Manejo de la tercera imagen
    $nombre_temporal3 = $_FILES["imagen3"]["tmp_name"];
    $nombre_archivo3 = $_FILES["imagen3"]["name"];
    $extension3 = pathinfo($nombre_archivo3, PATHINFO_EXTENSION);
    $nombre_final3 = uniqid() . "." . $extension3; // Renombrar archivo
    $ruta_imagen3 = $carpeta_destino . $nombre_final3;
    move_uploaded_file($nombre_temporal3, $ruta_imagen3);

    // Preparar la consulta SQL para insertar los datos del producto en la tabla
    $sql = "INSERT INTO cpu (marca, nombre, descripcion, precio, stock, imagen, imagen2, imagen3) 
            VALUES ('$marca', '$nombre', '$descripcion', '$precio', '$stock', '$ruta_imagen1', '$ruta_imagen2', '$ruta_imagen3')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        echo "¡Producto agregado exitosamente!"; // Mensaje de éxito
    } else {
        echo "Error al agregar el producto: " . mysqli_error($conexion); // Mensaje de error
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
