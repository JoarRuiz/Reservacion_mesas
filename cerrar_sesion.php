<?php 	
	/* Se destruye la sesion y te redireccionamiento a el login*/
	session_start();
	session_destroy();

	header("Location: index.php");

 ;