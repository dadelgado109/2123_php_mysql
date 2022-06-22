<?php

	require_once("modelos/alumnos_modelo.php");

	$objAlumnos = new alumnos_modelo();


	// Evaluar las acciones que mando
	$error = array();
	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objAlumnos->constructor();
		$error = $objAlumnos->ingresar();

	}

	if(isset($_POST['accion']) && $_POST['accion'] == "borrar"){

		$documento = isset($_POST['documento'])?$_POST['documento']:"";
		$objAlumnos->cargar($documento);	
		$error = $objAlumnos->borrar();

	}

	if(isset($_POST['accion']) && $_POST['accion'] == "guardar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objAlumnos->constructor();
		$error = $objAlumnos->guardar();

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
		<div class="red valign-wrapper" style="height:70px">
			<h5 class="center-align" style="width:100%">
	<?PHP	print_r($error['mensaje']); ?>
			</h5>
		</div>
	<?PHP } ?>

	<?PHP if(isset($error['estado']) && $error['estado']=="Ok"){ ?>
		<div class="teal lighten-4 valign-wrapper" style="height:70px">
			<h5 class="center-align" style="width:100%">
	<?PHP print_r($error['mensaje']); ?>
			</h5>
		</div>
	<?PHP } ?>

<?PHP 

if(isset($_GET['a']) && $_GET['a'] == "borrar"){ 
			$idRegistro = isset($_GET['id'])?$_GET['id']:"";

?>
			<div class="divider"></div>
			<form method="POST" action="index.php?r=alumnos" class="col s12">
				<h3>Quiere borrar al alumno ?</h3>
				<input type="hidden" name="documento" value="<?=$idRegistro?>" >
				<button class="btn waves-effect waves-light" type="submit" name="accion" value="borrar">Aceptar
					<i class="material-icons right">delete_sweep</i>
				</button>
				<button class="btn waves-effect waves-light red" type="submit" name="accion">Cancelar
					<i class="material-icons right">cancel</i>
				</button>
			</form>
			<br><br>
			<div class="divider"></div>
<?PHP } ?>

<?PHP 
		if(isset($_GET['a']) && $_GET['a'] == "editar" && isset($_GET['id']) && $_GET['id'] != ""){ 
			$idRegistro = isset($_GET['id'])?$_GET['id']:"";
			$objAlumnos->cargar($idRegistro);
?>
			<div class="divider"></div>
			<form method="POST" action="index.php?r=alumnos" class="col s12">
				<h3>Editar Alumno </h3>
				<input type="hidden" name="documento" value="<?=$idRegistro?>" >
				<input type="hidden" name="accion" value="guardar">
				<div class="row">
					<div class="input-field col s6">
						<input id="first_name" type="text" class="validate" name="nombre" value="<?=$objAlumnos->obtenerNombre()?>">
						<label for="first_name">Nombre</label>
					</div>
					<div class="input-field col s6">
						<input id="last_name" type="text" class="validate" name="apellidos"  value="<?=$objAlumnos->obtenerApellidos()?>">
						<label for="last_name">Apellido</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s4">
						<input id="documento" type="number" class="validate" name="documento" value="<?=$objAlumnos->obtenerDocumento()?>" disabled >
					 	<label for="documento">Documento</label>
					</div>
					<div class="input-field col s4">
						<select id="tipoDocumento" name="tipoDocumento" >
							<option value="" disabled selected>Seleccione una opcion</option>
<?php
							foreach($listaTiposDocu as $tipoDocumento){
?>
							<option value="<?=$tipoDocumento?>" <?php if($tipoDocumento == $objAlumnos->obtenerTipoDocumento()){ echo("selected"); } ?> ><?=$tipoDocumento?></option>
<?php
							}
?>
						</select>
						<label>Tipo Documento</label>
					</div>
					<div class="input-field col s4">
						<input id="fechaNacimiento" type="date" class="validate" name="fechaNacimiento" value="<?=$objAlumnos->obtenerFechaNacimiento()?>" >
						<label for="fechaNacimiento">Fecha Nacimiento</label>
					</div>
				</div>				
				<button class="btn waves-effect waves-light" type="submit">Guardar
					<i class="material-icons right">send</i>
				</button>
			</form>
			<br><br>
			<div class="divider"></div>
<?PHP } ?>
	<a class="waves-effect waves-light btn modal-trigger right" href="#modal1">Ingresar</a>
	<br><br>
	<table class="striped">
		<thead>
			<tr class="light-blue lighten-3">
				<th>Documento</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Fecha nacimiento</th>
				<th>Tipo Documento</th>
				<th class="center-align" style="width: 130px;" >Acciones</th>
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
				<td><?=$alumno['tipoDocumento']?></td>
				<td>
					<div class="right">
						<a class="waves-effect waves-light btn" href="index.php?r=alumnos&id=<?=$alumno['documento']?>&a=editar">
							<i class="material-icons">create</i>
						</a>
						<a class="waves-effect waves-light btn red" href="index.php?r=alumnos&id=<?=$alumno['documento']?>&a=borrar">
							<i class="material-icons">delete</i>
						</a>
					</div>	
				</td>
			</tr>
			

<?PHP
			}
?>

			<tr>
				<td colspan="6">
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