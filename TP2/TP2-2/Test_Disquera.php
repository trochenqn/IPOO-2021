<?php

include_once 'Disquera.php';
include_once 'Persona.php';

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "*********************************************\n";
    echo "1) Agregar un dueño a la disquetera. \n";
    echo "2) Abrir disquetera. \n";
    echo "3) Cerrar disquetera. \n";
    echo "4) Verificar si la disquetera esta abierto. \n";
    echo "5) Mostrar Informacion de la diquetera. \n";
    echo "6) Salir. \n";
    echo "**********************************************\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

function disquera()
{
    $dueño1 = new Persona("ADRIANA CAROLINA", "HERNANDEZ MONTERROZA", "DNI", "215458825");
    $dueño2 = new Persona("MARIA NATALIA", "CERVANTES LUNA", "DNI", "2587588");
    $test_pers = $dueño1;
    $arregloDueño = array(
        $dueño1, $dueño2
    );
   $disquetera = new Disquera(["hs"=>"07", "min"=>"45"],["hs"=>"18", "min"=>"30"], TRUE,"av. argentina nro 800-Neuquen", $test_pers);
   
   
    do {
    
        $opcion = menu();
    
        switch ($opcion) {
            case 1:
                do {
                    echo "Eliga a la persona\n";
                    $i=0;
                    foreach($arregloDueño as $item){
                        $i++;
                        $cadena= $i."-".$item->getNombre()."  ".$item->getApellido()."\n";
                        echo $cadena;
                    }
                    $aux = trim(fgetc(STDIN));
                 if ($aux <= 5 && $aux > 0) {
                    switch($aux){
                        case 1:
                            $test_pers= $dueño1;
                            break;
                        case 2:
                            $test_pers= $dueño2;
                            break;
                       
                      }
                    }
                }while ($aux > 2 && $$aux <= 0);
               $disquetera->setDuenio($test_pers);
               break;
    
            case 2:
                //abrir la disquetera
                $hsCarga = corroborarHorario();
                echo $disquetera->abrirDisquera($hsCarga["hs"], $hsCarga["min"]);
                break;
            case 3:
                //cerrar  disquetera
                $hsCarga = corroborarHorario();
                echo $disquetera->cerrarDisquetera($hsCarga["hs"], $hsCarga["min"]);
                break;
            case 4:
                //se verifica si la disquetera esta abierta
                $hsCarga = corroborarHorario();
                $resp= $disquetera->dentroHorarioAtencion($hsCarga["hs"], $hsCarga["min"]);
                if ($resp){
                    echo "La disquetea esta abierto !! \n";
                }else{
                    echo "La disquetera no se encuetra abierto \n";
                }
                
                break;
            case 5:
                //mostrar la informacion de la disquetera
                  echo    $disquetera;
                break;
        }
    } while ($opcion != 6);
    
}

disquera();

function corroborarHorario()
{
    do {
        $bandera = true; 
        echo "Ingrese la Horas:\n";
        $horas = trim(fgets(STDIN));
        if (is_numeric($horas) && $horas >= 0 && $horas <= 23) {
            echo "Ingrese los Minutos:\n";
            $minutos = trim(fgets(STDIN));
            if (is_numeric($minutos) && $minutos >= 0 && $minutos <= 59) {
                $bandera = false; 
                $horario = ["hs" => $horas,"min" => $minutos];
               
            } else {
                echo "los minutos no son validos \n";
            }
        } else {
            echo "horas no es valida \n";
        }
    } while ($bandera);
    return $horario;
}

?>