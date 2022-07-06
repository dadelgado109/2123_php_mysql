<?php

	//echo("Estoy en el frontend");    
	require_once("php/modelos/cursos_modelo.php");
	require_once("php/modelos/alumnos_modelo.php");
	

	$objCursos = new cursos_modelo();
	$objAlumno = new alumnos_modelo();


	if(isset($_POST['accion']) && $_POST['accion'] == "login"){
		$documento = isset($_POST['documento'])?$_POST['documento']:"";
		$clave 	   = isset($_POST['clave'])?$_POST['clave']:"";
		$respuesta = $objAlumno->login($documento, $clave);

		if($respuesta){
			echo("ESTOY LOGUEADO");
		}else{
			echo("ERROR EN EL LOGUEO");
		}

	}


	$anio = date("Y");
	$filtros = array('anio' => $anio);
	$listaCursos = $objCursos->listar($filtros);

	$estado = "";




?>

<!DOCTYPE html>
<html>
	<head>
	  	<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  	<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

	 	 <!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<style>	
			  body {
			    display: flex;
			    min-height: 100vh;
			    flex-direction: column;
			  }
			  main {
			    flex: 1 0 auto;
			  }
		</style>
	</head>

	<body>
		<nav>
			<div class="nav-wrapper">
				<a href="#!" class="brand-logo"><i class="material-icons">cloud</i>Logo</a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a class="modal-trigger" href="#modal1">
							<i class="material-icons">person</i>
						</a>
					</li>
				</ul>
			</div>
		</nav>
		<div id="modal1" class="modal modal-fixed-footer">
			<div class="modal-content">
				<h4 class="center-align">Login</h4>
				<?PHP if($estado == "Error"){ ?>
					<div class="red lighten-4 valign-wrapper" style="height:70px">
						<h5 class="center-align" style="width:100%">
							Error en el usuario y/o clave
						</h5>
					</div>
				<?PHP } ?>
				<form method="POST" action="index.php" class="col s12">
					<div class="row">
						<div class="input-field col s12 m12 l6 offset-l3">
							<input id="documento" type="text" class="validate" name="documento">
							<label for="documento">Documento</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l6 offset-l3">
							<input id="last_name" type="password" class="validate" name="clave">
							<label for="last_name">Clave</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l6 offset-l3">
							<input type="hidden" name="accion" value="login">
							<button class="btn waves-effect waves-light center-align" type="submit">Entrar
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Salir</a>
			</div>
		</div>

		<div class="parallax-container">
	    	<div class="parallax"><img src="img/img_codigo.jpg"></div>
	    </div>

		<main>
			<div class="container">
				<div class="row">
<?php 			
				foreach($listaCursos as $cursos){
?>
					<div class="col s4">
						<div class="card">
							<div class="card-image waves-effect waves-block waves-light">
								<img class="activator" src="http://localhost/_taller_informatica/2123_php_mysql/cursos/_proyecto/backend/<?=$cursos['imagen']?>">
							</div>
							<div class="card-content">
								<span class="card-title activator grey-text text-darken-4"><?=$cursos['nombreTipoCurso']?><i class="material-icons right">more_vert</i></span>
								<p><a href="#">Ver Mas</a></p>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4">
									<?=$cursos['nombreTipoCurso']?><i class="material-icons right">close</i>
								</span>
								<p>
									<span>Profesor:</span><?=$cursos['nombreProfesor']?><br><br>
									<span>Año:</span><?=$cursos['anio']?><br><br>
									<span>Descripcion:</span><?=$cursos['descripcion']?>
								</p>
							</div>
						</div>
					</div>
				
<?PHP
				}
?>
				</div>


			</div>
		</main>
		
        <footer class="page-footer">
			<div class="container">
        
			</div>
			<div class="footer-copyright">
				<div class="container">
					© <?=date("Y")?> Copyright Text
					<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
				</div>
			</div>
		</footer>

		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="js/materialize.min.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				M.AutoInit();	
				var elems = document.querySelectorAll('.modal');
    			var instances = M.Modal.init(elems, options);		
			});	
		</script>
	</body>
</html>