<?php


		$varTextoOriginal = "Yo me llamo Damian";
		echo("<h1>".$varTextoOriginal."</h1>");
		$varArrayTexto = str_split($varTextoOriginal);

		$total = count($varArrayTexto) - 1;
		$arrayInverso = array();

		foreach($varArrayTexto as $clave => $letra ){						
			$arrayInverso[$total - $clave] = $letra;
		}
		$arrayAxuliar = array();
 		for($i = 0; $i<=$total; $i++){
			$arrayAxuliar[]	= $arrayInverso[$i];
		}
		$textoReverso = implode("", $arrayAxuliar);
		echo("<h1>".$textoReverso."</h1>");

		echo("<hr>");

		$var = array(
				"a" => 1,
				"b" => 2,
				"c" => 3,
				"d" => array(
						"A" => 15,
						"B"	=> 16,
						"C" => array(
							"w" => 1,
							"y" => 2,
							"j" => 5,
							"k" => 2,
							"t" => 8,
					)
				)
			);

		//4,3,5

		function recorrerArray($array = array()){
			$retorno = "";
			$varConteo = 0;
			foreach($array as $valor){
				if(is_array($valor)){
					$retorno = recorrerArray($valor);
					$varConteo++;
				}else{
					$varConteo++;
				}
			}
			$retorno = $varConteo.",".$retorno;
			return $retorno;
		}

		$totales = recorrerArray($var);
		print_r($totales);





?>