<?php

	@session_start();
	
	if(isset($_SESSION['nombre'])){

	}else{
		header('Location: login.php');
	}

?>
<!DOCTYPE html>
<html>
	<head>
	  	<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  	<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="web/css/materialize.css"  media="screen,projection"/>

	  	<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<style>			
			body {
				display: flex;
				min-height: 100vh;
				flex-direction: column;
			}
			main {
				flex : 1 0 auto;
			}
			table.striped > tbody > tr:nth-child(odd) {
				background-color: rgba(209, 244, 255, 0.5);
			}


		</style>

	</head>

	<body>
		
		
		<nav class="light-blue lighten-4">
			<div class="nav-wrapper ">
				<a href="#!" class="brand-logo center orange-text text-darken-3">
					<span class="red-text">Mi</span>Contol
				</a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a class="light-blue-text text-darken-4" href="sistema.php?r=profesores">Profesores</a>
					</li>
					<li>
						<a class="light-blue-text text-darken-4" href="sistema.php?r=tiposCursos">Tipos Cursos</a>
					</li>
					<li>
						<a class="light-blue-text text-darken-4" href="sistema.php?r=cursos">Cursos</a>
					</li>
					<li >
						<a class="light-blue-text text-darken-4" href="sistema.php?r=alumnos">Alumnos</a>
					</li>
					 <!-- Dropdown Trigger -->
					<li>
						<a class="dropdown-trigger light-blue-text text-darken-4" href="#!" data-target="dropdown1">
							<i class="material-icons right">settings</i>
						</a>
					</li>					
					<li>&nbsp&nbsp&nbsp&nbsp</li>
				</ul>
			</div>
		</nav>
        <!-- Menu del boton  -->
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="#!" class="light-blue-text text-darken-4">Perfil</a></li>
			<li><a href="logout.php" class="light-blue-text text-darken-4">Salir</a></li>
			<li class="divider"></li>
			<li><a href="#!" class="light-blue-text text-darken-4">Usuarios</a></li>
		</ul>

		<main>
			<div class="container">
				<h1><?=$_SESSION['nombre']?></h1>	
				<?PHP include ("router.php"); ?>

			</div>
		</main>

		
		<div class="fixed-action-btn hide-on-large-only">
			<a class="btn-floating btn-large red">
				<i class="large material-icons">add</i>
			</a>
			<ul>
				<li><a class="btn-floating red" href="sistema.php?r=profesores"><i class="material-icons">person</i></a></li>
				<li><a class="btn-floating yellow darken-1" href="sistema.php?r=tiposCursos"><i class="material-icons">share</i></a></li>
				<li><a class="btn-floating green" href="sistema.php?r=cursos"><i class="material-icons">assignment</i></a></li>
				<li><a class="btn-floating blue" href="sistema.php?r=alumnos"><i class="material-icons">assignment_ind</i></a></li>
			</ul>
		</div>
		      
		<footer class="page-footer light-blue lighten-4">		
			<div class="footer-copyright">
				<div class="container orange-text text-darken-4">
					© 2014 Copyright Text
					<a class="orange-text text-darken-4 right" href="#!">More Links</a>
				</div>
			</div>
		</footer>
		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="web/js/materialize.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				M.AutoInit();			
			});	
		</script>
	</body>
</html>

