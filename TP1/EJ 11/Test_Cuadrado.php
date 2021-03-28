<?php
include 'Cuadrado.php';

$nuevoCuasdrado = new Cuadrado;
$nuevoCuasdrado->vertices['A'] = [0, 1];
$nuevoCuasdrado->vertices['B'] = [3, 5];
$nuevoCuasdrado->vertices['C'] = [7, 2];
$nuevoCuasdrado->vertices['D'] = [4, -2];

echo $nuevoCuasdrado;
$puntos = $nuevoCuasdrado->vertices;

/*
foreach($puntos as $attribute => $value) {
   // echo '<p>' . $attribute . ' : ' . $value . '</p>' . PHP_EOL;
    for ($columna=0; $columna<count($value); $columna++){
        echo   "Los vectores del cuadrado es: ".$attribute."--".        $value[$columna]."\n";
    }
  
}*/
echo "\n";
echo "EL area del cuadrado es:  ".$nuevoCuasdrado->area($puntos)."\n";

//CARGAR PUNTO DEL DESPLAZAMIENTO
$puntosDesplazamiento=[2,4];

 $desplazamiento =   $nuevoCuasdrado->desplazar($puntosDesplazamiento);


 list($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2) =  $desplazamiento;

 $cuadrado2 = new Cuadrado;
 $cuadrado2->vertices['A'] = [$A1, $A2];
 $cuadrado2->vertices['B'] = [$B1, $B2];
 $cuadrado2->vertices['C'] = [$C1, $C2];
 $cuadrado2->vertices['D'] = [$D1, $D2];

echo "\n Puntos de desplazamiento de la vertices del cuadrado: \n";
echo $cuadrado2;

//AUMENTAR DE TAMAÑO EL CUADRADO
$tamaño= 2;

$retunTamaño = $nuevoCuasdrado->aumentarTamaño($tamaño);
list($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2) =  $retunTamaño;

$tamañoNuevo = new Cuadrado;
$tamañoNuevo->vertices['A'] = [$A1, $A2];
$tamañoNuevo->vertices['B'] = [$B1, $B2];
$tamañoNuevo->vertices['C'] = [$C1, $C2];
$tamañoNuevo->vertices['D'] = [$D1, $D2];

echo "Puntos de tamaño de la vertices del cuadrado: \n";
echo $tamañoNuevo;


?>