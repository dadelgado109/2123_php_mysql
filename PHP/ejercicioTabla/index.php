<?php

	include("funciones.php");

	session_start();

	$var = "";
	if(isset($_GET['parametro'])){
		$var = $_GET['parametro'];
		if($var == "destruirSession"){
			session_destroy();
		}
		if($var == "construirSession"){
			$_SESSION['clave'] = "Valor";
		}
	}

	$valorSession = isset($_SESSION['clave'])?$_SESSION['clave']:"No existe la session";

	$personas = array();
	$personas[] = array("Nombre"=>"Damian", "Apellido"=>"Delgado", 'Edad'=>34);	
	$personas[] = array("Nombre"=>"Santiago", 'Apellido'=> 'Fagundez', 'Edad'=>20);
	$personas[] = array("Nombre"=>"Joaquin", "Apellido"=>'Gelpi', 'Edad'=>16);
	$personas[] = array("Nombre"=>"Gabriela", "Apellido"=>'Medina', 'Edad'=>30);
	$personas[] = array("Nombre"=>"Matias", "Apellido"=>'Sanchez', 'Edad'=>50);


	print_r($_GET);


	
	//Array ( [nombre] => Damian [apellido] => Delgado [clave] => clave [email] => email@mail.com [action] => ) 
	/*	
	$nombre = "";
	if(isset($_GET['nombre'])){
		$nombre = $_GET['nombre'];
	}
	$apellido = "";
	if(isset($_GET['apellido'])){
		$apellido = $_GET['apellido'];
	}
	$clave = "";
	if(isset($_GET['clave'])){
		$clave = $_GET['clave'];
	}
	$email = "";
	if(isset($_GET['email'])){
		$email = $_GET['email'];
	}
	*/
	$nombre = "";
	if(isset($_POST['nombre'])){
		$nombre = $_POST['nombre'];
	}
	$apellido = "";
	if(isset($_POST['apellido'])){
		$apellido = $_POST['apellido'];
	}
	$clave = "";
	if(isset($_POST['clave'])){
		$clave = $_POST['clave'];
	}
	$email = "";
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}

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
			<h3>Sistema de GRID: <?=$var?></h3>			
		</div>
		<div class="col s12" id="test1">
			<h3>Sistema de sesiones: <?=$valorSession?></h3>			
		</div>



		<div class="col s12" id="">
			<div class="container">
				<div class="row">
					<form method="POST" action="index.php" class="col s12">
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
							<div class="input-field col s12">
								<input id="password" type="password" class="validate" name="clave">
							 	<label for="password">Clave</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
							<input id="email" type="email" class="validate" name="email">
							<label for="email">Email</label>
						</div>
						<button class="btn waves-effect waves-light" type="submit" name="action">Enviar
							<i class="material-icons right">send</i>
						</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col s12" id="">
			<div class="container">
				<h3>Nombre:<?=$nombre?></h3>
				<h3>Apellido:<?=$apellido?></h3>
				<h3>clave:<?=$clave?></h3>
				<h3>email:<?=$email?></h3>
			</div>
		</div>
		<div class="col s12" id="test4">
			<div class="container">
				 <table class="striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Edad</th>
							<th>Como me siento</th>
						</tr>
					</thead>
					<tbody>
<?php
					foreach($personas as $per){
						
						$quienSoy = respuestaEdad($per['Edad']);

?>
						<tr>
							<td><?=$per['Nombre']?></td>
							<td><?=$per['Apellido']?></td>
							<td><?=$per['Edad']?></td>
							<td><?=$quienSoy?></td>
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