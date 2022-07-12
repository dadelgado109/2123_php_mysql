
<?php

	require_once("webServices/controlador_cursos.php");
		   
	$retorno = array();
	if(isset($_GET['c']) && !Empty($_GET['c']) && $_GET['c'] != ""){

		$accion 	= $_GET['c'];	
		$parametros = json_decode(file_get_contents('php://input'), true);

		if($accion == "listarCursos"){
			$objCursos 	= new controlador_cursos();
			$retorno 	= $objCursos->listarCursos($parametros);		
		}

	}

	//Realizo el encodin de json y lo muestro en pantalla
	$json = json_encode($retorno);
	print_r($json);

?>

