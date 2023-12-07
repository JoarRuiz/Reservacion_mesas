<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_calidad";
/*  Creamos la conexion a la base de datos*/
$con = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($con,"utf8");

/* Comprobacion para saber si se conecto a la base de datos */
if ($con->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
	/* Conexión exitosa;*/
}

?>