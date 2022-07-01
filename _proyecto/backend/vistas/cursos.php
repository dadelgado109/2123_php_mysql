<?php

	require_once("modelos/cursos_modelo.php");
	require_once("modelos/tipoCursos_modelo.php");
	require_once("modelos/profesores_modelo.php");

	$objCurso = new cursos_modelo();
	

	if(isset($_POST['accion']) && $_POST['accion'] == "ingresar"){
		
		$rutaImagen = $objCurso->subirImagen(600,600);

		if($rutaImagen ){
			$objCurso->constructor();
			$objCurso->cargarImagen($rutaImagen);
			$error = $objCurso->ingresar();
		}else{
			$error = array("estado"=>"Error", "mensaje"=>"Error al subir la imagen" );
		}
	}

	if(isset($_POST['accion']) && $_POST['accion'] == "guardar"){

		// En caso que la accion sera ingresar procedemos a ingresar el registro
		$objCurso->constructor();
		$error = $objCurso->guardar();

	}

	$objTipoCurso 	 = new tipoCursos_modelo();
	$selectTipoCurso = $objTipoCurso->listarSelect();

	$objProfesores   = new profesores_modelo();
	$selectProfesores = $objProfesores->listarSelect();

	// ------------------------------------------------------------ \\
	$arrayFiltro 	= array("pagina" => "1");
	if(isset($_GET['p']) && !Empty($_GET['p']) && $_GET['p'] != ""){
		$arrayFiltro["pagina"] = $_GET['p'];
	}
	$arrayPagina= $objCurso->paginador($arrayFiltro["pagina"]);
	$listaCurso = $objCurso->listar($arrayFiltro);



?>
<div>
	<h2>Cursos</h2>
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
		if(isset($_GET['a']) && $_GET['a'] == "editar" && isset($_GET['id']) && $_GET['id'] != ""){ 
			$idRegistro = isset($_GET['id'])?$_GET['id']:"";
			$objCurso->cargar($idRegistro);
?>
			<div class="divider"></div>
			<form method="POST" action="sistema.php?r=cursos" class="col s12">
				<h3>Editar curso </h3>
				<input type="hidden" name="codigo" value="<?=$idRegistro?>" >
				<input type="hidden" name="accion" value="guardar">
				<div class="row">
					<div class="input-field col s12">
						<input id="first_name" type="text" class="validate" name="nombre" value="<?=$objCurso->obtenerNombre()?>">
						<label for="first_name">Nombre</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<textarea id="descripcion" class="materialize-textarea" name="descripcion"><?=$objCurso->obtenerDescripcion()?></textarea>
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
					<th>Codigo</th>
					<th>Año</th>					
					<th>Tipo Curso</th>
					<th>Profesor</th>
					<th>Imagen</th>
					<th class="center-align" style="width: 130px;" >Acciones</th>
				</tr>
			</thead>
			<tbody>

<?php
			foreach($listaCurso as $curso){
?>
				<tr>
					<td><?=$curso['codigo']?></td>
					<td><?=$curso['anio']?></td>
					<td><?=$curso['nombreTipoCurso']?></td>
					<td><?=$curso['nombreProfesor']?></td>
					<td>
						<img src="<?=$curso['imagen']?>" width="100px">
					</td>
					<td>
						<div class="right">
							<a class="waves-effect waves-light btn" href="sistema.php?r=cursos&id=<?=$curso['codigo']?>&a=editar">
								<i class="material-icons">create</i>
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
						<li class="waves-effect"><a href="sistema.php?r=cursos&p=<?=$arrayPagina['paginaAtras']?>"><i class="material-icons">chevron_left</i></a></li>
<?php
					for($i = 1; $i<=$arrayPagina['totalPagina'] ; $i++){
						$activo = "waves-effect";
						if($arrayPagina['pagina'] == $i){
							$activo = "active";
						}						
?>
						<li class="<?=$activo?>"><a href="sistema.php?r=cursos&p=<?=$i?>"><?=$i?></a></li>
<?php
					}
?>
						<li class="waves-effect"><a href="sistema.php?r=cursos&p=<?=$arrayPagina['paginaSiguiente']?>"><i class="material-icons">chevron_right</i></a></li>
					</ul>
				</td>
			</tr>

		</tbody>
	</table>


	<!-- Modal Structure -->
	<div id="modal1" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Ingresar curso</h4>
			<form enctype="multipart/form-data" method="POST" action="sistema.php?r=cursos" class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<input id="anio" type="text" class="validate" name="anio">
						<label for="anio">Año</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<div class="input-field col s12">
							<select name="tipoCurso">
								<option value="" disabled selected>Elija Tipo Curso</option>
<?php		
							foreach($selectTipoCurso as $tipoCurso){
?>
								<option value="<?=$tipoCurso['idTipoCurso']?>"><?=$tipoCurso['nombre']?></option>	
<?PHP
							}		
?>
							</select>
							<label>Tipos Cursos</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<div class="input-field col s12">
							<select name="profesor">
								<option value="" disabled selected>Elija Tipo Curso</option>
<?php		
							foreach($selectProfesores as $profesor){
?>
								<option value="<?=$profesor['documento']?>"><?=$profesor['nombreCompleto']?></option>	
<?PHP
							}		
?>
							</select>
							<label>Profesores</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="file-field input-field">
						<div class="btn">
							<span>Archivo</span>
							<input type="file" name="archivos" multiple>
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Seleccione un archivo" name="imagen">
						</div>
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