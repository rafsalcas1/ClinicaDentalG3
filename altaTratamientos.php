<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarTratamientos.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevaCita = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioTratamientos.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Tratamientos: Tratamiento apuntado con exito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<?php if (alta_tratamiento($conexion, $nuevoTratamiento)) {  
		?>
				<h1>Tratamiento <?php echo $nuevoTratamiento["nombre"]; ?> registrado correctamente</h1>
				<div >	
			   		Pulsa <a href="verTratamiento.php">aquí</a> para acceder a la gestión de biblioteca.
				</div>
		<?php } else { ?>
				<h1>El tratamiento ya existe.</h1>
				<div >	
					Pulsa <a href="formularioTratamientos.php">aquí</a> para volver al formulario.
				</div>
		<?php } ?>

	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>