
<?php

require_once("php/modelos/generico_modelo.php");

class ticket_modelo extends generico_modelo {

	protected $idTicket;



	public function obtenerBuscarTicket($idCliente){
		
		$sql = "SLECT * FROM tabla WHERE idCliente = $idCliente AND estado = 'abierto' ORDER BY idTicket DESC LIMIT 1";
		
		$resultado = $this->ejecutarConsulta($sql, $arrayDatos);

		if($resultado == vacio){
			$sql = "Ingreso el tiket set idCliente = $idCliente, estado = 'abierto' ";
			$this->ejecutarConsulta($sql, $arrayDatos);

			$sql = "Busco el tiker WHERE idCliente = $idCliente AND estado = 'abierto' ORDER BY idTicket DESC LIMIT 1";
			$resultado = $this->ejecutarConsulta($sql, $arrayDatos);
		}

		$idTiket = $resultado[0]['idTicket'];
		return $idTiket;

	}


	

}


?>

