
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
    <link rel="stylesheet" href="../css/index1.css">

  	<title>Aministrador de encuestas</title>

    <!---- Script que proporciona acceso al historial del navegador a través del objeto history ---->
    <script type="text/javascript" language="javascript">   
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
        history.go(1);
      };
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
          echo "<a href='index.php.' class='btn btn-primary' style='margin-left: 10px'>Mesas </a>";
        } else {
          /*Redirige al login si no esta el usuario*/
          header("Location: ../index.php");
        }
      ?>
      </form>
    </div>
  </nav>

  <style>
  h1 {
    color: black; /* Color del texto */
    text-align: center;
  }
  
  </style>

    <!---- Formulario de reservaciones---->
     <div class="container">
        <div class="card card-container">
          <h1>Reservacion de mesa</h1><br>
            <img id="profile-img" class="profile-img-card" src="../img/reserva.png" />
            <form id="formRegistro" name="formRegistro" placeholder="Nombre" method="post" action="agregarReserva.php" id="frm" >  
            <div>
              <label for="ID usuario">Id de usuario</label>
              <input type="text" name="id_usuario" id="id_usuario" class="form-control" value="<?php echo $_SESSION['id_usuario']; ?>" readonly required />
            </div>
            <div>
              <label for="numero de mesa ">Número de mesa</label>
              <input type="text" name="num_mesa" id="num_mesa" class="form-control" readonly required />
            </div><br>
            
            <script>
              // Obtener el valor de la imagen almacenado en localStorage y asignarlo al campo de entrada
              var num_mesa = localStorage.getItem('num_mesa');
              document.getElementById('num_mesa').value = num_mesa;
            </script>
            
            <label for="fecha">Fecha: </label>
            <input type="date" id="fecha_reservacion" name="fecha_reservacion" min="" required>

            <script>
              // Obtener el elemento de entrada de fecha
              var fechaInput = document.getElementById("fecha_reservacion");

              // Obtener la fecha actual
              var fechaActual = new Date().toISOString().split("T")[0];

              // Establecer la fecha mínima en el atributo "min" del elemento de entrada
              fechaInput.min = fechaActual;
            </script>
            <br/><br/>
            <label for="hora">Hora: </label>
            <input type="time" id="hora_reservacion" name="hora_reservacion" required>

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
             <br></br>     
            <button type="submit" name="enviar" id="Enviar" value="Enviar" title="Enviar" class="btn btn-lg btn-primary btn-block btn-signin" >Reservar</button>


                  
            </form>
        </div>
    </div>
    
  
      
 
  <!-- LLamada de librerias de Bootstrap -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
 
  </body>
</html>