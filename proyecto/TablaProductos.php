<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú de Categorías</title>
  <!-- Enlace al CSS de Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <style>
    body {
      background-color: #f5f5f5;
    }
    .tabla-categorias {
      background-color: #7b1fa2;
      color: #fff;
    }
    .tabla-categorias th, .tabla-categorias td {
      border: 1px solid #fff;
    }
    .tabla-categorias a {
      color: #fff;
    }
    .tabla-categorias a:hover {
      color: #f0f0f0;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center mb-4">Menú de Categorías</h2>
        <div class="table-responsive">
          <table class="table table-bordered tabla-categorias">
            <thead>
              <tr>
                <th>Categoría</th>
              </tr>
            </thead>
            <tbody>



              <tr>
                <td><a href="adcpu.php">CPU</a></td>
              </tr>

              <tr>
                <td><a href="adcoolers.php">Coolers</a></td>
              </tr>

              <tr>
                <td><a href="addiscos.php">Almacenamiento</a></td>
              </tr>


              <tr>
                <td><a href="admonitores.php">Monitores</a></td>
              </tr>

              <tr>
                <td><a href="adplaca.php">placas madres</a></td>
              </tr>

              <tr>
                <td><a href="adgpu.php">Tarjetas Graficas</a></td>
              </tr>

              <tr>
                <td><a href="addiscos.php">discos</a></td>
              </tr>

              <tr>
                <td><a href="adliquidas.php">Liquidas</a></td>
              </tr>




              <!-- Agrega más filas según tus necesidades -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-outline-secondary ml-2"
        onclick="location.href='productosAdmin.php'">volver</button>
</body>
</html>
