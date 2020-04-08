<?php
  
 function altaPaciente($conexion,$usuario) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($usuario["fechaAlta"]));
	
	try {
		$consulta = 'CALL INSERTAR_PACIENTE(:nombre, :ape, :dni, :fec, :correo, :poblacion, :dir, :fecA, :seguro, :nTutor, :tTutor)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':correo',$usuario["correo"]);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':dir',$usuario["direccion"]);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':seguro',$usuario["seguro"]);
		$stmt->bindParam(':nTutor',$usuario["nombreTutor"]);
		$stmt->bindParam(':tTutor',$usuario["telefonoTutor"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}

function consultarTodosPacientes($conexion) {
	$consulta = "SELECT * FROM PACIENTE"
		. " ORDER BY APELLIDOS, NOMBRE";
    return $conexion->query($consulta);
}

function getInfoPaciente($conexion, $OID_PACIENTE) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE, APELLIDOS, DNI, FECHA_NACIMIENTO,CORREO,POBLACION,DIRECCION,FECHAALTA,SEGURO,NOMBRE_TUTOR,TELEFONO_TUTOR FROM PACIENTE WHERE OID_PACIENTE = :OID_PACIENTE');
		$stmt -> bindParam(":OID_PACIENTE", $OID_PACIENTE);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
?>