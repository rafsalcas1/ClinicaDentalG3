<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarPaciente.php");
		
	if (isset($_SESSION["formularioPaciente"])) {
		$nuevoUsuario = $_SESSION["formularioPaciente"];
		$_SESSION["formularioPaciente"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioPaciente.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Gestión de Pacientes: Alta de paciente realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	<?php
		include_once("menu.php");
	?>

	<main>
		<?php if (altaPaciente($conexion, $nuevoUsuario)) {  
		?>
				<h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="listaPaciente.php">aquí</a> para acceder a la lista de pacientes.
				</div>
		<?php } else { ?>
				<h1>No se pudo añadir el paciente con exitó.</h1>
				<h3>El paciente ya está registrado.</h3>
				<div >		
					Pulsa <a href="formularioPaciente.php">aquí</a> para volver al formulario.
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
