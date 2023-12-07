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

          echo "Usuario: <br>" . $_SESSION['u_usuario'] . "<br>";
          echo "<a href='../cerrar_sesion.php' class='btn btn-danger' style='margin-left: 10px'>Cerrar Sesión</a>";
          echo "<a href='index.php' class='btn btn-primary' style='margin-left: 10px'>Mesas</a>";
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
	        		<h1>Reservaciones del usuario</h1>
	        	</div>
        </div>
	    </div>
	</div>
    <style>
      h1 {
        color: white; /* Color del texto */
        text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black;
        position: relative;
        left: 35%;
      }
    </style>
  <?php
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

    // ID de usuario para filtrar las reservaciones
    $idUsuario = $_SESSION['id_usuario']; 

    // Consulta SQL para obtener las reservaciones del usuario especificado
    $sql = "SELECT id_reserva, num_mesa, fecha_reservacion, hora_reservacion FROM reservacion WHERE id_usuario = $idUsuario";

    // Ejecutar la consulta y obtener los resultados
    $result = $conn->query($sql);

    // Comprobar si se encontraron reservaciones
    if ($result->num_rows > 0) {
        // Imprimir la tabla 
        echo '<div style="display: flex; justify-content: center;">';
        echo '<table style="border-collapse: collapse; width: 60%;">';
        echo '<tr>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Número de Mesa</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Fecha de Reservación</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Hora de Reservación</th>';
        echo '<th style="padding: 8px; border: 1px solid black; background-color: #f2f2f2; font-weight: bold;">Modificar reserva</th>';
        echo '</tr>';

        // Iterar sobre cada fila de resultados
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            
            echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["num_mesa"] . '</td>';
            echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["fecha_reservacion"] . '</td>';
            echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">' . $row["hora_reservacion"] . '</td>';
            echo '<td style="padding: 8px; border: 1px solid black; background-color: #f2f2f2;">';
            echo "<a href='Modificar.php?id_reserva=" . $row["id_reserva"] . "&id_mesa=" . $row["num_mesa"] . "' class='btn btn-danger' style='margin-left: 10px'>Modificar</a>";
            echo "<a href='javascript:eliminarReserva(" . $row["id_reserva"] . ")' class='btn btn-primary' style='margin-left: 10px'>Eliminar</a>";
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';

    } else {
        echo "No se encontraron reservaciones para el usuario";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
      
 
  <!-- LLamada de librerias de Bootstrap -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
 