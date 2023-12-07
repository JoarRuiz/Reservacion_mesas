<?php
/* Conexion a la base de datos */
function conectar(){
	$usuario='root'; 
	$contrasena='';
	$servidor='localhost';
	$MiBD ="proyecto_calidad";

	/* Comprobacion para saber si se conecto a la base de datos */
	if (!($link=mysqli_connect($servidor,$usuario,$contrasena) or die("No esta lista la conexion")))   
				{       exit();     }
    if (!mysqli_select_db($link,$MiBD))    
      exit();     
  return $link;
}
?>
