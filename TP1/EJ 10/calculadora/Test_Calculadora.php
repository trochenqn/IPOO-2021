<?php
include 'Calculadora.php';

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "--------------------------------------------------------------\n";
    echo "1) Sumar. \n";
    echo "2) Restar. \n";
    echo "3) Dividir. \n";
    echo "4) Multiplicar. \n";
    echo "0) Salir. \n";
    echo "--------------------------------------------------------------\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

$valorIngrado = new Calculadora(4,5);
echo "valor ingresado:  ".$valorIngrado."\n";

    do {
           
        $opcion = menu();
        switch ($opcion) {
            case 0:
                echo "EXIT! \n";
                break;
            case 1:
               echo  "resultado de la suma:  ".$valorIngrado->suma(). "\n";
                break;
            case 2:
                echo "resultado de la resta:  ".$valorIngrado->restar(). "\n";
                break;
            case 3:
               echo  "resultado de la dividision:  ".$valorIngrado->dividir(). "\n";
                break;
            case 4:
                echo "resultado de la multiplicacion:  ". $valorIngrado->multiplicar(). "\n";
                break;    
        }
    } while ($opcion != 0);

?>
