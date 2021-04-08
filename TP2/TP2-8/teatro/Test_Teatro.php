<?php
include 'Teatro.php';
include_once 'Funciones.php';

function menu()
{
     /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo ">>>>>>>>>>>>>>>>>>>>--MENU-----<<<<<<<<<<<<<<<<<<<<<\n";
    echo "1) Cambiar Nombre del Teatro y la Direccion. \n";
    echo "2) Cargar Funcion del teatro. \n";
    echo "3) Modificar Funcion del dia. \n";
    echo "4) visualizar funciones. \n";
    echo "5) Borrar Funciones. \n";
    echo "0) Salir. \n";
    echo "***************************************************\n";

    // Ingreso la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

$funcion1 = new Funciones("macana", ["hs"=>"21", "min"=>"00"], ["hs"=>"0", "min"=>"50"], "1500");

$arregloFunciones = array(
    $funcion1,
);
    
$nuevoTeatro = new Teatro("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones);

do{
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            break;
        case 1: //Cambiar Nombre del Teatro y la Direccion.
          
            echo "\n Desea cambiar el nombre el nombre del teatro: ".$nuevoTeatro->getNombreTeatro(). " -SI/NO- \n";
            $resp= strtoupper(trim(fgets(STDIN)));
            if ($resp==="SI"){
                echo "\n Ingresar la direccion del teatro:  ";
            $nombreDelTeatro = trim(fgets(STDIN));

             //---------------
             echo "\n Desea cambiar la direccion del teatro:".$nuevoTeatro->getNombreTeatro(). "-SI/NO- \n";
             $resp= strtoupper(trim(fgets(STDIN)));
             if ($resp==="SI"){
                 echo "\n Ingresar la direccion del teatro:  ";
                 $direccionDelTeatro = trim(fgets(STDIN));
             }else{
                $direccionDelTeatro =$nuevoTeatro->getDirecionTeatro();
             }

           
            }  else{
                $nombreDelTeatro = $nuevoTeatro->getNombreTeatro();
                echo "\n Desea cambiar la direccion del teatro:".$nuevoTeatro->getNombreTeatro(). "-SI/NO- \n";
                $resp= strtoupper(trim(fgets(STDIN)));
                if ($resp==="SI"){
                    echo "\n Ingresar la direccion del teatro:  ";
                    $direccionDelTeatro = trim(fgets(STDIN));
                }
            }  
            
           
           echo $nuevoTeatro->cambiarNombreTeatro_direccion( $nombreDelTeatro,  $direccionDelTeatro). "\n";
            break;
        case 2: //Cargar Funcion del teatro
                          
            $arrayFuncion= $nuevoTeatro->getcolObjFuncion();  
            $i= count($arrayFuncion);
             
            while ($i <=3){
                echo " (*) Ingrese el nombre de la Funcion: \n";
                $nombreFuncion = trim(fgets(STDIN));
                echo " (*) Ingrese la hora de inicio de la funcion :\n";
                $horarioInicio = corroborarHorario();
                 //verificar el horario de la funcion antes de ingresar al sistema
                $resp= $nuevoTeatro->verificarHorarioFuncion($horarioInicio);
                list($A, $hora)= $resp;
               if ($A==TRUE){
                    echo "se cargo con exito\n";
               }else{
                $hsCargado = $hora[0];
                $minCargado= $hora[1];
                echo " (*) Ingrese la hora mayor a:". $hsCargado.":".$minCargado."\n";
                $horarioInicio = corroborarHorario();
               }
                echo " (*) Ingrese la duracion de la obra: \n";
                $duracionObra = corroborarHorario();
                echo " (*) Ingrese el precio de la Funcion: \n";
                $precio = (int)trim(fgets(STDIN));
               
               echo $nuevoTeatro->cargarFuncion($nombreFuncion,$horarioInicio, $duracionObra, $precio)."\n";
               
                $i++;
            }
            break;
        case 3:
            echo "Desea modificar una funcion (A) o todos (B): \n";
            $modificacion = strtoupper(trim(fgets(STDIN)));
          
            if ($modificacion==="A"){
                echo " (*) Ingrese el turno a modificar -0, 1, 2 o 3- \n"; 
                $turno = (int) trim(fgets(STDIN));
                echo " (*) Ingrese el nombre de la Funcion: \n";
                $nombreFuncion = trim(fgets(STDIN));
                echo " (*) Ingrese la hora de inicio de la funcion :\n";
                $horarioInicio = corroborarHorario();
                 //verificar el horario de la funcion antes de ingresar al sistema
                 $resp= $nuevoTeatro->verificarHorarioFuncion($horarioInicio);
                 list($A, $hora)= $resp;
                if ($A==TRUE){
                     echo "se cargo con exito\n";
                }else{
                 $hsCargado = $hora[0];
                 $minCargado= $hora[1];
                 echo " (*) Ingrese la hora mayor a:". $hsCargado.":".$minCargado."\n";
                 $horarioInicio = corroborarHorario();
                }
                 echo " (*) Ingrese la duracion de la obra: \n";
                 $duracionObra = corroborarHorario();
                 echo " (*) Ingrese el precio de la Funcion: \n";
                 $precio = (int)trim(fgets(STDIN));

                $nuevoTeatro->modificarFuncion_precio($modificacion, $turno,$nombreFuncion, $horarioInicio, $duracionObra, $precio)."\n";
                
            }else{
                $i=0;
                while($i<=3){
                echo " (*) Ingrese el nombre de la funcion a modificar->". $i ." \n";
                $nombreFuncion = trim(fgets(STDIN));
                echo " (*) Ingrese la hora de inicio de la funcion ->". $i ." \n";
                $horarioInicio = corroborarHorario();
                 //veerificar el horario de la funcion antes de ingresar al sistema
                 $resp= $nuevoTeatro->verificarHorarioFuncion($horarioInicio);
                 list($A, $hora)= $resp;
                if ($A==TRUE){
                     echo "se cargo con exito\n";
                }else{
                 $hsCargado = $hora[0];
                 $minCargado= $hora[1];
                 echo " (*) Ingrese la hora mayor a:". $hsCargado.":".$minCargado."\n";
                 $horarioInicio = corroborarHorario();
                }
                 echo " (*) Ingrese la duracion de la obra->". $i ." \n";
                 $duracionObra = corroborarHorario();
                echo " (*) Ingrese el precio de la Funcion a modificar->". $i ." \n";
                $precioFuncion = trim(fgets(STDIN));

                $nuevoTeatro->modificarFuncion_precio($modificacion, $i,$nombreFuncion,  $horarioInicio,  $duracionObra, $precioFuncion ) ."\n";
                $i++;
                }
            }
            break;
        case 4:
            echo $nuevoTeatro; 
            break;
        case 5://borrar las funciones
            echo $nuevoTeatro->borrarFunciones()."\n"; 
            break;
    }
} while ($opcion != 0);



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