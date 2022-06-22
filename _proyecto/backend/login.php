<?php




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
			</div>
		</nav>    
		<main>
			<div class="container">
				<div>
					<h1 class="center-align">Login</h1>
				</div>
				<div>
					<form method="POST" action="index.php?r=alumnos" class="col s12">
						<div class="row">
							<div class="input-field col s12 m12 l6 offset-l3">
								<input id="first_name" type="text" class="validate" name="nombre">
								<label for="first_name">Nombre</label>
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
								<input type="hidden" name="accion" value="ingresar">
								<button class="btn waves-effect waves-light center-align" type="submit">Entrar
									<i class="material-icons right">send</i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</main>
			  
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

