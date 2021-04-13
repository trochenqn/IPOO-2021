<?php
include_once 'Persona.php';

function mainPersona()
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
    do {
        echo "Eliga a la persona\n";
        $i=0;
        foreach($arregloPersonas as $item){
            $i++;
            $cadena= $i."-".$item->getNombre()."  ".$item->getApellido()."\n";
            echo $cadena;
        }
        $aux = trim(fgetc(STDIN));
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
    }while ($aux> 5 && $aux<=0);

    echo $test_pers;

}


mainPersona();




?>