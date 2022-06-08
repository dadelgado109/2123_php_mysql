



<?php

	require_once('modelos/alumnos_modelo.php');

	$objAlumno = new alumnos_modelo();	

	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){
		
		$objAlumno->constructor();
		$respuesta = $objAlumno->ingresar();
		
	}else{
		echo("Voy se van a ingresar registros");	
	}

	if(isset($_GET['alum']) && $_GET['alum'] != ""){

		$objAlumno->cargar($_GET['alum']);

	}

	$lista 		= $objAlumno->listar();
	$listaTiposDocu = $objAlumno->listaTipoDocumuento();

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
<?php

					if(isset($_GET['alum']) && $_GET['alum'] != ""){
?>
						<h4>Nombre:<span><?= $objAlumno->obtenerNombre()?></span></h4>
						<h4>Apellido:<span><?= $objAlumno->obtenerApellido()?></span></h4>
						<h4>Documento:<span><?= $objAlumno->obtenerDocumento()?></span></h4>
						<h4>TipoDocumento:<span><?= $objAlumno->obtenerTipoDocumento()?></span></h4>
						<h4>fechaNacimiento:<span><?= $objAlumno->obtenerFechaNacimiento()?></span></h4>
<?php
					}

?>

					<div class="col s12" id="test1">
						<h3>Ingresar Alumno:</h3>			
					</div>
<?php	
					if(isset($respuesta['estado']) && $respuesta['estado'] == "Error" ){
?>
					<div class="col s12 red">
						<h5><?=$respuesta['mensaje']?></h5>
					</div>
<?PHP 
					}
?>
<?php	
					if(isset($respuesta['estado']) && $respuesta['estado'] == "Ok" ){
?>
					<div class="col s12 green">
						<h5><?=$respuesta['mensaje']?></h5>
					</div>
<?PHP 
					}
?>


					<form method="POST" action="indexDBclase.php" class="col s12">
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
								<select id="tipoDocumento" name="tipoDocumento" >
									<option value="" disabled selected>Seleccione una opcion</option>
<?php
									foreach($listaTiposDocu as $tipoDocumento){
?>
									<option value="<?=$tipoDocumento?>"><?=$tipoDocumento?></option>
<?php
									}
?>
								</select>
								<label>Tipo Documento</label>
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
							<th>Ver</th>
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
							<td>
								<a class="btn red" href="indexDBclase.php?alum=<?=$alumnos['documento']?>" >Ver</a>
							</td>
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