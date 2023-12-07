<?php 
  /* Genera la fecha actual */
  date_default_timezone_set("America/Lima");
  $date = new DateTime();

  $fecha_inicio = $date->format('Y-m-d H:i:s');
  
 ?>


<!DOCTYPE html>
<html lang="es">
<head>

  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  	<!-- CSS -->
  	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fondo.css">

  	<title>Aministrador de encuestas</title>

    <!---- Script que proporciona acceso al historial del navegador a través del objeto history ---->
    <script type="text/javascript" language="javascript">   
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
        history.go(1);
      };
      function eliminarReserva(id_reserva) {
            if (confirm('¿Estás seguro de que deseas eliminar la reserva ?')) {
                // Hacer una solicitud AJAX para eliminar la reserva
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // La reserva se eliminó correctamente
                            alert('La reserva Seleccionada ha sido eliminada.');
                            // Actualizar la página para refrescar la tabla de reservas
                            location.reload();
                        } else {
                            // Hubo un error al eliminar la reserva
                            alert('Error al eliminar la reserva con ID ' + id_reserva + '. Por favor, inténtalo de nuevo.');
                        }
                    }
                };
                xhr.open('GET', 'eliminar.php?id_reserva=' + id_reserva, true);
                xhr.send();
            }
        }
    </script>

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

          echo "Administrador: <br>" . $_SESSION['u_usuario'] . "<br>";
          echo "<a href='../cerrar_sesion.php' class='btn btn-danger' style='margin-left: 10px'>Cerrar Sesión</a>";
        } else {
          /*Redirige al login si no esta el usuario*/
          header("Location: ../index.php");
        }
      ?>
      </form>
    </div>
  </nav>

	<!---- Contenido de texto del index ---->
	<div class="container" style="margin-top: 30px;">
	    <div class="row">
	        <div class="col-md-12 row">
	        	<div class="col-md-10 col-xs-12">
	        		<h1>Reservas de usuarios</h1>
	        	</div>
        </div>
	    </div>
	</div>
  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_calidad";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$query = "SELECT DISTINCT fecha_reservacion, num_mesa FROM reservacion";
$result = mysqli_query($conn, $query);

// Crear una matriz para almacenar la disponibilidad de las mesas por día
$disponibilidadMesasPorDia = array();

// Inicializar todas las mesas como disponibles
$mesasDisponibles = array(1, 2, 3, 4, 5, 6, 7, 8, 9);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fechaReservacion = $row['fecha_reservacion'];
        $numMesa = $row['num_mesa'];

        // Verificar si la fecha ya existe en la matriz
        if (!isset($disponibilidadMesasPorDia[$fechaReservacion])) {
            $disponibilidadMesasPorDia[$fechaReservacion] = $mesasDisponibles;
        }

        // Quitar la mesa reservada de las disponibles para esa fecha
        $index = array_search($numMesa, $disponibilidadMesasPorDia[$fechaReservacion]);
        if ($index !== false) {
            unset($disponibilidadMesasPorDia[$fechaReservacion][$index]);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Disponibilidad de Mesas por Día</title>
    <style>
        h1 {
          color: white; /* Color del texto */
          text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black;
          position: relative;
          left: 40%;
        }
        h3 {
          color: white; /* Color del texto */
          text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black;
          position: relative;
          text-align: center;
        }
        
    </style>
    </style>
</head>
<body>
    <h3>Disponibilidad de Mesas por Día</h3>
    <div style="display: flex; justify-content: center;">
    <table style="border-collapse: collapse; width: 40%;">
    <tr>
        <th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Fecha de Reservación</th>
        <th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Mesas Disponibles</th>
    </tr>
    <?php foreach ($disponibilidadMesasPorDia as $fecha => $mesasDisponibles) { ?>
        <tr>
            <td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;"><?php echo $fecha; ?></td>
            <td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">
                <?php
                if (!empty($mesasDisponibles)) {
                    echo implode(", ", $mesasDisponibles);
                } else {
                    echo "Todas las mesas están reservadas";
                }
                ?>
            </td>
        </tr>
    <?php } ?>
    <?php if (empty($disponibilidadMesasPorDia)) { ?>
        <tr>
            <td colspan="2" style="padding: 8px; border: 1px solid black;">No hay mesas disponibles</td>
        </tr>
    <?php } ?>
</table> </div>
    <br></br>
  <div>  
  <h3>Usuario y reserva<h3>
    </div>
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_calidad";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$query = "SELECT reservacion.*, usuarios.* FROM reservacion JOIN usuarios ON reservacion.id_usuario = usuarios.id_usuario";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    
        
        echo '<div style="display: flex; justify-content: center;">';
        echo '<table style="border-collapse: collapse; width: 95%;">';
        echo '<tr>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Id usuario</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Nombre(S)</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Apellidos</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Numero telefonico</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Correo</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Numero de mesa</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Fecha de reservacion</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Hora de reservacion</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Modificar reserva</th>';
        echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        
        echo '<tr>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["id_usuario"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["nombres"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["apellidos"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["numero_telefonico"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["email"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["num_mesa"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["fecha_reservacion"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["hora_reservacion"] . '</td>';
        echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">';
        echo "<a href='Modificar.php?id_reserva=" . $row["id_reserva"] . "&id_mesa=" . $row["num_mesa"] . "' class='btn btn-danger float-left' style='margin-left: 10px'>Modificar</a>";
        echo "<a href='javascript:eliminarReserva(" . $row["id_reserva"] . ")' class='btn btn-primary float-right ' style='margin-left: 10px'>Eliminar</a>";
        echo '</td>';
        echo '</tr>';
    }

    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($conn);
?>
</body>
</html>
      
 
  <!-- LLamada de librerias de Bootstrap -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
 