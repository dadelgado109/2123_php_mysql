
<?PHP


class generico_modelo {


    protected function ejecutarConsulta($sql, $arraySQL){

		include("configuracion/configuracion.php");

		$srtConexion 	= "mysql:".$DATABASE['host']."=localhost;dbname=".$DATABASE['database'];
		// Credenciales
		$usuario 		= $DATABASE['user'];
		$clave 			= $DATABASE['password'];

		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
		// Realizo la conexion con el servidor
		$conexion 	= new PDO($srtConexion, $usuario, $clave, $options); 		
		$preparo 	= $conexion->prepare($sql);
		$preparo->execute($arraySQL);
		$lista 		= $preparo->fetchAll();
		return $lista;

	}

	protected function persistirConsulta($sqlInsert, $arrayInsert){

		// String conexion a la base de datos
		include("configuracion/configuracion.php");

		$srtConexion 	= "mysql:".$DATABASE['host']."=localhost;dbname=".$DATABASE['database'];
		// Credenciales
		$usuario 		= $DATABASE['user'];
		$clave 			= $DATABASE['password'];
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
		$conexion 	= new PDO($srtConexion, $usuario, $clave, $options); 
	
		$preparo 	= $conexion->prepare($sqlInsert);
		$respuesta	= $preparo->execute($arrayInsert);	

	}

	public function validarPost($nombreParametro, $default = ""){
		/*	Operador ternario 
			variable  Condicion opcion1=Verdadero opcion2=Falso 
			$var    =  ()      ?"Verdero":"Falso"; 

		*/
		$retorno = isset($_POST[$nombreParametro])?$_POST[$nombreParametro]:$default;
		return $retorno;

	}


	public function paginador($numPagina){

		// Valido si el $numPagina es un numero
		if(!is_numeric($numPagina)){
			// En caso de no ser un numero le asigno el numero 1
			$numPagina = 1;	
		}

		$paginaAtras 	= $numPagina - 1;
		// Valido si pagina atras es menor a 1
		if($paginaAtras < 1){
			// En caso que sea menor le asigo el valor 1
			$paginaAtras 	= 1;	
			$numPagina		= 1;

		}	
		// Primero obtengo el total de registros
		$totalRegistros	= $this->totalRegistros();
		// Despues sacamos la cuenta de cuantas paginas tenemos.
		// Con la funcion ceil($var) Siempre redondeamos para arriba el resultado
		$totalpaginas = ceil(($totalRegistros/10));	
		// Sumamos a la pagina actual 1 para indicar la pagina siguiente
		$paginaSiguiente = $numPagina + 1;
		// Revisamos si pagina siguente supera el maximo de pagina 
		if($paginaSiguiente >= $totalpaginas){
			// Si supera el maximo de pagina ponemos el maximo de pagima
			$paginaSiguiente = $totalpaginas;
		}	
		// Armo la respuesta
		$arrayPagina = array(
							"paginaAtras"		=>$paginaAtras,
							"pagina"			=>$numPagina,
							"paginaSiguiente"	=>$paginaSiguiente, 
							"totalPagina"		=>$totalpaginas
		);
		return $arrayPagina;

	}	

}

?>