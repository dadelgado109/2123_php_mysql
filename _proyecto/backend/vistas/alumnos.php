<?php

	require_once("modelos/alumnos_modelo.php");

	$objAlumnos = new alumnos_modelo();


	$arrayFiltro 	= array("pagina" => "1");
	if(isset($_GET['p']) && !Empty($_GET['p']) && $_GET['p'] != ""){
		$arrayFiltro["pagina"] = $_GET['p'];
	}
	
	$listaAlumnos 	= $objAlumnos->listar($arrayFiltro);

	//print_r($listaAlumnos);

?>



<div>
	<h2>Alumnos</h2>

	<table class="striped">
		<thead>
			<tr class="light-blue lighten-3">
				<th>Documento</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Fecha nacimiento</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>

<?php
			foreach($listaAlumnos as $alumno){
?>
			<tr>
				<td><?=$alumno['documento']?></td>
				<td><?=$alumno['nombre']?></td>
				<td><?=$alumno['apellidos']?></td>
				<td><?=$alumno['fechaNacimiento']?></td>
				<td>
					<a class="waves-effect waves-light btn right">
						<i class="material-icons">create</i>
					</a>
					<a class="waves-effect waves-light btn red right">
						<i class="material-icons">delete</i>
					</a>	
				</td>
			</tr>
			

<?PHP
			}
?>

			<tr>
				<td colspan="5">
					<ul class="pagination right">
						<li class="waves-effect"><a href="index.php?r=alumnos&p=1"><i class="material-icons">chevron_left</i></a></li>
						<li class="active"><a href="#!">1</a></li>
						<li class="waves-effect"><a href="#!">2</a></li>
						<li class="waves-effect"><a href="#!">3</a></li>
						<li class="waves-effect"><a href="#!">4</a></li>
						<li class="waves-effect"><a href="#!">5</a></li>
				    	<li class="waves-effect"><a href="index.php?r=alumnos&p=2"><i class="material-icons">chevron_right</i></a></li>
					</ul>
				</td>
			</tr>

		</tbody>
	</table>






</div>