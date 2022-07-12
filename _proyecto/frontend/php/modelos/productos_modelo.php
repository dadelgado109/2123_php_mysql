
<?php

require_once("php/modelos/generico_modelo.php");

class productos_modelo extends generico_modelo {

	protected $idProducto;

	protected $idTicket;

	protected $idArticulo;

	public function constructor(){
		
	}

	public function guardar(){
		return "1";
	}

	public function cargarLineas(){
		return array();
	}

}


?>

