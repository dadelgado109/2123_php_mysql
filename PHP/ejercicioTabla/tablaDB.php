<?php

	include("funciones.php");

	function obtenerParametros($parametro){

		$retorno = "";
		if(isset($_POST[$parametro]) && $_POST[$parametro] != ""){
			$retorno = $_POST[$parametro];
		}elseif(isset($_GET[$parametro]) && $_GET[$parametro] != ""){
			$retorno = $_GET[$parametro];
		}

		return $retorno;
	}

	try{
		/*
			Conexion a la base datos
		*/
		$srtConexion 	= "mysql:host=localhost;dbname=phpmysql";
		$usuario 		= "root";
		$clave 			= "";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
		$conexion 		= new PDO($srtConexion, $usuario, $clave, $options); 
		//print_r($conexion);
	}catch(PDOException $e){



	}

	$nombre 		= obtenerParametros('nombre');
	$apellido 		= obtenerParametros('apellido');
	$documento 		= obtenerParametros('documento');
	$tipoDocumento 	= obtenerParametros('tipoDocumento');
	$fechaNacimiento = obtenerParametros('fechaNacimiento');
	print_r("nombre:".$nombre."- Apellido:".$apellido." - Documento:".$documento);

	$accion = obtenerParametros('accion');
	if($accion == "ingresar"){

		$sql = "INSERT INTO alumnos SET
					documento = :refDocumento,
					nombre = :refNombre,
					apellidos = :refApellido,
					tipoDocumento = :refTipoDocumento,
					fechaNacimiento = :refFechaNacimiento;
		";
		$arrayExecute = array(
			"refDocumento" 			=> $documento,
			"refNombre" 			=> $nombre,	
			"refApellido" 			=> $apellido,
			"refTipoDocumento" 		=> $tipoDocumento,
			"refFechaNacimiento" 	=> $fechaNacimiento,
		);

		$preparo 	= $conexion->prepare($sql);
		$respuesta	= $preparo->execute($arrayExecute);

	}
	/* '; DELETE FROM alumnos_cursos;*/ 


	$sql = "SELECT * FROM alumnos";
	$preparo = $conexion->prepare($sql);
	
	$respuesta	= $preparo->execute(array());
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
		<div class="col s12" id="test1">
			<h3>Sistema de GRID:</h3>			
		</div>
		<div class="col s12" id="test4">
			<div class="container">
				 <table class="striped">
					<thead>
						<tr>
							<th>Documento</th>
							<th>Nombre</th>
							<th>Apellids</th>
							<th>Tipo Documento</th>
							<th>Fecha Nacimiento</th>
						</tr>
					</thead>
					<tbody>
<?php
					foreach($lista as $alumno){
						
?>
						<tr>
							<td><?=$alumno['documento']?></td>
							<td><?=$alumno['nombre']?></td>
							<td><?=$alumno['apellidos']?></td>
							<td><?=$alumno['tipoDocumento']?></td>
							<td><?=$alumno['fechaNacimiento']?></td>
						</tr>
<?php
					}
?>
					</tbody>
				</table>   
			</div>
		</div>


		<div class="col s12" id="">
			<div class="container">
				<div class="row">
					<div class="col s12" id="test1">
						<h3>Ingresar Alumno:</h3>			
					</div>
					<form method="POST" action="tablaDB.php" class="col s12">
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
								<input id="documento" type="text" class="validate" name="documento">
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