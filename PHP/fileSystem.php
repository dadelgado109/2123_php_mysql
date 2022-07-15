<?php

require_once("modelos/alumnos_modelo.php");



$archivo = fopen("archivos/archivo.txt", "a+");

fwrite($archivo, "Hola soy un texto \n ");
fwrite($archivo, "Soy la segunda linea \n ");


fclose($archivo);

echo("Finalice");



$objAlumnos = new alumnos_modelo();
$listaAlumnos = $objAlumnos->listar();

   
//print_r($listaAlumnos);
$archivoCSV = fopen("archivos/alumnos.csv", "w+");

$textoDato = "Documento|Nombres|Apellidos|Fecha Nacimiento \n";
fwrite($archivoCSV, $textoDato);

foreach($listaAlumnos AS $alumno){

		$textoDato = "".$alumno['documento']."|".$alumno['nombre']."|".$alumno['apellidos']."|".$alumno['fechaNacimiento']."\n";
		echo("<br>");
		print_r($alumno);
		echo("<br>");
		print_r($textoDato);
		echo("<hr>");
		fwrite($archivoCSV, $textoDato);
}

fclose($archivoCSV);

echo("<hr>");
echo("<hr>");

$archivoAbierto = fopen("archivos/alumnos.csv", "r");

while(!feof($archivoAbierto)){
	$linea = fgets($archivoAbierto);
	print_r($linea. "<br>");
}

fclose($archivoAbierto);



?>