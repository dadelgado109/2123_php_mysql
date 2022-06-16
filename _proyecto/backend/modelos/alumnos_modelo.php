
<?php

class alumnos_modelo {
/*
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `tipoDocumento` enum('CI','Pasaporte','Credencial') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
*/
	protected $documento;

	protected $nombre;

	protected $apellidos;

	protected $tipoDocumento;

	protected $fechaNacimiento;

	
	public function constructor(){

		$this->documento 		= $this->validarPost('documento');
		$this->nombre 			= $this->validarPost('nombre');
		$this->apellidos 		= $this->validarPost('apellidos');
		$this->tipoDocumento 	= $this->validarPost('tipoDocumento', 'CI');
		$this->fechaNacimiento 	= $this->validarPost('fechaNacimiento');

	}

	public function obtenerDocumento(){
		return $this->documento;
	}

	public function obtenerNombre(){
		return $this->nombre;
	}

	public function obtenerApellidos(){
		return $this->apellidos;
	}

	public function cargarAlumno($documento){

		$sql = "SELECT * FROM alumnos WHERE documento = :documento; ";
		$arrayDatos = array("documento"=>$documento);
		$lista 		= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function ingresar(){

		if($this->nombre == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El nombre no puede ser vacio" );
			return $retorno;
		}
		if($this->apellidos == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El apellido no puede ser vacio" );
			return $retorno;
		}
		$edad = 0;
		$fechaHoy   = new DateTime(date("Y-m-d")); 
		$fechaNac   = new DateTime($this->fechaNacimiento); 
		// Fecha que traigo 
		$diferencia = $fechaHoy->diff($fechaNac);              
		if($diferencia->days < 6570){
			$retorno = array("estado"=>"Error", "mensaje"=>"El el alumnos es menor de edad" );
			return $retorno;
		}
		$arrayTipoDocu = $this->listaTipoDocumuento();
		if(!in_array($this->tipoDocumento,  $arrayTipoDocu)){
			$retorno = array("estado"=>"Error", "mensaje"=>"El tipo de documento no es valido" );
			return $retorno;
		}
		$sqlInsert = "INSERT alumnos SET
						documento 		= :documento,
						nombre			= :nombre,
						apellidos		= :apellidos,
						tipoDocumento 	= :tipoDocumento,
						fechaNacimiento = :fechaNacimiento ;";

		$arrayInsert = array(
				"documento" 		=> $this->documento,
				"nombre" 			=> $this->nombre,
				"apellidos" 		=> $this->apellidos,
				"tipoDocumento" 	=> $this->tipoDocumento,
				"fechaNacimiento" 	=> $this->fechaNacimiento
			);
		$this->persistirConsulta($sqlInsert, $arrayInsert);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se ingreso el alumno correctamente" );
		return $retorno;

	}



	public function listar($filtros = array()){

		$sql = "SELECT * FROM alumnos ";
		$arrayDatos = array();

		if(isset($filtros['pagina']) && $filtros['pagina'] != ""){

			$pagina = ($filtros['pagina'] - 1) * 10;
			$sql .= " ORDER BY documento LIMIT ".$pagina.",10;";		
		
		}else{

			$sql .= " ORDER BY documento LIMIT 0,10;";	

		}

		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function totalRegistros(){

		$sql = "SELECT count(*) AS total FROM alumnos";
		$arrayDatos = array();

		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		$totalRegistros = $lista[0]['total'];		
		return $totalRegistros;

	}

	public function listaTipoDocumuento(){

		$arrayRetorno = array();
		$arrayRetorno['CI'] = "CI";
		$arrayRetorno['Pasaporte'] = "Pasaporte";
		$arrayRetorno['Credencial'] = "Credencial";
		return $arrayRetorno;

	}



	private function ejecutarConsulta($sql, $arraySQL){

		// String conexion a la base de datos
		$srtConexion 	= "mysql:host=localhost;dbname=phpmysql";
		// Credenciales
		$usuario 		= "root";
		$clave 			= "";
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

	private function persistirConsulta($sqlInsert, $arrayInsert){

		// String conexion a la base de datos
		$srtConexion 	= "mysql:host=localhost;dbname=phpmysql";
		// Credenciales
		$usuario 		= "root";
		$clave 			= "";
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

