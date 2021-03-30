<?php

include 'Cafetera.php';


function menu()
{
    /**
     * Declaracion de variables
     * int $opcion
     */

    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "--------------------------------------------------------------\n";
    echo "1) LLenar la cafetera. \n";
    echo "2) Servir Cafe. \n";
    echo "3) Vaciar la Cafetera.  \n";
    echo "4) Completar la cafetera.  \n";
    echo "0) Apagar cafetera. \n";
    echo "--------------------------------------------------------------\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}


$Cafetera = new Cafetera(2000, 1500);

do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Apagando cafetera! \n";
            break;
        case 1:
            echo $Cafetera->llenarCafetera()."\n";
            break;
        case 2:
            echo $Cafetera->servirTaza(480). "\n";
            break;
        case 3:
            echo $Cafetera->vaciarcafetera(). "\n";
            break;
        case 4:
            $faltaCafe= $Cafetera->getCantidadActual();

           echo "La cafetera posee  la cantida de Cafe: ".$faltaCafe." ml \n";
           if ($faltaCafe <$Cafetera->getCapacidadMaxima()){
             $faltaCafe= $Cafetera->getCapacidadMaxima() - $Cafetera->getCantidadActual();
            echo $Cafetera->agregarCafe($faltaCafe);
            }
            break;
    }
} while ($opcion != 0);

echo $Cafetera;
?>
