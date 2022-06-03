<?php

	$personas = array();
	$personas[] = array("Nombre"=>"Damian", "Apellido"=>"Delgado", 'Edad'=>34);	
	$personas[] = array("Nombre"=>"Santiago", 'Apellido'=> 'Fagundez', 'Edad'=>20);
	$personas[] = array("Nombre"=>"Joaquin", "Apellido"=>'Gelpi', 'Edad'=>16);
	$personas[] = array("Nombre"=>"Gabriela", "Apellido"=>'Medina', 'Edad'=>30);
	$personas[] = array("Nombre"=>"Matias", "Apellido"=>'Sanchez', 'Edad'=>50);

	// String conexion a la base de datos
	$srtConexion 	= "mysql:host=localhost;dbname=phpmysql";
	// Credenciales
	$usuario 		= "root";
	$clave 			= "";
	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_CASE => PDO::CASE_NATURAL,
		PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
	];
	$conexion 	= new PDO($srtConexion, $usuario, $clave, $options); 


	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){

		$nombre = "";
		if(isset($_POST['nombre'])){
			$nombre = $_POST['nombre'];	
		}
		$apellido = "";
		if(isset($_POST['apellido'])){
			$apellido = $_POST['apellido'];	
		}
		$documento = "";
		if(isset($_POST['documento'])){
			$documento = $_POST['documento'];	
		}
		$tipoDocumento = "";
		if(isset($_POST['tipoDocumento'])){
			$tipoDocumento = $_POST['tipoDocumento'];	
		}
		$fechaNacimiento = "";
		if(isset($_POST['fechaNacimiento'])){
			$fechaNacimiento = $_POST['fechaNacimiento'];	
		}
		print_r($nombre."|".$apellido."|".$documento."|".$tipoDocumento."|".$fechaNacimiento);
		echo("Voy a ingresar un registro");
		$sqlInsert = "INSERT alumnos SET
						documento 	= '".$documento."',
						nombre		= '".$nombre."',
						apellidos	= '".$apellido."',
						tipoDocumento = '".$tipoDocumento."',
						fechaNacimiento = '".$fechaNacimiento."';";

		$preparo 	= $conexion->prepare($sqlInsert);
		$respuesta	= $preparo->execute(array());

	}else{
		echo("Voy se van a ingresar registros");	
	}


	//SELECT * FROM alumnos;
	$sql = "SELECT * FROM alumnos ORDER BY nombre;";
	$preparo 	= $conexion->prepare($sql);
	$preparo->execute(array());
	$lista 		= $preparo->fetchAll();



?>


<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" href="css/materialize.min.css" rel="stylesheet" media="screen,projection">
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Titulo que se ve en la pestania -->
		<title>Inicio</title>

		<style>

			table.striped > tbody > tr:nth-child(odd) {
				background-color: rgba(179, 204, 139, 0.292);
			}

		</style>	
	</head>

	<body>
		<!-- Aca esta la barra de navegacion-->
	
<?PHP	
		include("barraNavegacion.php");
?>		<!-- DIV 1 -->		
		
		<div class="col s12" id="">
			<div class="container">
				<div class="row">
					<div class="col s12" id="test1">
						<h3>Ingresar Alumno:</h3>			
					</div>
					<form method="POST" action="indexDB2.php" class="col s12">
						<div class="row">
							<div class="input-field col s6">
								<input id="first_name" type="text" class="validate" name="nombre">
								<label for="first_name">Nombre</label>
							</div>
							<div class="input-field col s6">
								<input id="last_name" type="text" class="validate" name="apellido">
								<label for="last_name">Apellido</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s4">
								<input id="documento" type="number" class="validate" name="documento">
							 	<label for="documento">Documento</label>
							</div>
							<div class="input-field col s4">
								<input id="tipoDocumento" type="text" class="validate" name="tipoDocumento">
								<label for="tipoDocumento">Tipo Documento</label>
							</div>
							<div class="input-field col s4">
								<input id="fechaNacimiento" type="date" class="validate" name="fechaNacimiento">
								<label for="fechaNacimiento">Fecha Nacimiento</label>
							</div>
						</div>
						<input type="hidden" name="accion" value="ingresar">

						<button class="btn waves-effect waves-light" type="submit">Enviar
							<i class="material-icons right">send</i>
						</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col s12" id="test4">
			<div class="container">
				<div class="col s12" id="test1">
					<h3>Sistema de Lista:</h3>			
				</div>
				 <table class="striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Documento</th>
							<th>Tipo Documneto</th>
							<th>Fecha Nacimiento</th>
						</tr>
					</thead>
					<tbody>
<?php
					foreach($lista as $alumnos){
						//print_r($alumnos);
						//echo("<hr>");
?>
						<tr>	
							<td><?=$alumnos['nombre']?></td>
							<td><?=$alumnos['apellidos']?></td>
							<td><?=$alumnos['documento']?></td>
							<td><?=$alumnos['tipoDocumento']?></td>
							<td><?=$alumnos['fechaNacimiento']?></td>
						</tr>

<?php
					}
?>
					</tbody>
				</table>   
			</div>
		</div>
		<!-- DIV 5 -->
	

		<!--JavaScript at end of body for optimized loading-->
		<script src="js/materialize.min.js" type="text/javascript"></script>

		<script>

			document.addEventListener('DOMContentLoaded', function() {

				M.AutoInit();

				var elems = document.querySelectorAll('.sidenav');
				var instances = M.Sidenav.init(elems);


			});

		</script>

	</body>
</html>