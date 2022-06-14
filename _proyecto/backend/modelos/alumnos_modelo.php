
<?php

class alumnos_modelo {
/*
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `tipoDocumento` enum('CI','Pasaporte','Credencial') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
*/
	protected $documeto;

	protected $nombre;

	protected $apellidos;

	protected $tipoDocumento;

	protected $fechaNacimiento;

	
	public function constructor(){

		$this->documeto 		= "";
		$this->nombre 			= "";
		$this->apellidos 		= "";
		$this->tipoDocumento 	= "";
		$this->fechaNacimiento 	= "";

	}

	public function cargarAlumno($documento){

		$sql = "SELECT * FROM alumnos WHERE documento = :documento; ";
		$arrayDatos = array("documento"=>$documento);
		$lista 		= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function listar($filtros = array()){

		$sql = "SELECT * FROM alumnos ";
		$arrayDatos = array();

		if(isset($filtros['pagina'])){

			$pagina = ($filtros['pagina'] - 1) * 10;
			$sql .= " ORDER BY documento LIMIT ".$pagina.",10;";		
		
		}else{

			$sql .= " ORDER BY documento LIMIT 0,10;";	

		}

		$lista 		= $this->ejecutarConsulta($sql, $arrayDatos);

		
	


		return $lista;

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
		$conexion 	= new PDO($srtConexion, $usuario, $clave, $options); 		
		$preparo 	= $conexion->prepare($sql);
		$preparo->execute($arraySQL);
		$lista 		= $preparo->fetchAll();
		return $lista;

	}

}


?>

