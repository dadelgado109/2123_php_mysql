<?php

	function miFuncion(){

		echo("Soy la funcion <br>");

	}

	function miFuncionDos($var = "No se recibio parametros" ){

		echo("Soy la funcion y me pasaron:".$var." <br>");

	}

	function suma($numUno, $numDos){

		$resultado = $numUno + $numDos;
		return $resultado;

	}

	function sumatorio($arrayNumeros = array()){

		$resultado = 0;
		foreach($arrayNumeros as $numero){

			$resultado = $resultado + $numero;
		}
		return $resultado;
	}

	$arrayNumeros = array(15,10,2,5,7,9);
	$resultado = sumatorio($arrayNumeros);
	print_r($resultado."<br>");

	miFuncion();
	miFuncion();
	miFuncion();
	miFuncion();

	miFuncionDos(15);
	miFuncionDos("Hola soy un parametro");
	$var = "Soy la variable";
	miFuncionDos($var);
	miFuncionDos();

	$resultado = suma(6, 16);

	print_r($resultado."<br>");

	$resultado = suma(10, 30);
	print_r($resultado."<br>");

	$arrayNumeros = array(15,10,2,5,7,9);
	$resultado = sumatorio($arrayNumeros);
	print_r($resultado."<br>");


?>



	function respuestaEdad($edad){

		$retorno = "";
		if($edad > 0 && $edad < 12){
			$retorno = "Soy un Niño";
		}elseif($edad >= 12 && $edad < 18){
			$retorno = "Soy un Adolecente";    
		}elseif($edad >= 18 && $edad < 30){
			$retorno = "Soy un adulto joven";
		}elseif($edad >= 30 && $edad < 70){
			$retorno = "Soy un adulto Responsable";
		}else{
			$retorno = "Soy un juvilado";
		}

		return $retorno;
	}