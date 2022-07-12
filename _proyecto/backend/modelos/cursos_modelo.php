<?PHP

require_once("modelos/generico_modelo.php");

class cursos_modelo extends generico_modelo{


	protected $codigo;

	protected $anio;
	// es el id de tabla tipo de cursos
	protected $tipoCurso;
	// Documento  del profesor
	protected $profesor;
	// guarda la ruta de la imagen
	protected $imagen;

	public function constructor(){

		$this->codigo 	= $this->validarPost('codigo');
		$this->anio 	= $this->validarPost('anio');
		$this->tipoCurso= $this->validarPost('tipoCurso');
		$this->profesor = $this->validarPost('profesor');

	}

	public function ingresar(){

		if($this->anio == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El año no puede ser vacio" );
			return $retorno;
		}
		if($this->tipoCurso == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El tipo de curso no puede ser vacio" );
			return $retorno;
		}
		if($this->profesor == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El profesor no puede ser vacio" );
			return $retorno;
		}
		$sqlInsert = "INSERT cursos SET
						anio 		= :anio,
						profesores	= :profesores,
						idTipoCurso	= :tipoCurso,
						imagen		= :imagen;";

		$arrayInsert = array(
			"anio" 			=> $this->anio,
			"profesores" 	=> $this->profesor,
			"tipoCurso" 	=> $this->tipoCurso,
			"imagen" 		=> $this->imagen
		);
		$this->persistirConsulta($sqlInsert, $arrayInsert);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se ingreso el curso correctamente" );
		return $retorno;

	}

	public function cargar($codigo){

		if($codigo == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El id no puede ser vacio" );
			return $retorno;
		}
		$sql = "SELECT * FROM curos WHERE codigo = :codigo";
		$arraySQL = array("codigo" => $codigo);
		$lista 	= $this->ejecutarConsulta($sql, $arraySQL);

		$this->codigo 	 = $lista[0]['codigo'];
		$this->anio 	 = $lista[0]['anio'];
		$this->profesor  = $lista[0]['profesor'];
		$this->tipoCurso = $lista[0]['tipoCurso'];

	}


	public function guardar(){

		if($this->nombre == ""){
			$retorno = array("estado"=>"Error", "mensaje"=>"El nombre no puede ser vacio" );
			return $retorno;
		}
	
		$sqlUpdate = "UPDATE cursos SET
						anio		= :anio,
						profesores	= :profesores,
						idTipoCurso	= :tipoCurso
						WHERE codigo = :codigo;";

		$arrayUpdate = array(
			"anio" 			=> $this->anio,
			"profesores" 	=> $this->profesor,
			"tipoCurso" 	=> $this->tipoCurso,
			"codigo" 		=> $this->codigo
		);
		$this->persistirConsulta($sqlUpdate, $arrayUpdate);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se guardo el curso correctamente" );
		return $retorno;

	}

	/*
	public function borrar(){

		$sql = "UPDATE tiposcursos SET estado = 0 WHERE idTipoCurso = :idTipoCurso";
		$arraySQL = array("idTipoCurso"=>$this->idTipoCurso);
		$this->persistirConsulta($sql, $arraySQL);
		$retorno = array("estado"=>"Ok", "mensaje"=>"Se borro el tipo de curso" );
		return $retorno;

	}*/

	public function obtenerCodigo(){
		return $this->codigo;
	}
	public function obtenerAnio(){
		return $this->anio;
	}
	public function obtenerDocumento(){
		return $this->documento;
	}
	public function obtenerTipoCurso(){
		return $this->tipoCurso;
	}
	public function obtenerImagen(){
		return $this->imagen;
	}
	public function cargarImagen($ruta){
		$this->imagen = $ruta;
	}

	public function listar($filtros = array()){

		$sql = "SELECT 
					c.codigo,
					c.anio,
					c.idTipoCurso AS idTipoCurso,
					t.nombre AS nombreTipoCurso,
					c.profesores,
					CONCAT(p.nombre, ' ', p.apellidos) AS nombreProfesor,
					imagen
				FROM cursos c
				INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso
				INNER JOIN profesores p ON p.documento = c.profesores";

		$arrayDatos = array();
		if(isset($filtros['pagina']) && $filtros['pagina'] != ""){

			$pagina = ($filtros['pagina'] - 1) * 10;
			$sql .= " ORDER BY codigo LIMIT ".$pagina.",10;";		
		
		}else{

			$sql .= " ORDER BY codigo LIMIT 0,10;";	

		}

		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		return $lista;

	}

	public function totalRegistros(){

		$sql = "SELECT count(*) AS total FROM cursos";
		$arrayDatos = array();

		$lista 	= $this->ejecutarConsulta($sql, $arrayDatos);
		$totalRegistros = $lista[0]['total'];		
		return $totalRegistros;

	}

}


?>