<?php

class logs_modelo {


	public function guardar($ruta, $linea){


		$archivoCSV = fopen($ruta, "a+");

		$fecha = date("Y-m-d H:i:s");
		
		fwrite($archivoCSV, $fecha." | ".$linea."\n");

		fclose($archivoCSV);

	}

}


?>