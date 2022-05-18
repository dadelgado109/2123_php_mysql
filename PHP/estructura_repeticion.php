
<?php

	$i = 0;

	
	while($i < 10){

		echo($i."<br>");
		$i = $i + 1;

	}
	echo("<hr>");

	$seguir = true;
	$j = 0;


	while($seguir){

		echo($j."<br>");
		$j = $j + 2;

		if($j >= 10){
			$seguir = false;
		}

	}
	echo("<hr>");

	$i = 2;
	while($i < 15){

		$i += 2;
		if($i > 10){
			$i = $i -1;
		}
		echo($i.",");
	}

	echo("<hr>");

	for($o = 0; $o < 10; $o++ ){

		echo($o.",");	
	}	

	echo("<hr>");

	$var1 = 10;
	$var2 = 5;

	do{
		echo("Estoy ejecutando");
		$var2++;
	}while($var1 > $var2);

	echo("<hr>");

	$sigo = false;
	$var1 = 10;
	$var2 = 5;

	do{
		echo("Estoy ejecutando | ");
		$sigo = true;
		$var2++;
		if($var2 > $var1){
			$sigo = false;
		}	
	}while($sigo);







?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>

		<table style = "border-style: double;">
			<thead >
				<tr border-style: double;>
					
				</tr>
			</thead>
			<tbody>
				<tr>
				
				</tr>
			</tbody>
		</table>

	</body>
</html>




