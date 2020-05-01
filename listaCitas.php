<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("paginacionConsulta.php");
	
	$conexion = crearConexionBD();
	$todasCitas = consultarTodasCitas($conexion);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de citas: Lista de citas</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<table class="citas">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Fecha cita</th>
	    <th>Hora cita</th>
    	<th>Consulta</th>
	  </tr>
  	 <?php
			foreach($todasCitas as $citas){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarCitas.php' >
			<input type='hidden' name='OID_CITA' value='<?php echo $citas["OID_CITA"]?>'>
	    <th><input type='submit' value='<?php echo $citas["OID_CITA"]; ?>'></th>
		</form>
    	    <td><?php echo $citas["FECHACITA"]; ?></td>
	    	<td><?php echo $citas["HORACITA"]; ?></td>
	    	<td><?php echo $citas["CONSULTA"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioCitas.php">Añadir Cita</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>