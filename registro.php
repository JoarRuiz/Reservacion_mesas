<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="est/style.css">
  <link rel="stylesheet" type="text/css" href="est/form.css">
  <title>Registrar usuario</title>
</head>
<body>
<?php

include("conexionR.php");
$con = conectar();


$consulta="select * from usuarios";
$resultado=mysqli_query($con,$consulta);

$sentenciaSQL = "insert into usuarios (Id_usuario,Clave,Nombres, Apellidos, Email, Id_tipo_usuario,Numero_telefonico) values ('$_POST[id_usuario]','$_POST[clave]','$_POST[nombres]','$_POST[apellidos]','$_POST[email]','$_POST[id_tipo_usuario]','$_POST[numero_telefonico]')";

mysqli_query($con,$sentenciaSQL); 


header("location: index.php");
?>


</body>
</html>

