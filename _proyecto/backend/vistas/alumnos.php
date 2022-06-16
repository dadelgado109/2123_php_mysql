<?php

	require_once("modelos/alumnos_modelo.php");

	$objAlumnos = new alumnos_modelo();


	// Evaluar las acciones que mando
	$error = array();
	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objAlumnos->constructor();
		print_r($objAlumnos->obtenerDocumento());
		print_r($objAlumnos->obtenerNombre());
		$error = $objAlumnos->ingresar();

		print_r($error);
	}



	// Armamos el paginado
	$arrayFiltro 	= array("pagina" => "1");
	if(isset($_GET['p']) && !Empty($_GET['p']) && $_GET['p'] != ""){
		$arrayFiltro["pagina"] = $_GET['p'];
	}
	$arrayPagina = $objAlumnos->paginador($arrayFiltro["pagina"]);


	$listaTiposDocu = $objAlumnos->listaTipoDocumuento();
	$listaAlumnos 	= $objAlumnos->listar($arrayFiltro);


?>



<div>
	
	<!-- Modal Trigger -->
	
	<h2>Alumnos</h2>

	
	<?PHP if(isset($error['estado']) && $error['estado']=="Error"){ ?>
		<div class="red" style="height:70px">
	<?PHP	print_r($error['mensaje']); ?>
		</div>
	<?PHP } ?>

	<?PHP if(isset($error['estado']) && $error['estado']=="Ok"){ ?>
		<div class="teal lighten-4" style="height:70px">
	<?PHP print_r($error['mensaje']); ?>
		</div>
	<?PHP } ?>
	


	<a class="waves-effect waves-light btn modal-trigger right" href="#modal1" style="margin-buttom:100px">Ingresar</a>
	<br><br>
	<div class="divider"></div>
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
			<h4>Ingresar Alumnos</h4>
			<form method="POST" action="index.php?r=alumnos" class="col s12">
				<div class="row">
					<div class="input-field col s6">
						<input id="first_name" type="text" class="validate" name="nombre">
						<label for="first_name">Nombre</label>
					</div>
					<div class="input-field col s6">
						<input id="last_name" type="text" class="validate" name="apellidos">
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