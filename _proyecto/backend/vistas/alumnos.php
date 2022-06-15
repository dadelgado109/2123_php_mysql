<?php

	require_once("modelos/alumnos_modelo.php");

	$objAlumnos = new alumnos_modelo();

/*
	// Evaluar las acciones que mando
	if(isset($_POST['accion']) && $_POST['accion'] = "ingresar"){

		$nombre = $_POST['nombre'];

		$objAlumnos->costructor();

	}

*/


	$arrayFiltro 	= array("pagina" => "1");
	if(isset($_GET['p']) && !Empty($_GET['p']) && $_GET['p'] != ""){

		$arrayPagina = $objAlumnos->validarPagina($_GET['p']);
		$arrayFiltro["pagina"] = $arrayPagina['pagina'];

		
	}
	$arrayPagina = array("paginaAtras"=>1,"pagina"=>1,"paginaSiguente"=>1, "totalPagina"=>4);
	
/*
	// Valido si $arrayFiltro["pagina"] es un numero 
	if(!is_numeric($arrayFiltro["pagina"])){
		// En caso de no ser un numero le asigno el numero 1
		$arrayFiltro["pagina"] = 1;	
	}
	
	$paginaAtras 	= $arrayFiltro["pagina"] - 1;
	// Valido si pagina atras es menor a 1
	if($paginaAtras < 1){
		// En caso que sea menor le asigo el valor 1
		$paginaAtras = 1;	
		$arrayFiltro["pagina"] = 1;

	}	
	$totalRegistros	= $objAlumnos->totalRegistros();
	$totalpaginas = ceil(($totalRegistros/10));	

	$paginaSiguiente = $arrayFiltro["pagina"] + 1;
	if($paginaSiguiente >= $totalpaginas){
		$paginaSiguiente = $totalpaginas;
	}	

*/
	


	$listaTiposDocu = $objAlumnos->listaTipoDocumuento();
	$listaAlumnos 	= $objAlumnos->listar($arrayFiltro);

	//print_r($listaAlumnos);

?>



<div>
	<h2>Alumnos</h2>
	<!-- Modal Trigger -->
	<a class="waves-effect waves-light btn modal-trigger right" href="#modal1">Modal</a>
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
						<li class="waves-effect"><a href="index.php?r=alumnos&p=<?=$arrayPagina['paginaAtras']?>"><i class="material-icons">chevron_left</i></a></li>
<?php
					for($i = 1; $i<=$arrayPagina['totalPagina'] ; $i++){
						$activo = "waves-effect";
						if($arrayPagina['pagina'] == $i){
							$activo = "active";
						}						
?>
						<li class="<?=$activo?>"><a href="index.php?r=alumnos&p=<?=$i?>"><?=$i?></a></li>
<?php
					}
?>
				    	<li class="waves-effect"><a href="index.php?r=alumnos&p=<?=$arrayPagina['paginaSiguiente']?>"><i class="material-icons">chevron_right</i></a></li>
					</ul>
				</td>
			</tr>

		</tbody>
	</table>

</div>


	

	<!-- Modal Structure -->
	<div id="modal1" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Modal Header</h4>
			<form method="POST" action="index.php?r=alumnos" class="col s12">
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
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>