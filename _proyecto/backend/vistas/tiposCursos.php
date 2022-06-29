<?php

	require_once("modelos/tipoCursos_modelo.php");

	$objTipoCurso = new tipoCursos_modelo();
	

	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){
		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objTipoCurso->constructor();
		$error = $objTipoCurso->ingresar();
	}

	if(isset($_POST['accion']) && $_POST['accion'] == "guardar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objTipoCurso->constructor();
		$error = $objTipoCurso->guardar();

	}
	if(isset($_POST['accion']) && $_POST['accion'] == "borrar"){

		$idTipoCurso = isset($_POST['idTipoCurso'])?$_POST['idTipoCurso']:"";
		$objTipoCurso->cargar($idTipoCurso);	
		$error = $objTipoCurso->borrar();

	}



	$arrayFiltro 	= array("pagina" => "1");
	if(isset($_GET['p']) && !Empty($_GET['p']) && $_GET['p'] != ""){
		$arrayFiltro["pagina"] = $_GET['p'];
	}
	$arrayPagina 	= $objTipoCurso->paginador($arrayFiltro["pagina"]);
	$listaTipoCurso = $objTipoCurso->listar($arrayFiltro);



?>
<div>
	<h2>Tipo de cursos</h2>
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
			<form method="POST" action="sistema.php?r=tiposCursos" class="col s12">
				<h3>Quiere borrar al tipo de curso?</h3>
				<input type="hidden" name="idTipoCurso" value="<?=$idRegistro?>" >
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
			$objTipoCurso->cargar($idRegistro);
?>
			<div class="divider"></div>
			<form method="POST" action="sistema.php?r=tiposCursos" class="col s12">
				<h3>Editar Tipo de curso </h3>
				<input type="hidden" name="idTipoCurso" value="<?=$idRegistro?>" >
				<input type="hidden" name="accion" value="guardar">
				<div class="row">
					<div class="input-field col s12">
						<input id="first_name" type="text" class="validate" name="nombre" value="<?=$objTipoCurso->obtenerNombre()?>">
						<label for="first_name">Nombre</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<textarea id="descripcion" class="materialize-textarea" name="descripcion"><?=$objTipoCurso->obtenerDescripcion()?></textarea>
					 	<label for="descripcion">Descripcion</label>
					</div>>
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
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th class="center-align" style="width: 130px;" >Acciones</th>
				</tr>
			</thead>
			<tbody>

<?php
			foreach($listaTipoCurso as $tipoCurso){
?>
				<tr>
					<td><?=$tipoCurso['idTipoCurso']?></td>
					<td><?=$tipoCurso['nombre']?></td>
					<td><?=$tipoCurso['descripcion']?></td>
					<td>
						<div class="right">
							<a class="waves-effect waves-light btn" href="sistema.php?r=tiposCursos&id=<?=$tipoCurso['idTipoCurso']?>&a=editar">
								<i class="material-icons">create</i>
							</a>
							<a class="waves-effect waves-light btn red" href="sistema.php?r=tiposCursos&id=<?=$tipoCurso['idTipoCurso']?>&a=borrar">
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
						<li class="waves-effect"><a href="sistema.php?r=tiposCursos&p=<?=$arrayPagina['paginaAtras']?>"><i class="material-icons">chevron_left</i></a></li>
<?php
					for($i = 1; $i<=$arrayPagina['totalPagina'] ; $i++){
						$activo = "waves-effect";
						if($arrayPagina['pagina'] == $i){
							$activo = "active";
						}						
?>
						<li class="<?=$activo?>"><a href="sistema.php?r=tiposCursos&p=<?=$i?>"><?=$i?></a></li>
<?php
					}
?>
				    	<li class="waves-effect"><a href="sistema.php?r=tiposCursos&p=<?=$arrayPagina['paginaSiguiente']?>"><i class="material-icons">chevron_right</i></a></li>
					</ul>
				</td>
			</tr>

		</tbody>
	</table>


	<!-- Modal Structure -->
	<div id="modal1" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Ingresar Tipos de curso</h4>
			<form method="POST" action="sistema.php?r=tiposCursos" class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<input id="first_name" type="text" class="validate" name="nombre">
						<label for="first_name">Nombre</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<textarea id="descripcion" class="materialize-textarea" name="descripcion"></textarea>
					 	<label for="descripcion">Descripcion</label>
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


</div>