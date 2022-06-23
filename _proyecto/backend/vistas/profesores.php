<?PHP

	require_once("modelos/profesores_modelo.php");

	$objProfesores = new profesores_modelo();

	$error = array();
	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objProfesores->constructor();
		$error = $objProfesores->ingresar();
	}
	if(isset($_POST['accion']) && $_POST['accion'] == "guardar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objProfesores->constructor();
		$error = $objProfesores->guardar();

	}
	if(isset($_POST['accion']) && $_POST['accion'] == "borrar"){

		$documento = isset($_POST['documento'])?$_POST['documento']:"";
		$objProfesores->cargar($documento);	
		$error = $objProfesores->borrar();

	}

	// Armamos el paginado
	$arrayFiltro 	= array("pagina" => "1");
	if(isset($_GET['p']) && !Empty($_GET['p']) && $_GET['p'] != ""){
		$arrayFiltro["pagina"] = $_GET['p'];
	}
	$arrayPagina = $objProfesores->paginador($arrayFiltro["pagina"]);

	$listaProfesores = $objProfesores->listar($arrayFiltro);

?>

<div>
	<h2>Profesores</h2>
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

<?php
		if(isset($_GET['a']) && $_GET['a'] == "borrar"){ 
			$idRegistro = isset($_GET['id'])?$_GET['id']:"";

?>
			<div class="divider"></div>
			<form method="POST" action="sistema.php?r=profesores" class="col s12">
				<h3>Quiere borrar al profesor ?</h3>
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
			$objProfesores->cargar($idRegistro);
?>
			<div class="divider"></div>
			<form method="POST" action="sistema.php?r=profesores" class="col s12">
				<h3>Editar Profesor </h3>
				<input type="hidden" name="documento" value="<?=$idRegistro?>" >
				<input type="hidden" name="accion" value="guardar">
				<div class="row">
					<div class="input-field col s6">
						<input id="first_name" type="text" class="validate" name="nombre" value="<?=$objProfesores->obtenerNombre()?>">
						<label for="first_name">Nombre</label>
					</div>
					<div class="input-field col s6">
						<input id="last_name" type="text" class="validate" name="apellidos"  value="<?=$objProfesores->obtenerApellidos()?>">
						<label for="last_name">Apellido</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input id="documento" type="number" class="validate" name="documento" value="<?=$objProfesores->obtenerDocumento()?>" disabled >
					 	<label for="documento">Documento</label>
					</div>
					<div class="input-field col s6">
						<input id="fechaNacimiento" type="date" class="validate" name="fechaNacimiento" value="<?=$objProfesores->obtenerFechaNacimiento()?>" >
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
				<th class="center-align" style="width: 130px;" >Acciones</th>
			</tr>
		</thead>
		<tbody>

<?php
			foreach($listaProfesores as $profesores){
?>
			<tr>
				<td><?=$profesores['documento']?></td>
				<td><?=$profesores['nombre']?></td>
				<td><?=$profesores['apellidos']?></td>
				<td><?=$profesores['fechaNacimiento']?></td>
				<td>
					<div class="right">
						<a class="waves-effect waves-light btn" href="sistema.php?r=profesores&id=<?=$profesores['documento']?>&a=editar">
							<i class="material-icons">create</i>
						</a>
						<a class="waves-effect waves-light btn red" href="sistema.php?r=profesores&id=<?=$profesores['documento']?>&a=borrar">
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
						<li class="waves-effect"><a href="sistema.php?r=profesores&p=<?=$arrayPagina['paginaAtras']?>"><i class="material-icons">chevron_left</i></a></li>
<?php
					for($i = 1; $i<=$arrayPagina['totalPagina'] ; $i++){
						$activo = "waves-effect";
						if($arrayPagina['pagina'] == $i){
							$activo = "active";
						}						
?>
						<li class="<?=$activo?>"><a href="sistema.php?r=profesores&p=<?=$i?>"><?=$i?></a></li>
<?php
					}
?>
				    	<li class="waves-effect"><a href="sistema.php?r=profesores&p=<?=$arrayPagina['paginaSiguiente']?>"><i class="material-icons">chevron_right</i></a></li>
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
			<form method="POST" action="sistema.php?r=profesores" class="col s12">
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
					<div class="input-field col s6">
						<input id="documento" type="number" class="validate" name="documento">
					 	<label for="documento">Documento</label>
					</div>
					<div class="input-field col s6">
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