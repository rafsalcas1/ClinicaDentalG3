<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarDoctora.php");
	require_once("gestionarEspecialidad.php");
		
	
	$conexion = crearConexionBD();
	
	if (isset($_SESSION["formularioDoctora"])) {
		$doctora = $_SESSION["formularioDoctora"];
		$_SESSION["formularioDoctora"] = null;
		$_SESSION["errores"] = null;
		$especialidad = buscaEspecialidad($conexion, "Especialidad");
	}
	else 
		Header("Location: formularioDoctora.php");	 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Doctora: Alta de doctora realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<?php
			 
			 if (altaDoctora($conexion, $doctora, $especialidad["OID_ESPECIALIDAD"])) {  
		?>
				<h1>Hola <?php echo $nuevaDoctora["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="listaDoctora.php">aquí</a> para acceder a la lista de doctoras.
				</div>
		<?php } else { ?>
				<h1>Esta doctora ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="formularioDoctora.php">aquí</a> para volver al formulario.
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
