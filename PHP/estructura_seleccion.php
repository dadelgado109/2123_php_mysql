<?php

	$respuesta = "";
	$respuestaSwch = "";
	$a = 2;
	$b = 3;

	if($a == $b && $a == 5 ){

		$respuesta = "A es igual a B y A vale 5";

	}elseif($a < $b){

		$respuesta = "A es menor a B";
	
	}elseif($a > $b && $a == 3){

		$respuesta = "A es mayor a b Y a vale 3";

	}elseif($a > $b && $b == 3){

		$respuesta = "A es mayor a b Y b vale 3";
	
	}elseif($a > $b && $a < 7){

		$respuesta = "A es mayor a b Y a < 7";

	}else{

		$respuesta = "No es ninguna de las comparaciones anteriores";
	}


	switch($a){

		case "1":
			$respuestaSwch .= "Soy A y valgo 1";
			break;
		case "2":
			$respuestaSwch .= "Soy A y valgo 2";
		case "3":
			$respuestaSwch .= "Soy A y valgo mas que 2";
			break;
		case "4":
			$respuestaSwch .= "Soy A y valgo 4";
			break;
		case "5":
			$respuestaSwch .= "Soy A y valgo 5";
			break;
		default:
			$respuestaSwch .= "No estoy en la lista";
			break;

	}


	$y = 5;
	$x = 3;
	$operacion = "*";
	$resultado = 0;

	if($operacion == "+" ){

		$resultado = $y + $x;

	}elseif($operacion == "-"){

		$resultado = $y - $x;
	
	}elseif($operacion == "*"){

		$resultado = $y * $x;

	}elseif($operacion == "/"){

		$resultado = $y / $x;	

	}else{

		$resultado = "No existe la operacion";
	}


?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<h1><?=$respuesta?></h1>
		<h1><?=$respuestaSwch?></h1>

		<table style = "border-style: double;">
			<thead >
				<tr border-style: double;>
					<td>Valor 1</td>
					<td>Operacion</td>
					<td>Valor 2</td>
					<td></td>
					<td>Resultado</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?=$y?></td>
					<td><?=$operacion?></td>
					<td><?=$x?></td>
					<td>=</td>
					<td><?=$resultado?></td>
				</tr>
			</tbody>
		</table>

	</body>
</html>


