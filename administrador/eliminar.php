<?php

// Verificar si se ha enviado el ID de la reserva a eliminar
if(isset($_GET['id_reserva'])) {
    // Obtener el ID de la reserva desde la URL
    $idReserva = $_GET['id_reserva'];

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

    // Consulta SQL para eliminar la reserva
    $sql = "DELETE FROM reservacion WHERE id_reserva = $idReserva";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Notificación emergente en JavaScript
        echo "<script>alert('La reserva ha sido eliminada correctamente');</script>";
        // Regresar a la página anterior en JavaScript
        echo "<script>window.history.go(-1);</script>";
        exit(); // Salir del script después de redirigir
    } else {
        echo "Error al eliminar la reserva: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}

?>