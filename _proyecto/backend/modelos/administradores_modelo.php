
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

	public function validarLogin($nombre, $clave){

		$sql = "SELECT * FROM administradores WHERE nombre = :nombre AND clave = :clave; ";
		$arrayDatos = array("nombre"=>$nombre, "clave"=>md5($clave));
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
		
		$sqlInsert = "UPDATE alumnos SET
						nombre	= :nombre,
						mail	= :mail,
						WHERE id = :id;";

		$arrayInsert = array(
				"id" 		=> $this->id,
				"nombre" 	=> $this->nombre,
				"mail" 		=> $this->mail
			);
		$this->persistirConsulta($sqlInsert, $arrayInsert);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se guardo el administador  correctamente" );
		return $retorno;

	}

	public function cargar($id){

		if($id == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El documento no puede ser vacio" );
			return $retorno;
		}
		$sql = "SELECT * FROM administrador WHERE id = :id";
		$arraySQL = array("documento" => $documento);
		$lista 	= $this->ejecutarConsulta($sql, $arraySQL);

		$this->id 		= $lista[0]['id'];
		$this->nombre 	= $lista[0]['nombre'];
		$this->mail 	= $lista[0]['mail'];

	}

	public function borrar(){

		//$sql = "DELETE FROM alumnos WHERE documento = :documento";
		$sql = "UPDATE alumnos SET estado = 0 WHERE id = :id";
		$arraySQL = array("id"=>$this->id);
		$this->persistirConsulta($sql, $arraySQL);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se borro el Administrador" );
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

