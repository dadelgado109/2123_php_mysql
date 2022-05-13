<?PHP

$x = 10;
$y = 5;
$z = 2;
$a = 10;
$b = "10";

// Creamos variables para ver comportamiento Igualacion
$varIgual1 = $y == $a;
$varIgual2 = $x == $a;
$varIgual3 = $x == $b;
$varIgual4 = $x === $b;

// ------------------------------------
// Comparamos la diferencia
$varDif1 = $y != $a;
$varDif2 = $x != $a;
$varDif3 = $x != $b;
$varDif4 = $x !== $b;

// Comparamos los si mayoes o menos
// Compramos que $y sea mayor a $x
$varMayor1 = $y > $x;
//Comparamos que $y sea menor a $x
$varMayor2 = $y < $x;
//Comparamos que $x sea mayor a $y
$varMayor3 = $x > $y;

// Comaparamos que mayor igual
$varMayor4 = $x > $a;
$varMayIgu1 = $x >= $a;



?>

<html>
    <head>
    </head>
    <body>
        <h1>Operadores</h1>
        <h3>Resultado varDump $varIgual1:<?PHP var_dump($varIgual1)?></h3>
        <h3>Resultado varDump $varIgual2:<?PHP var_dump($varIgual2)?></h3>
        <h3>Resultado varDump $varIgual3:<?PHP var_dump($varIgual3)?></h3>
        <h3>Resultado varDump $varIgual4:<?PHP var_dump($varIgual4)?></h3>
        <h3>Resultado varDump $varDif1:<?PHP var_dump($varDif1)?></h3>
        <h3>Resultado varDump $varDif2:<?PHP var_dump($varDif2)?></h3>
        <h3>Resultado varDump $varDif3:<?PHP var_dump($varDif3)?></h3>
        <h3>Resultado varDump $varDif4:<?PHP var_dump($varDif4)?></h3>
        <h3>Resultado varDump $varMayor1:<?PHP var_dump($varMayor1)?></h3>
        <h3>Resultado varDump $varMayor2:<?PHP var_dump($varMayor2)?></h3>
        <h3>Resultado varDump $varMayor3:<?PHP var_dump($varMayor3)?></h3>
        <h3>Resultado varDump $varMayor4:<?PHP var_dump($varMayor4)?></h3>
        <h3>Resultado varDump $varMayIgu1:<?PHP var_dump($varMayIgu1)?></h3>
    </body>
</html>


