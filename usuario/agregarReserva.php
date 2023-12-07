<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="est/style.css">
  <link rel="stylesheet" type="text/css" href="est/form.css">
  <title>Registrar reservacion</title>
</head>
<body>
<?php

include("../conexionR.php");
$con = conectar();

$consulta = "select * from reservacion";
$resultado = mysqli_query($con, $consulta);

$sentenciaSQL = "insert into reservacion (Num_mesa, Fecha_reservacion, Hora_reservacion,Id_usuario) values ('$_POST[num_mesa]', '$_POST[fecha_reservacion]', '$_POST[hora_reservacion]',  '$_POST[id_usuario]')";

mysqli_query($con, $sentenciaSQL); 

header("location: reservas.php");
?>

</body>
</html>

 