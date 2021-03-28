<?php
include 'Reloj.php';

function menu()
{
    echo "-------------------------------\n";
    echo "1) Incrementar. \n";
    echo "2) Poner a cero. \n";
    echo "0) Apagar cronometro. \n";
    echo "-------------------------------\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}
$hora = new Reloj();
$hora->leerHora("23","59","55");

do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Reloj apagado! \n";
            break;
        case 1:
            echo $hora;
            $segun = $hora->restaSegundos();
            $hora->incrementar($segun)."\n";
             break;
        case 2:
            $segun = $hora->puesta_a_cero();
            $hora->incrementar($segun). "\n";
            break;
    }
} while ($opcion != 0);


?>