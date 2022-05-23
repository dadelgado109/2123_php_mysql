<?php

    $var1 = 6;
    $var2 = 7;
    $resultado = "";

    // El if revisa condiciones en caso que se cumpla ejecuta el 
    //codigo que esta dentro los parentesis rectos
    if($var1 > $var2){

        $resultado = "Var1 es mayor a var2";

    }else{

        $resultado = "Var1 es menor a var2";

    }


    $edad = 34;
    $quienSoy = "No tengo categoria";

    if($edad > 0 && $edad < 12){
        $quieSoy = "Soy un Niño";
    }elseif($edad >= 12 && $edad < 18){
        $quienSoy = "Soy un Adolecente";    
    }elseif($edad >= 18 && $edad < 30){
        $quienSoy = "Soy un adulto joven";
    }elseif($edad >= 30 && $edad < 70){
        $quienSoy = "Soy un adulto Responsable";
    }else{
        $quieSoy = "Soy un juvilado";
    }





?>

<h1><?=$quienSoy?></h1>

