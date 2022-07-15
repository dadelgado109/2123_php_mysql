<?php

	echo("Hola \n");

	// Total de ok
	$totalOk = 0;
	// Total de errores 
	$totalErrore = 0;
	// Todos los nombre (No se pueden repetir)
	$todosNombre = array();
	// Primera Hora del login 
	$horaPriLogin = "";
	// Ultima hora del login
	$horaUltLogin = "";
	
	$archivo = fopen("tmp/login.log", "r");

	while(!(feof($archivo ))){

		$linea = fgets($archivo);
		print_r($linea."\n");
		
		if($linea != ""){

			$data = array();
		
			$parteUno = explode("|",$linea);
			$data['fecha'] = $parteUno[0];

			$parteDos = explode("-", $parteUno[1]);
			$auxiliar = explode(":", $parteDos[0]);
			$data['nombre'] = $auxiliar[1];
			$auxiliarDos = explode(":", $parteDos[1]);
			$data['resultado'] = $auxiliarDos[1];

			print_r($data);

			if(trim($data['resultado']) == "ok"){
				$totalOk = $totalOk + 1;
			}
			if(trim($data['resultado']) == "error"){
				$totalErrore = $totalErrore + 1;
			}

			if(!in_array($data['nombre'], $todosNombre)){
				$todosNombre[] = $data['nombre'];
			}

			if($horaPriLogin == "" && trim($data['resultado']) == "ok"){

				$horaPriLogin 	= $data['fecha'];
			
			}elseif($horaPriLogin != "" && trim($data['resultado']) == "ok"){

				$auxAnterior = strtotime(trim($horaPriLogin));
				$auxNuevo = strtotime(trim($data['fecha']));

				if($auxAnterior > $auxNuevo){
					$horaPriLogin = $data['fecha'];
				}
			}

			if($horaUltLogin == "" && trim($data['resultado']) == "ok"){

				$horaUltLogin 	= $data['fecha'];
			
			}elseif($horaUltLogin != "" && trim($data['resultado']) == "ok"){

				$auxAnterior = strtotime(trim($horaUltLogin));
				$auxNuevo = strtotime(trim($data['fecha']));

				if($auxAnterior < $auxNuevo){
					$horaUltLogin = $data['fecha'];
				}
			}


		}
	
	}

	print_r("\n ----------------------------------------------------- \n ");	
	print_r($totalOk."\n");
	print_r($totalErrore."\n");
	print_r($todosNombre);
	print_r($horaPriLogin."\n");
	print_r($horaUltLogin."\n");

	print_r("\n ----------------------------------------------------- \n ");	

	fclose($archivo);


?>