<?php
  /*Iniciamos la sesion*/
  session_start();
  /*Comprobamos si existe el Usuario*/
  if(isset($SESSION['u_usuario'])){ 
    header("Location: validacion.php"); // si existe, lo redireccionamos a validacion.php
  }
  else{
    session_destroy(); // Si no existe, destruimos la sesion
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/index.css">

  <title>Proyecto final</title>
</head>
<body>
    <style>
      h1 {
        color: black; /* Color del texto */
        text-align: center;
        font-size: 18pt;
      }
    </style>
    <!---- Login---->
     <div class="container">
        <div class="card card-container">
            <h1>La Reserva Del Sabor</h1>
            <img id="profile-img" class="profile-img-card" src="img/login.png" />
            <form class="form-signin" action="validacion.php" method="POST">
                <input type="text" id="inputEmail" class="form-control" placeholder="ID de usuario" required autofocus name="id_usuario">
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required name="clave">
                <div id="remember" class="checkbox">
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>

                <a href="registro.html">Registro de usuario</a>

            </form>
        </div>
    </div>
    
    
  <!---- LLamada de las librerias Bootstrap ---->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>