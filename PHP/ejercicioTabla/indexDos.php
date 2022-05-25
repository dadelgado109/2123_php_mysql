<?php

	include("funciones.php");

	$personas = array();
	$personas[] = array("Nombre"=>"Damian", "Apellido"=>"Delgado", 'Edad'=>34);	
	$personas[] = array("Nombre"=>"Santiago", 'Apellido'=> 'Fagundez', 'Edad'=>20);
	$personas[] = array("Nombre"=>"Joaquin", "Apellido"=>'Gelpi', 'Edad'=>16);
	$personas[] = array("Nombre"=>"Gabriela", "Apellido"=>'Medina', 'Edad'=>30);
	$personas[] = array("Nombre"=>"Matias", "Apellido"=>'Sanchez', 'Edad'=>50);


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
?>		
		<!-- DIV 1 -->		
		<div class="col s12" id="test1">
			<h3>Sistema de Avion</h3>			
		</div>

		<div class="col s12" id="test4">
			<div class="container">
				 <table class="striped">
					<thead>
						<tr>
							<th>Nombre</th>
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