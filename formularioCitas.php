<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if(isset($_SESSION['cita'])){
		$cita = $_SESSION['cita'];
		$fechaCita = date('Y-m-d', strtotime($cita["fechaCita"]));
		unset($_SESSION['cita']);
	} else if(!isset($_SESSION['formularioCita'])) {
		$formularioCita['fechaCita'] = "";
		$formularioCita['horaCita'] = "";
		$formularioCita['consulta'] = "";
		$formularioCita['paciente'] = "";
		$formularioCita['doctora'] = "";
		$formularioCita['tratamiento'] = "";
	
		$_SESSION['formularioCita'] = $formularioCita;
	} else
		$formularioCita = $_SESSION['formularioCita'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
		
	$horas=array(
     "10:00" => '10:00',
     "10:30" => '10:30',
     "11:00" => '11:00', 
     "11:30" => '11:30',
     "12:00" => '12:00',
     "12:30" => '12:30', 
     "13:00" => '13:00',
     "13:30" => '13:00',
     "17:00" => '17:00',
     "17:30" => '17:30',
     "18:00" => '18:00',
     "18:30" => '18:30',
     "19:00" => '19:00',
     "19:30" => '19:30',
     "20:00" => '20:00',
     "20:30" => '20:30',
           );
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <script type="text/javascript">
  	function validateForm(){
  		var existErrors = false;
  		var formulario = document.forms["altaCita"];
  		var xc = formulario["paciente"];
  		var xs = document.getElementById("spanPaciente");
  		xc.className="";
  		xs.innerHTML="";
  		var re = /^[0-9]{8}[A-Za-z]{1}$/;
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El DNI del paciente es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}else if((!re.test(xc.value))){
  			xs.innerHTML = "El DNI deben ser 8 dígitos y una letra";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["doctora"];
  		var xs = document.getElementById("spanDoctora");
  		var f = new Date();
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El codigo de la doctora es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["tratamiento"];
  		var xs = document.getElementById("spanTratamiento");
  		var f = new Date();
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El nombre del tratamiento es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["fechaCita"];
  		var xs = document.getElementById("spanFechaCita");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La fecha de la cita es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["horaCita"];
  		var xs = document.getElementById("spanHoraCita");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La hora de la cita es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["consulta"];
  		var xs = document.getElementById("spanConsulta");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "La consulta de la cita es obligatoria";
  			xc.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
	}
  </script>
  <title>Formulario de Citas</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	<div class="form">
	<?php if(!isset($cita)){ ?>
	<h1>Añadir nueva cita</h1>	
	<form id="altaCita" method="post" onsubmit="return validateForm()" action="validacionCitas.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos cita</legend>
			<div class="col-10 col-tab-10">
			
			<div><label for="paciente">DNI paciente:<em>*</em></label>
			<input type="text" id="paciente" name="paciente" value="<?php echo $formularioCita['paciente'];?>" required/><span id="spanPaciente"></span><br>
			</div>
			
			<div><label for="doctora">Codigo doctora:<em>*</em></label>
			<input type="text" id="doctora" name="doctora" value="<?php echo $formularioCita['doctora'];?>" required/><span id="spanDoctora"></span><br>
			</div>
			
			<div><label for="tratamiento">Tratamiento:<em>*</em></label>
			<input type="text" id="tratamiento" name="tratamiento" value="<?php echo $formularioCita['tratamiento'];?>" required/><span id="spanTratamiento"></span><br>
			</div>
			
			<div><label for="fechaCita">Fecha:<em>*</em></label>
			<input type="date" id="fechaCita" name="fechaCita" value="<?php echo $formularioCita['fechaCita'];?>" required/><span id="spanFechaCita"></span><br>
			</div>

			<div><label for="horaCita">Hora:<em>*</em></label>
				<select id="horaCita" name="horaCita" required />
   					<option value="<?php echo $formularioCita['horaCita'];?>"><?php echo $formularioCita['horaCita'];?></option>
 		 		<?php
  					foreach($horas as $key => $value):
  						echo '<option value="'.$key.'">'.$value.'</option>';
 					endforeach;
   				?>
				</select><span id="spanHoraCita"></span><br>
			</div><br />
			
			<div class="radio"><label for="consulta">Consulta:<em>*</em></label><br />
			<input id="1" name="consulta" type="radio" value="1" <?php if($formularioCita['consulta']=='1') echo ' checked ';?> required/>
  			<label for="1">Consulta 1</label>
			<input id="2" name="consulta" type="radio" value="2" <?php if($formularioCita['consulta']=='2') echo ' checked ';?> required/>
  			<label for="2">Consulta 2</label><br>
  			<span id="spanConsulta"></span>
			</div>
		</div>
		</fieldset>	
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<form id="cancelarCita" method="post" action="validacionCitas.php">
		<button id="cancelarAñadir" name="cancelarAñadir" type="submit" size="4"><img src="images/returnButton.png" width="20" height="20"></button>
	</form>
	<?php }else{ ?>
	<h1>Actualizar cita <?php echo $cita['OID_CITA'];?></h1>	
	<form id="altaCita" method="post" onsubmit="return validateForm()" action="validacionCitas.php">
		<input id="OID_CITA" name="OID_CITA" type="hidden" value="<?php echo $cita['OID_CITA']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos cita</legend>
			<div class="col-10 col-tab-10">
			
			<div><label for="paciente">DNI paciente:<em>*</em></label>
			<input type="text" id="paciente" name="paciente" value="<?php echo $cita['paciente'];?>" required/><br><span id="spanPaciente"></span><br>
			</div>
			
			<div><label for="doctora">Codigo doctora:<em>*</em></label>
			<input type="text" id="doctora" name="doctora" value="<?php echo $cita['doctora'];?>" required/><br><span id="spanDoctora"></span><br>
			</div>
			
			<div><label for="tratamiento">Tratamiento:<em>*</em></label>
			<input type="text" id="tratamiento" name="tratamiento" value="<?php echo $cita['tratamiento'];?>" required/><br><span id="spanTratamiento"></span><br>
			</div>
			
			<div><label for="fechaCita">Fecha:<em>*</em></label>
			<input type="date" id="fechaCita" name="fechaCita" value="<?php echo $fechaCita;?>" required/><span id="spanFechaCita"></span><br>
			</div>

			<div><label for="horaCita">Hora:<em>*</em></label>
				<select id="horaCita" name="horaCita" required /><br>
   					<option value="<?php echo $cita['horaCita'];?>"><?php echo $cita['horaCita'];?></option>
 		 		<?php
  					foreach($horas as $key => $value):
  						echo '<option value="'.$key.'">'.$value.'</option>';
 					endforeach;
   				?>
				</select><span id="spanHoraCita"></span><br>
			</div><br />
			
			<div class="radio"><label for="consulta">Consulta:<em>*</em></label><span id="spanConsulta"></span>
			<input id="1" name="consulta" type="radio" value="1" <?php if($cita['consulta']=='1') echo ' checked ';?> required/>
  			<label for="1">Consulta 1</label>
			<input id="2" name="consulta" type="radio" value="2" <?php if($cita['consulta']=='2') echo ' checked ';?> required/>
  			<label for="2">Consulta 2</label><br>
			</div>
		</div>
		</fieldset>
		
		<div>
			<button id="actualizar" name="actualizar" type="submit"><img src="images/botonEditar.png" width="20" height="20"></button>
		</div>	
	</form>
</div>
	<?php } ?>
	
	</body>
</html>