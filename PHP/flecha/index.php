<?php


	function sumar($a, $b){
		return $a + $b;
	}	



	$a = 5;
	$b = 4;
	$fn1 = sumar($a, $b);

	echo($fn1);
	echo("<br>");
	$x = 5;
	$y = 4;

	$fn2 = function ($x) use ($y) {return $x + $y;};

	echo($fn2($x));

?>


