<?php
include 'Linea.php';

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "--------------------------------------------------------------\n";
    echo "1) Mueve la linea a la derecha. \n";
    echo "2) Mueve la linea a la izquierda. \n";
    echo "3) Mueve la linea a la arriba. \n";
    echo "4) Mueve la linea a la abajo. \n";
    echo "0) EXIT. \n";
    echo "--------------------------------------------------------------\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}
/**
 * PROGRAMA PRINCIPAL
 * int $puntoPax, $puntoPby, $puntoPcx, $puntoPdy
 */

// Inicializacion de variables
$puntoPax=2;
$puntoPby=1;
$puntoPcx=1;
$puntoPdy=3;

$nuevaLinea = new Linea($puntoPax,$puntoPby, $puntoPcx, $puntoPdy);
echo $nuevaLinea."\n";
do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "EXIT ! \n";
            break;
        case 1:
            echo "Ingrese el valor: ";
            $dato = (int) trim(fgets(STDIN));
             $info= $nuevaLinea->mueveDerecha($dato);
            list ($x1, $y1, $x2, $y2)=$info;
            echo "desplazar hacia la derecha (x1,y1): (".$x1." ".$y1.")  (x2,y2): (".$x2." ".$y2. ")\n";
            break;
        case 2:
            echo "Ingrese el valor: ";
            $dato = (int) trim(fgets(STDIN));
             $info= $nuevaLinea->mueveIzquierda($dato);
            list ($x1, $y1, $x2, $y2)=$info;
            echo "desplazar hacia la izquirda (x1,y1): (".$x1." ".$y1.")  (x2,y2): (".$x2." ".$y2. ")\n";
            break;
        case 3:
            echo "Ingrese el valor: ";
            $dato = (int) trim(fgets(STDIN));
            $info= $nuevaLinea->mueveArriba($dato);
            list ($x1, $y1, $x2, $y2)=$info;
            echo "desplazar hacia la arriba (x1,y1): (".$x1." ".$y1.")  (x2,y2): (".$x2." ".$y2. ")\n";
            break;
        case 4:
            echo "Ingrese el valor: ";
            $dato = (int) trim(fgets(STDIN));
            $info= $nuevaLinea->mueveAbajo($dato);
            list ($x1, $y1, $x2, $y2)=$info;
            echo "desplazar hacia la abajo (x1,y1): (".$x1." ".$y1.")  (x2,y2): (".$x2." ".$y2. ")\n";
            break;
    }
} while ($opcion != 0);

?>