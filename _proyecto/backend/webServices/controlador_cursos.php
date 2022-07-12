<?php

	require_once("modelos/cursos_modelo.php"); 

	class controlador_cursos{


		public function listarCursos($parametros){

			$arrayFiltro = array();

			$arrayFiltro['pagina'] = isset($parametros['pagina'])?$parametros['pagina']:"";
		
			$objCurso = new cursos_modelo();
			$retorno = $objCurso->listar($arrayFiltro);
			return $retorno;

		}



	}









?>