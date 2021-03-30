<?php
include 'CuentaBancaria.php';

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "*********************************************\n";
    echo "1) Actualizar Saldo. \n";
    echo "2) Depositar dinero. \n";
    echo "3) Retirar dinero. \n";
    echo "0) Salir. \n";
    echo "**********************************************\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

$CuentaBancaria = new CuentaBancaria(00001542, 27444222, 80400, 35);
do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "EXIT ! \n";
            break;
        case 1:
            echo $CuentaBancaria->actualizarSaldo()." \n";
            break;
        case 2:
            echo $CuentaBancaria->depositar(450)." \n";
            break;
        case 3:
            echo $CuentaBancaria->retirar(800)." \n";
            break;
    }
} while ($opcion != 0);

echo $CuentaBancaria;

?>