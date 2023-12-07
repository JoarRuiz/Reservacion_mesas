<?php
// Verificar si se ha enviado un ID de reserva y un ID de mesa
if (isset($_GET['id_reserva']) && isset($_GET['id_mesa'])) {
    $idReserva = $_GET['id_reserva'];
    $idMesa = $_GET['id_mesa'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto_calidad";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para obtener la reserva con el ID especificado
    $sql = "SELECT * FROM reservacion WHERE id_reserva = $idReserva";
    $result = $conn->query($sql);

    // Verificar si se encontró la reserva
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numMesa = $row['num_mesa'];
        $fechaReservacion = $row['fecha_reservacion'];
        $horaReservacion = $row['hora_reservacion'];

        // Verificar si se ha enviado el formulario de modificación
        if (isset($_POST['enviar'])) {
            // Obtener los nuevos valores de fecha y hora enviados en el formulario
            $nuevaFecha = $_POST['fecha_reservacion'];
            $nuevaHora = $_POST['hora_reservacion'];

            // Actualizar los datos de la reserva en la base de datos
            $sqlUpdate = "UPDATE reservacion SET fecha_reservacion = '$nuevaFecha', hora_reservacion = '$nuevaHora' WHERE id_reserva = $idReserva";
            if ($conn->query($sqlUpdate) === TRUE) {
              header("Location: reservas.php");
            } else {
                echo "Error al actualizar la reserva: " . $conn->error;
            }
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modificar Reserva</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fondo.css">
    <link rel="stylesheet" href="../css/index1.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0" style="color: #fff">  
      <?php   
      session_start();
        /* Busca al usuario*/
        if (isset($_SESSION['u_usuario'])) {
        /* Proporciona el nombre del usuario y da la opcion para cerrar sesion*/

          echo "Usuario: <br>" . $_SESSION['u_usuario'] . "<br>";
          echo "<a href='../cerrar_sesion.php' class='btn btn-danger' style='margin-left: 10px'>Cerrar Sesión</a>";
          echo "<a href='index.php.' class='btn btn-primary' style='margin-left: 10px'>Mesas </a>";
        } else {
          /*Redirige al login si no esta el usuario*/
          header("Location: ../index.php");
        }
      ?>
      </form>
    </div>
  </nav>
    <div class="container">
        <div class="card card-container">
            <h1>Actualizar Reserva</h1>
            <form method="POST">
                <label for="fecha_reservacion">Fecha:</label>
                <input type="date" id="fecha_reservacion" name="fecha_reservacion" min="" value="<?php echo $fechaReservacion; ?>" required>
                  <script>
                  // Obtener el elemento de entrada de fecha
                  var fechaInput = document.getElementById("fecha_reservacion");

                  // Obtener la fecha actual
                  var fechaActual = new Date().toISOString().split("T")[0];

                  // Establecer la fecha mínima en el atributo "min" del elemento de entrada
                  fechaInput.min = fechaActual;
                </script>
                <br><br>
                <label for="hora_reservacion">Hora:</label>
                <input type="time" id="hora_reservacion" name="hora_reservacion" value="<?php echo $horaReservacion; ?>" required>
                <script>
                // Obtener el elemento de entrada de hora
                var horaInput = document.getElementById("hora_reservacion");

                // Obtener la hora actual
                var horaActual = new Date().getHours();

                // Calcular la hora mínima permitida (2 horas después de la hora actual)
                var horaMinima = horaActual + 2;
                if (horaMinima >= 10) {
                  horaMinima = 10; // Establecer 10 AM como la hora mínima si es menor a 10
                } else if (horaMinima <= 20) {
                  // Si la hora mínima es igual o mayor a las 8 PM, avanzar al día siguiente
                  horaMinima = 10; // Establecer 10 AM como la hora mínima del siguiente día
                }

                // Formatear la hora mínima en el formato requerido por el campo de entrada
                var horaMinimaFormatted = horaMinima.toString().padStart(2, "0") + ":00";

                // Calcular la hora máxima permitida (8 PM)
                var horaMaxima = 20;
                var horaMaximaFormatted = horaMaxima.toString().padStart(2, "0") + ":00";

                // Establecer la hora mínima y máxima en los atributos "min" y "max" del campo de entrada
                horaInput.min = horaMinimaFormatted;
                horaInput.max = horaMaximaFormatted;
                </script>
                <br><br>
                <button type="submit" name="enviar" id="Enviar" value="Enviar" title="Enviar" class="btn btn-lg btn-primary btn-block btn-signin">Actualizar</button>
            </form>
        </div>
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

<?php
    } else {
        echo "No se encontró la reserva con ID $idReserva";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "ID de reserva o ID de mesa no proporcionados";
}
?>
