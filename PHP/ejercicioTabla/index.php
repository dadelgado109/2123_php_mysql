<?php

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
	
		
		<!-- DIV 1 -->		

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

						if($per['Edad']> 0 && $per['Edad'] < 12){
							$quienSoy = "Soy un Niño";
						}elseif($per['Edad'] >= 12 && $per['Edad'] < 18){
							$quienSoy = "Soy un Adolecente";    
						}elseif($per['Edad'] >= 18 && $per['Edad'] < 30){
							$quienSoy = "Soy un adulto joven";
						}elseif($per['Edad'] >= 30 && $per['Edad'] < 70){
							$quienSoy = "Soy un adulto Responsable";
						}else{
							$quienSoy = "Soy un juvilado";
						}
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