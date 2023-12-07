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
          echo "<a href='reservas.php' class='btn btn-primary' style='margin-left: 10px'>Mirar reservas</a>";
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
	        		<h1>Croquis distribucion de las mesas</h1>
	        	</div>
        </div>
	    </div>
	</div>
  <style>
    .imagen1 {
    position: relative;
    top: 20px; /*Vertical */
    left: 200px; /*Horizontal*/ 
  }
  .imagen2 {
    position: relative;
    top: 180px; /*Vertical */
    left: 45px; /*Horizontal*/ 
  }
  .imagen3 {
    position: relative;
    top: 350px; /*Vertical */
    left: -110px; /*Horizontal*/ 
  }
  .imagen4 {
    position: relative;
    top: 20px; /*Vertical */
    left: 100px; /*Horizontal*/ 
  }
  .imagen5 {
    position: relative;
    top: 180px; /*Vertical */
    left: -105px; /*Horizontal*/ 
  }.imagen6 {
    position: relative;
    top: 350px; /*Vertical */
    left: -310px; /*Horizontal*/ 
  }
  .imagen7 {
    position: relative;
    top: 20px; /*Vertical */
    left: -90px; /*Horizontal*/ 
  }
  .imagen8 {
    position: relative;
    top: 20px; /*Vertical */
    left: 990px; /*Horizontal*/ 
  }.imagen9 {
    position: relative;
    top: 175px; /*Vertical */
    left: 840px; /*Horizontal*/ 
  }
  h1 {
    color: white; /* Color del texto */
    text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black;
    position: relative;
    left: 30%;
  }
  
  </style>
  <script>
    // Asignar el valor a la imagen y almacenarlo en localStorage al hacer clic
    function asignarValor(valor) {
      localStorage.setItem('num_mesa', valor);
    }
  </script>

  <a href="hacerReserva.php" onclick="asignarValor('1')">
    <img src="../img/image1.png" width="150" height="150" class="imagen1" />
  </a>

  <!------<a href="hacerReserva.php" id="num_mesa" name="num_mesa" value="1"><img src="../img/image1.png" width="150" height="150" class="imagen1" /></a>---->
  <a href="hacerReserva.php" onclick="asignarValor('2')">
    <img src="../img/image2.png" width="150" height="150" class="imagen2" />
  </a>
  <a href="hacerReserva.php" onclick="asignarValor('3')">
    <img src="../img/image3.png" width="150" height="150" class="imagen3" />
  </a>

  <a href="hacerReserva.php" onclick="asignarValor('4')">
    <img src="../img/image4.png" width="200" height="200" class="imagen4" />
  </a>

  <a href="hacerReserva.php" onclick="asignarValor('5')">
    <img src="../img/image5.png" width="200" height="200" class="imagen5" />
  </a>

  <a href="hacerReserva.php" onclick="asignarValor('6')">
    <img src="../img/image6.png" width="200" height="200" class="imagen6" />
  </a>

  <a href="hacerReserva.php" onclick="asignarValor('7')">
    <img src="../img/image7.png" width="150" height="150" class="imagen7" />
  </a>

  <a href="hacerReserva.php" onclick="asignarValor('8')">
    <img src="../img/image8.png" width="150" height="150" class="imagen8" />
  </a>

  <a href="hacerReserva.php" onclick="asignarValor('9')">
    <img src="../img/image9.png" width="150" height="150" class="imagen9" />
  </a>
 
  <!-- LLamada de librerias de Bootstrap -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
 