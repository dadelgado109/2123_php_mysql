<?PHP

require_once("modelos/generico_modelo.php");

class tipoCursos_modelo extends generico_modelo{


	protected $idTipoCurso;

	protected $nombre;

	protected $descripcion;


	public function constructor(){

		$this->idTipoCurso  = $this->validarPost('idTipoCurso');
		$this->nombre 		= $this->validarPost('nombre');
		$this->descripcion 	= $this->validarPost('descripcion');

	}

	public function ingresar(){

		if($this->nombre == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El nombre no puede ser vacio" );
			return $retorno;
		}

		$sqlInsert = "INSERT tiposcursos SET
						nombre 		= :nombre,
						descripcion	= :descripcion,
						estado		= 1 ;";

		$arrayInsert = array(
			"nombre" 		=> $this->nombre,
			"descripcion" 	=> $this->descripcion
		);
		$this->persistirConsulta($sqlInsert, $arrayInsert);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se ingreso el tipo de curso correctamente" );
		return $retorno;

	}

	public function cargar($idTipoCurso){

		if($idTipoCurso == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El id no puede ser vacio" );
			return $retorno;
		}
		$sql = "SELECT * FROM tiposcursos WHERE idTipoCurso = :idTipoCurso";
		$arraySQL = array("idTipoCurso" => $idTipoCurso);
		$lista 	= $this->ejecutarConsulta($sql, $arraySQL);

		$this->idTipoCurso 	= $lista[0]['idTipoCurso'];
		$this->nombre 		= $lista[0]['nombre'];
		$this->descripcion 	= $lista[0]['descripcion'];

	}


	public function guardar(){

		if($this->nombre == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El nombre no puede ser vacio" );
			return $retorno;
		}
	
		$sqlUpdate = "UPDATE tiposcursos SET
						nombre			= :nombre,
						descripcion		= :descripcion
						WHERE idTipoCurso = :idTipoCurso;";

		$arrayUpdate = array(
			"idTipoCurso" 	=> $this->idTipoCurso,
			"nombre" 		=> $this->nombre,
			"descripcion" 	=> $this->descripcion
		);
		$this->persistirConsulta($sqlUpdate, $arrayUpdate);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se guardo el tipo de curso correctamente" );
		return $retorno;

	}

	public function borrar(){

		$sql = "UPDATE tiposcursos SET estado = 0 WHERE idTipoCurso = :idTipoCurso";
		$arraySQL = array("idTipoCurso"=>$this->idTipoCurso);
		$this->persistirConsulta($sql, $arraySQL);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se borro el tipo de curso" );
		return $retorno;

	}

	public function obtenerIdTipoCursos(){
		return $this->idTipoCurso;
	}
	public function obtenerNombre(){
		return $this->nombre;
	}
	public function obtenerDescripcion(){
		return $this->descripcion;
	}

	public function listar($filtros = array()){

		$sql = "SELECT * FROM tiposcursos WHERE estado = 1";
		$arrayDatos = array();

		if(isset($filtros['pagina']) && $filtros['pagina'] != ""){

			$pagina = ($filtros['pagina'] - 1) * 10;
			$sql .= " ORDER BY idTipoCurso LIMIT ".$pagina.",10;";		
		
		}else{

			$sql .= " ORDER BY idTipoCurso LIMIT 0,10;";	

		}

		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function listarSelect(){

		$sql = "SELECT idTipoCurso, nombre FROM tiposcursos WHERE estado = 1";
		$arrayDatos = array();
		$sql .= " ORDER BY idTipoCurso";	
		
		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function totalRegistros(){

		$sql = "SELECT count(*) AS total FROM tiposcursos";
		$arrayDatos = array();

		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		$totalRegistros = $lista[0]['total'];		
		return $totalRegistros;

	}

}


?>