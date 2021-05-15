<?php
include 'Teatro.php';
include 'Funciones.php';
include 'teatroCine.php';
include 'teatroMusicales.php';

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo ">>>>>>>>>>>>>>>>>>>>--MENU-----<<<<<<<<<<<<<<<<<<<<<\n";
    echo "1) Cargar Funcion del teatro. \n";
    echo "2) Cambiar Nombre del Teatro y la Direccion. \n";
    echo "3) Modificar Funcion del dia. \n";
    echo "4) visualizar funciones. \n";
    echo "5) dar costo de las funciones. \n";
    echo "6) Borrar Funciones. \n";
    echo "0) Salir. \n";
    echo "***************************************************\n";

    // Ingreso la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

$funcion1 = new Funciones("macana", ["hs" => "21", "min" => "00"], ["hs" => "0", "min" => "50"], 1500);
$funcion2 = new Funciones("la chica de la culpa", ["hs" => "22", "min" => "00"], ["hs" => "1", "min" => "0"], 1750);
$funcion3 = new Funciones("la travesia", ["hs" => "23", "min" => "00"], ["hs" => "0", "min" => "30"], 250);
$funcion4 = new Funciones("lo escucho", ["hs" => "0", "min" => "10"], ["hs" => "1", "min" => "10"], 520);

$arregloFunciones = array(
    $funcion1,   $funcion2,   $funcion3,   $funcion4,
);

