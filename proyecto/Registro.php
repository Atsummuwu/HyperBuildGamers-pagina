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
  $nombres = $_POST['registerFirstName'];
  $apellidos = $_POST['registerLastName'];
  $rut = $_POST['rut'];
  $fecha_nacimiento = $_POST['registerDOB'];
  $correo = $_POST['registerEmail'];
  $contrasena = $_POST['registerPassword'];

  // Preparar la consulta SQL para insertar los datos del usuario en la tabla
  $sql = "INSERT INTO usuarios (nombres, apellidos, rut, fecha_nacimiento, correo_electronico, contrasena) 
            VALUES ('$nombres', '$apellidos', '$rut', '$fecha_nacimiento', '$correo', '$contrasena')";

  // Ejecutar la consulta SQL
  if (mysqli_query($conexion, $sql)) {
    echo "¡Registro exitoso!"; // Mensaje de éxito
  } else {
    echo "Error al registrar el usuario: " . mysqli_error($conexion); // Mensaje de error
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
  <title>Registro</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Personalizado -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MiTienda</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="InicioSesion.html">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container mt-5">
    <h2 class="text-center mb-4">Registrarse</h2>
    <form id="registerForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="registerFirstName">Nombres</label>
          <input type="text" class="form-control" id="registerFirstName" name="registerFirstName" placeholder="Nombres"
            required>
        </div>
        <div class="form-group col-md-6">
          <label for="registerLastName">Apellidos</label>
          <input type="text" class="form-control" id="registerLastName" name="registerLastName" placeholder="Apellidos"
            required>
        </div>
      </div>





      <!--  ACA SE VALIDA EL RUT CON EL VALIDADOR DEL PROFESOR HANS-->
        
      <div
            class="form-group col-md-6">
          <label for="registerLastName">Rut</label>

     <input type="text" id="rut" name="rut" required oninput="checkRut(this)" placeholder="Ingrese RUT">
      

        <script src="validarRUT.js"></script>

      </div>






      <div class="form-group">
        <label for="registerDOB">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="registerDOB" name="registerDOB" required>
      </div>

      <div class="form-group">
        <label for="registerEmail">Correo electrónico</label>
        <input type="email" class="form-control" id="registerEmail" name="registerEmail" aria-describedby="emailHelp"
          placeholder="Correo electrónico" required>
        <small id="emailHelp" class="form-text text-muted">No compartiremos su correo electrónico con nadie más.</small>
      </div>










      <div class="form-group">
  <label for="registerPassword">Contraseña</label>
  <div class="input-group">
    <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Contraseña" required>
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button" id="togglePassword">
        <i class="fa fa-eye-slash"></i>
      </button>
    </div>
  </div>
</div>

<script>
  // Función para validar la contraseña
  function validarPassword(password) {
    // Requerir al menos una mayúscula y un número
    var regex = /^(?=.*[A-Z])(?=.*\d).+$/;
    return regex.test(password);
  }

  // Evento para validar la contraseña al perder el foco del input
  document.getElementById('registerPassword').addEventListener('blur', function() {
    var passwordInput = this.value;
    if (passwordInput.trim() !== '') {
      if (!validarPassword(passwordInput)) {
        alert('La contraseña debe contener al menos una mayúscula y un número');
        this.value = ''; // Limpiar el valor del input si es inválido
        this.focus(); // Devolver el foco al input
      }
    }
  });

  // Evento para mostrar u ocultar la contraseña
  document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordInput = document.getElementById('registerPassword');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      this.innerHTML = '<i class="fa fa-eye"></i>';
    } else {
      passwordInput.type = 'password';
      this.innerHTML = '<i class="fa fa-eye-slash"></i>';
    }
  });
</script>













      <div class="form-group">
        <label for="registerConfirmPassword">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="registerConfirmPassword" placeholder="Confirmar Contraseña"
          required>
      </div>

      <button type="submit" class="btn btn-primary">Registrarse</button>
      <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='inicioSesion.php'">Volver</button>

    </form>
  </div>


  <!-- Bootstrap JS y jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- JavaScript Personalizado -->
  <script src="script.js"></script>
</body>

</html>