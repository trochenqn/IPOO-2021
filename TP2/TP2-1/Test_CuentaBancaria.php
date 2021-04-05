<?php
include_once 'CuentaBancaria.php';
include_once 'Persona.php';

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "*********************************************\n";
    echo "1) Elige el titular de la cuenta. \n";
    echo "2) Actualizar Saldo. \n";
    echo "3) Depositar dinero. \n";
    echo "4) Retirar dinero. \n";
    echo "5) Salir. \n";
    echo "**********************************************\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

function banco()
{
    $person1 = new Persona("ADRIANA CAROLINA", "HERNANDEZ MONTERROZA", "DNI", "215458825");
    $person2 = new Persona("ADRIANA MARCELA ", "REY SANCHEZ", "DNI", "1587754878");
    $person3 = new Persona("ALEJANDRO", "ABONDANO ACEVEDO", "DNI", "295584775");
    $person4 = new Persona("CAMILO", "POLO CASTELLANOS ", "DNI", "274988758");
    $person5 = new Persona("MARIA NATALIA", "CERVANTES LUNA", "DNI", "2587588");
    $test_pers = $person1;
    $arregloPersonas = array(
        $person1, $person2, $person3, $person4, $person5
    );

    $testCuenta = new CuentaBancaria(12548,$test_pers,548777,35);
   
  
    do {
    
        $opcion = menu();
    
        switch ($opcion) {
            case 1:
                do {
                    echo "Eliga a la persona\n";
                    $i=0;
                    foreach($arregloPersonas as $item){
                        $i++;
                        $cadena= $i."-".$item->getNombre()."  ".$item->getApellido()."\n";
                        echo $cadena;
                    }
                    $aux = trim(fgetc(STDIN));
                 if ($aux <= 5 && $aux > 0) {
                    switch($aux){
                        case 1:
                            $test_pers= $person1;
                      
                            break;
                        case 2:
                            $test_pers= $person2;
                
                            break;
                        case 3:
                            $test_pers= $person3;
                    
                            break;
                        case 4:
                            $test_pers= $person4;
                         
                           break;
                        case 5:
                            $test_pers= $person5;
                           
                            break;
                      }
                    }
                }while ($aux > 5 && $$aux <= 0);
               $testCuenta->setClienteDni($test_pers);
               break;
    
            case 2:
                echo $testCuenta->actualizarSaldo()." \n";
                break;
            case 3:
                echo $testCuenta->depositar(450)." \n";
                break;
            case 4:
                echo $testCuenta->retirar(800)." \n";
                break;
        }
    } while ($opcion != 5);
    


  
    echo $testCuenta;

}

banco();



?>