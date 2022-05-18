<?PHP

$soyVariable = 10;

// Escribimos comentarios y no se interpreta
//echo($soyVariable);

var_dump($soyVariable);

//--------------------------
// Definimos una varible de tipo string
$varTexto = "Soy un texto en php";
var_dump($varTexto);

//--------------------------
// Definimos una variable de tipo real
$varReal = 12.13;
var_dump($varReal);

//--------------------------
// Definimos variables de tipo bouleana
$varBolean = FALSE;
var_dump($varBolean);
// Solo muestra si es TRUE y muesta 1
print_r($varBolean);
// No muestra nada 
echo($varBolean);
//--------------------------

//--------------------------
// Definimos una variable de tipo array
// Ejemplo de array asosiativo donde usamos concepto de clave-valor 
echo("<br>");
echo("<hr>");
$arrayVar = array("Primero"=>"Uno", "Segundo"=>"Dos", "Tercero"=>"Tres");
echo("<br>");
var_dump($arrayVar);
echo("<br>");
print_r($arrayVar);
// Ejempo de array numerado
echo("<hr>");
$varArrayNum = array("Uno","Dos","Tres");
var_dump($varArrayNum);
echo("<br>");
print_r($varArrayNum);
echo("<hr>");

$unoInt = 1;
var_dump($unoInt);
echo("<br>");
$unoStr = "1";
var_dump($unoStr);



?>

<html>
    <head>
    </head>
    <body>
        <br><br>
        Hola html
        <br>
        <?PHP echo("Soy PHP")?>
        <br>
        <?=$soyVariable?>

    </body>
</html>