$nuevoTeatro = new Teatro("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones);
$nuevoTeatroCine = new teatroCine("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones, "humor", "argentina");
$nuevoTeatroMusical = new teatroMusicales("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones, "martin perez", 20);

/*
$nuevoTeatro = new Teatro("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones = array());
$nuevoTeatroCine = new teatroCine("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones = array(), "humor", "argentina");
$nuevoTeatroMusical = new teatroMusicales("El Nacional", "Avenida Corrientes, Buenos Aires", $arregloFunciones = array(), "martin perez", 20);
*/
do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            break;
        case 1: //Cargar Funcion del teatro

            echo "Donde desea cargar la Funcion: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $tipoSeleccion = trim(fgets(STDIN));
            if ($tipoSeleccion == 'a') {

                if (is_a($nuevoTeatro, 'Teatro')) {
                    $arrayFuncion = $nuevoTeatro->getcolObjFuncion();
                    $i = count($arrayFuncion);

                    while ($i <= 3) {
                        echo " (*) Ingrese el nombre de la Funcion: \n";
                        $nombreFuncion = trim(fgets(STDIN));
                        echo " (*) Ingrese la hora de inicio de la funcion :\n";
                        $horarioInicio =  $nuevoTeatro->corroborarHorario();
                        //verificar el horario de la funcion antes de ingresar al sistema
                        $resp = $nuevoTeatro->verificarHorarioFuncion($horarioInicio);
                        list($A, $hora) = $resp;

                        if ($A == TRUE) {
                            echo "se cargo con exito\n";
                        } else {
                            $hsCargado = $hora["hs"];
                            $minCargado = $hora["min"];
                            echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                            $horarioInicio =  $nuevoTeatro->corroborarHorario();
                        }
                        echo " (*) Ingrese la duracion de la obra: \n";
                        $duracionObra =  $nuevoTeatro->corroborarHorario();
                        echo " (*) Ingrese el precio de la Funcion: \n";
                        $precio = (int)trim(fgets(STDIN));

                        echo $nuevoTeatro->cargarFuncion($nombreFuncion, $horarioInicio, $duracionObra, $precio) . "\n";

                        $i++;
                    }
                }
            } elseif ($tipoSeleccion == 'b') {
                if (is_a($nuevoTeatroCine, 'teatroCine')) {
                    //aca ser cargan el teatro la opcion cine
                    $arrayFuncion = $nuevoTeatroCine->getcolObjFuncion();
                    $i = count($arrayFuncion);

                    while ($i <= 3) {
                        echo " (*) Ingrese el nombre de la Funcion: \n";
                        $nombreFuncion = trim(fgets(STDIN));
                        echo " (*) Ingrese la hora de inicio de la funcion :\n";
                        $horarioInicio =  $nuevoTeatroCine->corroborarHorario();
                        //verificar el horario de la funcion antes de ingresar al sistema
                        $resp = $nuevoTeatroCine->verificarHorarioFuncion($horarioInicio);
                        list($A, $hora) = $resp;

                        if ($A == TRUE) {
                            echo "se cargo con exito\n";
                        } else {
                            $hsCargado = $hora["hs"];
                            $minCargado = $hora["min"];
                            echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                            $horarioInicio =  $nuevoTeatroCine->corroborarHorario();
                        }
                        echo " (*) Ingrese la duracion de la obra: \n";
                        $duracionObra =  $nuevoTeatroCine->corroborarHorario();
                        echo " (*) Ingrese el precio de la Funcion: \n";
                        $precio = (int)trim(fgets(STDIN));
                        echo " (*) Ingrese el genero: \n";
                        $genero = trim(fgets(STDIN));
                        echo " (*) Ingrese el pais de origen: \n";
                        $paisOrigen = trim(fgets(STDIN));

                        echo $nuevoTeatroCine->cargarFuncionCine($nombreFuncion, $horarioInicio, $duracionObra, $precio,  $genero,  $paisOrigen) . "\n";

                        $i++;
                    }
                }
            } else {
                if (is_a($nuevoTeatroMusical, 'teatroMusicales')) {
                    $arrayFuncion = $nuevoTeatro->getcolObjFuncion();
                    $i = count($arrayFuncion);

                    while ($i <= 3) {
                        echo " (*) Ingrese el nombre de la Funcion: \n";
                        $nombreFuncion = trim(fgets(STDIN));
                        echo " (*) Ingrese la hora de inicio de la funcion :\n";
                        $horarioInicio =  $nuevoTeatroMusical->corroborarHorario();
                        //verificar el horario de la funcion antes de ingresar al sistema
                        $resp = $nuevoTeatroMusical->verificarHorarioFuncion($horarioInicio);
                        list($A, $hora) = $resp;

                        if ($A == TRUE) {
                            echo "se cargo con exito\n";
                        } else {
                            $hsCargado = $hora["hs"];
                            $minCargado = $hora["min"];
                            echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                            $horarioInicio =  $nuevoTeatroMusical->corroborarHorario();
                        }
                        echo " (*) Ingrese la duracion de la obra: \n";
                        $duracionObra =  $nuevoTeatroMusical->corroborarHorario();
                        echo " (*) Ingrese el precio de la Funcion: \n";
                        $precio = (int)trim(fgets(STDIN));
                        echo " (*) Ingrese el director: \n";
                        $director = trim(fgets(STDIN));
                        echo " (*) Ingrese la cantida de persona en escena: \n";
                        $personaEscenario = trim(fgets(STDIN));

                        echo $nuevoTeatroMusical->cargarFuncionTeatro($nombreFuncion, $horarioInicio, $duracionObra, $precio, $director, $personaEscenario) . "\n";

                        $i++;
                    }
                }
            }



            break;
        case 2: //Cambiar Nombre del Teatro y la Direccion.


            echo "Donde desea cambair el nombre del Teatro: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $tipoSeleccion = trim(fgets(STDIN));
            if ($tipoSeleccion == 'a') {

                if (is_a($nuevoTeatro, 'Teatro')) {
                     echo "\n Desea cambiar el nombre el nombre del teatro: " . $nuevoTeatro->getNombreTeatro() . " -SI/NO- \n";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if ($resp === "SI") {
                        echo "\n Ingresar la nombre del teatro:  ";
                        $nombreDelTeatro = trim(fgets(STDIN));

                        //---------------
                        echo "\n Desea cambiar la direccion del teatro:" . $nuevoTeatro->getDirecionTeatro() . "-SI/NO- \n";
                        $resp = strtoupper(trim(fgets(STDIN)));
                        if ($resp === "SI") {
                            echo "\n Ingresar la direccion del teatro:  ";
                            $direccionDelTeatro = trim(fgets(STDIN));
                        } else {
                            $direccionDelTeatro = null;
                        }
                    } else {
                        $nombreDelTeatro = null;
                        echo "\n Desea cambiar la direccion del teatro:" . $nuevoTeatro->getDirecionTeatro() . "-SI/NO- \n";
                        $resp = strtoupper(trim(fgets(STDIN)));
                        if ($resp === "SI") {
                            echo "\n Ingresar la direccion del teatro:  ";
                            $direccionDelTeatro = trim(fgets(STDIN));
                        } else {
                            $direccionDelTeatro = null;
                        }
                    }
                    echo $nuevoTeatro->cambiarNombreTeatro_direccion($nombreDelTeatro,  $direccionDelTeatro) . "\n";
                }
            } elseif ($tipoSeleccion == 'b') {
                if (is_a($nuevoTeatroCine, 'teatroCine')) {
                    //aca ser cargan el teatro la opcion cine
                    echo "\n Desea cambiar el nombre el nombre del teatro: " . $nuevoTeatroCine->getNombreTeatro() . " -SI/NO- \n";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if ($resp === "SI") {
                        echo "\n Ingresar la nombre del teatro:  ";
                        $nombreDelTeatro = trim(fgets(STDIN));

                        //---------------
                        echo "\n Desea cambiar la direccion del teatro:" . $nuevoTeatroCine->getDirecionTeatro() . "-SI/NO- \n";
                        $resp = strtoupper(trim(fgets(STDIN)));
                        if ($resp === "SI") {
                            echo "\n Ingresar la direccion del teatro:  ";
                            $direccionDelTeatro = trim(fgets(STDIN));
                        } else {
                            $direccionDelTeatro = null;
                        }
                    } else {
                        $nombreDelTeatro = null;
                        echo "\n Desea cambiar la direccion del teatro:" . $nuevoTeatroCine->getDirecionTeatro() . "-SI/NO- \n";
                        $resp = strtoupper(trim(fgets(STDIN)));
                        if ($resp === "SI") {
                            echo "\n Ingresar la direccion del teatro:  ";
                            $direccionDelTeatro = trim(fgets(STDIN));
                        } else {
                            $direccionDelTeatro = null;
                        }
                    }
                    echo $nuevoTeatroCine->cambiarNombreTeatro_direccion($nombreDelTeatro,  $direccionDelTeatro) . "\n";
                }
            } else {
                if (is_a($nuevoTeatroMusical, 'teatroMusicales')) {
                    //aca ser cargan el teatro la opcion cine
                    echo "\n Desea cambiar el nombre el nombre del teatro: " . $nuevoTeatroMusical->getNombreTeatro() . " -SI/NO- \n";
                    $resp = strtoupper(trim(fgets(STDIN)));
                    if ($resp === "SI") {
                        echo "\n Ingresar la nombre del teatro:  ";
                        $nombreDelTeatro = trim(fgets(STDIN));

                        //---------------
                        echo "\n Desea cambiar la direccion del teatro:" . $nuevoTeatroMusical->getDirecionTeatro() . "-SI/NO- \n";
                        $resp = strtoupper(trim(fgets(STDIN)));
                        if ($resp === "SI") {
                            echo "\n Ingresar la direccion del teatro:  ";
                            $direccionDelTeatro = trim(fgets(STDIN));
                        } else {
                            $direccionDelTeatro = null;
                        }
                    } else {
                        $nombreDelTeatro = null;
                        echo "\n Desea cambiar la direccion del teatro:" . $nuevoTeatroMusical->getDirecionTeatro() . "-SI/NO- \n";
                        $resp = strtoupper(trim(fgets(STDIN)));
                        if ($resp === "SI") {
                            echo "\n Ingresar la direccion del teatro:  ";
                            $direccionDelTeatro = trim(fgets(STDIN));
                        } else {
                            $direccionDelTeatro = null;
                        }
                    }
                    echo $nuevoTeatroMusical->cambiarNombreTeatro_direccion($nombreDelTeatro,  $direccionDelTeatro) . "\n";
                }
            }


            break;

        case 3:

            
            echo "Donde desea cambiar el nombre del Teatro: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $tipoSeleccion = trim(fgets(STDIN));
            if ($tipoSeleccion == 'a') {
               //>>>>>>>>>>>>>>>>>>>>>>>>>>>>> aca arranca a <<<<<<<<<<<<<<<<<<<<<<<<<<
                if (is_a($nuevoTeatro, 'Teatro')) {
                    echo "Desea modificar una funcion (A) o todos (B): \n";
                    $modificacion = strtoupper(trim(fgets(STDIN)));
        
                    if ($modificacion === "A") {
                        echo " (*) Ingrese el turno a modificar -0, 1, 2 o 3- \n";
                        $turno = (int) trim(fgets(STDIN));
                        echo " (*) Ingrese el nombre de la Funcion: \n";
                        $nombreFuncion = trim(fgets(STDIN));
                        echo " (*) Ingrese la hora de inicio de la funcion :\n";
                        $horarioInicio =  $nuevoTeatro->corroborarHorario();
                        //verificar el horario de la funcion antes de ingresar al sistema
                        $resp = $nuevoTeatro->verificarHorarioFuncion($horarioInicio);
                        list($A, $hora) = $resp;
                        if ($A == TRUE) {
                            echo "se cargo con exito\n";
                        } else {
                            $hsCargado = $hora[0];
                            $minCargado = $hora[1];
                            echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                            $horarioInicio =  $nuevoTeatro->corroborarHorario();
                        }
                        echo " (*) Ingrese la duracion de la obra: \n";
                        $duracionObra =  $nuevoTeatro->corroborarHorario();
                        echo " (*) Ingrese el precio de la Funcion: \n";
                        $precio = (int)trim(fgets(STDIN));
        
                        $nuevoTeatro->modificarFuncion_precio($modificacion, $turno, $nombreFuncion, $horarioInicio, $duracionObra, $precio) . "\n";
                    } else {
                        $i = 0;
                        while ($i <= 3) {
                            echo " (*) Ingrese el nombre de la funcion a modificar->" . $i . " \n";
                            $nombreFuncion = trim(fgets(STDIN));
                            echo " (*) Ingrese la hora de inicio de la funcion ->" . $i . " \n";
        
                            $horarioInicio =    $nuevoTeatro->corroborarHorario();
                            //veerificar el horario de la funcion antes de ingresar al sistema
                            $resp = $nuevoTeatro->verificarHorarioFuncion($horarioInicio);
                            list($A, $hora) = $resp;
                            if ($A == TRUE) {
                                echo "se cargo con exito\n";
                            } else {
                                $hsCargado = $hora[0];
                                $minCargado = $hora[1];
                                echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                                $horarioInicio = $nuevoTeatro->corroborarHorario();
                            }
                            echo " (*) Ingrese la duracion de la obra->" . $i . " \n";
                            $duracionObra = $nuevoTeatro->corroborarHorario();
                            echo " (*) Ingrese el precio de la Funcion a modificar->" . $i . " \n";
                            $precioFuncion = trim(fgets(STDIN));
        
                            $nuevoTeatro->modificarFuncion_precio($modificacion, $i, $nombreFuncion,  $horarioInicio,  $duracionObra, $precioFuncion) . "\n";
                            $i++;
                        }
                    }
                }
            } elseif ($tipoSeleccion == 'b') {
                //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> aca arranca b <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
                if (is_a($nuevoTeatroCine, 'teatroCine')) {
                    //aca ser cargan el teatro la opcion cine
                    echo "Desea modificar una funcion (A) o todos (B): \n";
                    $modificacion = strtoupper(trim(fgets(STDIN)));
        
                    if ($modificacion === "A") {
                        echo " (*) Ingrese el turno a modificar -0, 1, 2 o 3- \n";
                        $turno = (int) trim(fgets(STDIN));
                        echo " (*) Ingrese el nombre de la Funcion: \n";
                        $nombreFuncion = trim(fgets(STDIN));
                        echo " (*) Ingrese la hora de inicio de la funcion :\n";
                        $horarioInicio =  $nuevoTeatroCine->corroborarHorario();
                        //verificar el horario de la funcion antes de ingresar al sistema
                        $resp = $nuevoTeatroCine->verificarHorarioFuncion($horarioInicio);
                        list($A, $hora) = $resp;
                        if ($A == TRUE) {
                            echo "se cargo con exito\n";
                        } else {
                            $hsCargado = $hora[0];
                            $minCargado = $hora[1];
                            echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                            $horarioInicio =  $nuevoTeatroCine->corroborarHorario();
                        }
                        echo " (*) Ingrese la duracion de la obra: \n";
                        $duracionObra =  $nuevoTeatroCine->corroborarHorario();
                        echo " (*) Ingrese el precio de la Funcion: \n";
                        $precio = (int)trim(fgets(STDIN));
        
                        $nuevoTeatroCine->modificarFuncion_precio($modificacion, $turno, $nombreFuncion, $horarioInicio, $duracionObra, $precio) . "\n";
                    } else {
                        $i = 0;
                        while ($i <= 3) {
                            echo " (*) Ingrese el nombre de la funcion a modificar->" . $i . " \n";
                            $nombreFuncion = trim(fgets(STDIN));
                            echo " (*) Ingrese la hora de inicio de la funcion ->" . $i . " \n";
        
        
                            $horarioInicio =    $nuevoTeatroCine->corroborarHorario();
                            //veerificar el horario de la funcion antes de ingresar al sistema
                            $resp = $nuevoTeatroCine->verificarHorarioFuncion($horarioInicio);
                            list($A, $hora) = $resp;
                            if ($A == TRUE) {
                                echo "se cargo con exito\n";
                            } else {
                                $hsCargado = $hora[0];
                                $minCargado = $hora[1];
                                echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                                $horarioInicio = $nuevoTeatroCine->corroborarHorario();
                            }
                            echo " (*) Ingrese la duracion de la obra->" . $i . " \n";
                            $duracionObra = $nuevoTeatroCine->corroborarHorario();
                            echo " (*) Ingrese el precio de la Funcion a modificar->" . $i . " \n";
                            $precioFuncion = trim(fgets(STDIN));
        
                            $nuevoTeatroCine->modificarFuncion_precio($modificacion, $i, $nombreFuncion,  $horarioInicio,  $duracionObra, $precioFuncion) . "\n";
                            $i++;
                        }
                    }
                }
            } else {
                if (is_a($nuevoTeatroMusical, 'teatroMusicales')) {
                    //>>>>>>>>>>>>>>>>>>>>>>>>> aca arranca c <<<<<<<<<<<<<<<<<<<<<<<<<<
                    //aca ser cargan el teatro la opcion cine
                    echo "Desea modificar una funcion (A) o todos (B): \n";
                    $modificacion = strtoupper(trim(fgets(STDIN)));
        
                    if ($modificacion === "A") {
                        echo " (*) Ingrese el turno a modificar -0, 1, 2 o 3- \n";
                        $turno = (int) trim(fgets(STDIN));
                        echo " (*) Ingrese el nombre de la Funcion: \n";
                        $nombreFuncion = trim(fgets(STDIN));
                        echo " (*) Ingrese la hora de inicio de la funcion :\n";
                        $horarioInicio =  $nuevoTeatroMusical->corroborarHorario();
                        //verificar el horario de la funcion antes de ingresar al sistema
                        $resp = $nuevoTeatroMusical->verificarHorarioFuncion($horarioInicio);
                        list($A, $hora) = $resp;
                        if ($A == TRUE) {
                            echo "se cargo con exito\n";
                        } else {
                            $hsCargado = $hora[0];
                            $minCargado = $hora[1];
                            echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                            $horarioInicio =  $nuevoTeatroMusical->corroborarHorario();
                        }
                        echo " (*) Ingrese la duracion de la obra: \n";
                        $duracionObra =  $nuevoTeatroMusical->corroborarHorario();
                        echo " (*) Ingrese el precio de la Funcion: \n";
                        $precio = (int)trim(fgets(STDIN));
        
                        $nuevoTeatroMusical->modificarFuncion_precio($modificacion, $turno, $nombreFuncion, $horarioInicio, $duracionObra, $precio) . "\n";
                    } else {
                        $i = 0;
                        while ($i <= 3) {
                            echo " (*) Ingrese el nombre de la funcion a modificar->" . $i . " \n";
                            $nombreFuncion = trim(fgets(STDIN));
                            echo " (*) Ingrese la hora de inicio de la funcion ->" . $i . " \n";
        
        
                            $horarioInicio =    $nuevoTeatroMusical->corroborarHorario();
                            //veerificar el horario de la funcion antes de ingresar al sistema
                            $resp = $nuevoTeatroMusical->verificarHorarioFuncion($horarioInicio);
                            list($A, $hora) = $resp;
                            if ($A == TRUE) {
                                echo "se cargo con exito\n";
                            } else {
                                $hsCargado = $hora[0];
                                $minCargado = $hora[1];
                                echo " (*) Ingrese la hora mayor a:" . $hsCargado . ":" . $minCargado . "\n";
                                $horarioInicio = $nuevoTeatroMusical->corroborarHorario();
                            }
                            echo " (*) Ingrese la duracion de la obra->" . $i . " \n";
                            $duracionObra = $nuevoTeatroMusical->corroborarHorario();
                            echo " (*) Ingrese el precio de la Funcion a modificar->" . $i . " \n";
                            $precioFuncion = trim(fgets(STDIN));
        
                            $nuevoTeatroMusical->modificarFuncion_precio($modificacion, $i, $nombreFuncion,  $horarioInicio,  $duracionObra, $precioFuncion) . "\n";
                            $i++;
                        }
                    }
                }
            }
           
            break;
        case 4:
          
            echo "que funcion desea visualizar: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $tipoSeleccion = trim(fgets(STDIN));
            if ($tipoSeleccion == 'a') {
                echo    $nuevoTeatro . "\n";
            } elseif ($tipoSeleccion == 'b') {
                echo   $nuevoTeatroCine. "\n";
            } elseif ($tipoSeleccion == 'c') {
                echo $nuevoTeatroMusical . "\n";
            }

           break;
        case 5: //dar costo funcion 
            echo "selecciones la opcion al cual desea visualizar el costo: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $tipoSeleccion = trim(fgets(STDIN));
            if ($tipoSeleccion == 'a') {
                echo  "El costo de la funcion para el mes es:" .   $nuevoTeatro->darCosto() . "\n";
            } elseif ($tipoSeleccion == 'b') {
                echo "El costo de la funcion para el mes es:" . $nuevoTeatroCine->darCosto() . "\n";
            } elseif ($tipoSeleccion == 'c') {
                echo "El costo de la funcion para el mes es:" . $nuevoTeatroMusical->darCosto() . "\n";
            }

            break;
        case 6: //borrar las funciones
            echo "selecciones la opcion a borrar: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $tipoSeleccion = trim(fgets(STDIN));
            if ($tipoSeleccion == 'a') {
                echo $nuevoTeatro->borrarFunciones() . "\n";
            } elseif ($tipoSeleccion == 'b') {
                echo $nuevoTeatroCine->borrarFunciones() . "\n";
            } elseif ($tipoSeleccion == 'c') {
                echo $nuevoTeatroMusical->borrarFunciones() . "\n";
            }

            break;
    }
} while ($opcion != 0);
