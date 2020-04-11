<?php	
	session_start();	
	
	if (isset($_SESSION["doctora"])) {
		$paciente = $_SESSION["doctora"];
		unset($_SESSION["doctora"]);
		
		require_once("gestionBD.php");
		require_once("gestionarDoctora.php");
		
		$conexion = crearConexionBD();		
		$excepcion = eliminarDoctora($conexion,$doctora["OID_DOCTORA"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaDoctora.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: listaDoctora.php");
	}
	else Header("Location: listaDoctora.php");
?>