<?php 	

session_start();

$id_usuario = $_POST['id_usuario'];
echo $id_usuario;
$clave 	= $_POST['clave'];
echo $clave;
include("conexion.php");
/* Se verifica si el ususario esta en la base de datos */
$query = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario' AND clave = '$clave'";
	

	$resultado = $con->query($query);

	/* Asignacion de tipo de usuario*/
	if ($row = $resultado->fetch_assoc()) {
		/* tipo_usuario: Administrador*/
		if ($row['id_tipo_usuario'] == '1') {
			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['u_usuario'] = $row['nombres'];
			header("Location: administrador/index.php");
		} else { /* tipo_usuario: Usuario */

			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['u_usuario'] = $row['nombres'];
			header("Location: usuario/index.php");
		}

	} else {
		/* Redireccionamiento al login si no se encuetra el usuario*/
		header("Location: index.php");
	}

	/* Si se produce un error  */
	if (!$query) {
	    printf("Error: %s\n", mysqli_error($conn));
	    exit();
	}
	

 ?>