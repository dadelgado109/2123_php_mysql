<?php

    function respuestaEdad($edad){

		$retorno = "";
		if($edad > 0 && $edad < 12){
			$retorno = "Soy un Niño y lindo";
		}elseif($edad >= 12 && $edad < 18){
			$retorno = "Soy un Adolecente y voy a clase";    
		}elseif($edad >= 18 && $edad < 30){
			$retorno = "Soy un adulto joven Y con energia";
		}elseif($edad >= 30 && $edad < 70){
			$retorno = "Soy un adulto Responsable";
		}else{
			$retorno = "Soy un alguien que disfruta del tiempo";
		}

		return $retorno;
	}




?>