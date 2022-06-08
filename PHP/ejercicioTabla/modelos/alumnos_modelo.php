
<?php

class alumnos_modelo {

		protected $nombre;

		protected $apellido;

		protected $documento;

		protected $tipoDocumento;

		protected $fechaNacimiento;


		public function __construct(){

		}

		public function constructor(){

			if(isset($_POST['nombre'])){
				$this->nombre = $_POST['nombre'];	
			}
			if(isset($_POST['apellido'])){
				$this->apellido = $_POST['apellido'];	
			}
			if(isset($_POST['documento'])){
				$this->documento = $_POST['documento'];	
			}
			if(isset($_POST['tipoDocumento'])){
				$this->tipoDocumento = $_POST['tipoDocumento'];	
			}
			if(isset($_POST['fechaNacimiento'])){
				$this->fechaNacimiento = $_POST['fechaNacimiento'];	
			}

		}

		public function ingresar(){

			if($this->nombre == ""){
				$retorno = array("estado"=>"Error", "mensaje"=>"El nombre no puede ser vacio" );
				return $retorno;
			}
			if($this->apellido == ""){
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
					"apellidos" 		=> $this->apellido,
					"tipoDocumento" 	=> $this->tipoDocumento,
					"fechaNacimiento" 	=> $this->fechaNacimiento
				);
			$this->persistirConsulta($sqlInsert, $arrayInsert);
			$retorno = array("estado"=>"Ok", "mensaje"=>"Se ingreso el alumno correctamente" );
			return $retorno;


		}

		public function listar(){

			$sql 		= "SELECT * FROM alumnos ORDER BY nombre;";
			$arraySql 	= array();
			$lista 		= $this->ejecutarConsulta($sql, $arraySql);
			return $lista;

		}	

		public function listaTipoDocumuento(){

			$arrayRetorno = array();
			$arrayRetorno['CI'] = "CI";
			$arrayRetorno['Pasaporte'] = "Pasaporte";
			$arrayRetorno['Credencial'] = "Credencial";
			return $arrayRetorno;

		}

		public function cargar($documento){

			$sql 		= "SELECT * FROM alumnos WHERE documento = :documento;";
			$arraySql 	= array("documento"=>$documento);
			$lista 		= $this->ejecutarConsulta($sql, $arraySql);			

			foreach($lista as $alumno){

				 $this->nombre 			= $alumno['nombre'];
				 $this->apellido 		= $alumno['apellidos'];
				 $this->documento 		= $alumno['documento'];
				 $this->tipoDocumento 	= $alumno['tipoDocumento'];
				 $this->fechaNacimiento = $alumno['fechaNacimiento'];

			}

		}

		public function obtenerNombre(){
			return $this->nombre ;
		}
		public function obtenerApellido(){
			return $this->apellido ;
		}
		public function obtenerDocumento(){
			return $this->documento ;
		}
		public function obtenerTipoDocumento(){
			return $this->tipoDocumento ;
		}
		public function obtenerFechaNacimiento(){
			return $this->fechaNacimiento ;
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



	}

?>