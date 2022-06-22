
<?php

require_once("modelos/generico_modelo.php");

class administradores_modelo extends generico_modelo {

	protected $id;

	protected $nombre;

	protected $mail;

	protected $clave;

	
	public function constructor(){

		$this->id 				= $this->validarPost('id');
		$this->nombre 			= $this->validarPost('nombre');
		$this->mail 			= $this->validarPost('mail');
		$this->clave 			= $this->validarPost('clave', 'CI');

	}

	public function obtenerId(){
		return $this->id;
	}
	public function obtenerNombre(){
		return $this->nombre;
	}
	public function obtenerMail(){
		return $this->mail;
	}


	public function cargarAdministrador($idRegistro){

		$sql = "SELECT * FROM administradores WHERE id = :idRegistro; ";
		$arrayDatos = array("idRegistro"=>$idRegistro);
		$lista 		= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function ingresar(){

		if($this->nombre == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El nombre no puede ser vacio" );
			return $retorno;
		}

		$sqlInsert = "INSERT administradores SET
						nombre	= :nombre,
						mail	= :mail,
						clave 	= :clave,
						estado	= 1 ;";

		$arrayInsert = array(
				"nombre" 	=> $this->nombre,
				"mail" 		=> $this->mail,
				"clave" 	=> $this->clave
		);
		$this->persistirConsulta($sqlInsert, $arrayInsert);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se ingreso el administradore correctamente" );
		return $retorno;

	}

	public function guardar(){

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

		$sqlInsert = "UPDATE alumnos SET
						nombre			= :nombre,
						apellidos		= :apellidos,
						tipoDocumento 	= :tipoDocumento,
						fechaNacimiento = :fechaNacimiento 
						WHERE documento = :documento;";

		$arrayInsert = array(
				"documento" 		=> $this->documento,
				"nombre" 			=> $this->nombre,
				"apellidos" 		=> $this->apellidos,
				"tipoDocumento" 	=> $this->tipoDocumento,
				"fechaNacimiento" 	=> $this->fechaNacimiento
			);
		$this->persistirConsulta($sqlInsert, $arrayInsert);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se guardo el alumno correctamente" );
		return $retorno;

	}

	public function cargar($documento){

		if($documento == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El documento no puede ser vacio" );
			return $retorno;
		}
		$sql = "SELECT * FROM alumnos WHERE documento = :documento";
		$arraySQL = array("documento" => $documento);
		$lista 	= $this->ejecutarConsulta($sql, $arraySQL);

		$this->documento 		= $lista[0]['documento'];
		$this->nombre 			= $lista[0]['nombre'];
		$this->apellidos 		= $lista[0]['apellidos'];
		$this->tipoDocumento 	= $lista[0]['tipoDocumento'];
		$this->fechaNacimiento 	= $lista[0]['fechaNacimiento'];

	}

	public function borrar(){

		//$sql = "DELETE FROM alumnos WHERE documento = :documento";
		$sql = "UPDATE alumnos SET estado = 0 WHERE documento = :documento";
		$arraySQL = array("documento"=>$this->documento);
		$this->persistirConsulta($sql, $arraySQL);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se borro el alumno" );
		return $retorno;

	}


	public function listar($filtros = array()){

		$sql = "SELECT * FROM alumnos WHERE estado = 1 ";
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




}


?>

