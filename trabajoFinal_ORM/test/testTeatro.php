<?php
include "../datos/BaseDatos.php";
include "../datos/funcion.php";
include "../datos/obracine.php";
include "../datos/obramusical.php";
include "../datos/obrateatro.php";
include "../datos/teatro.php";

main();
function main()
{
    $nuevoteatro = cargarTeatro();

    do {
        menu();
        $continuar = opciones($nuevoteatro);
    } while ($continuar);
}

function cargarTeatro()
{
    $respuesta = false;
    do {
       /* $cadena = "   _  _\n";
        $cadena .= " (_\/_)\n";
        $cadena .= "(_>()<_)\n";
        $cadena .= " (_/\_)\n";
        $cadena .= "   ||\n";
        $cadena .= " |\||/|\n";
        $cadena .= "__\||/__\n";

        echo $cadena;*/

           $nuevoteatro = new Teatro();
        echo "DEASE INGRESAR UN NUEVO TEATRO (si/no)\n";
        echo "ingresar opcion: >>";
        $estado = trim(fgets(STDIN));
        if ($estado == "si") {
            echo "Ingrese el nombre del teatro: ";
            $nombre = trim(fgets(STDIN));
            echo "Ingrese la direccion del teatro: ";
            $direccion = trim(fgets(STDIN));
         
            //$teatro = new Teatro($nombre, $direccion);
            $nuevoteatro->cargar(0, $nombre, $direccion);
            $respuesta = $nuevoteatro->insertar();
            if ($respuesta == true) {
                echo "\nOP INSERCION;  de la funcion fue ingresada en la BD \n";
            } else {
                echo $nuevoteatro->getmensajeoperacion();
            }
        } else {
           
            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
                echo "SELECCIONES UN TEATRO DE LA LISTA: \n";

                foreach ($colTeatro as $unaTeatro) {
                    echo $unaTeatro . "\n";
                    echo "\n-------------------------------------------------------\n";
                }

                echo " (*) ingrese el nombre del teatro: \n";
                $nombreTeatro = trim(fgets(STDIN));
                $respuesta = $nuevoteatro->Buscar($nombreTeatro);
                if ($respuesta == true) {
                    echo "Usted ha selecciono el teatro: " . $nuevoteatro->getNombre() . "\n";
                } else {
                    echo "Vuelva a selecionar \n";
                }
            } else {
                echo "\e[41mNO HAY TEATROS CARGADOS, DEBERA INGRESAR UNO. \e[0m\n";
            }
        }
    } while ($respuesta != true);

    return $nuevoteatro;
}

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "\e[7m>>>>>>>>>>>>>>>>>>>>--MENU-----<<<<<<<<<<<<<<<<<<<<< \e[0m\n";
    echo "1) Listar los teatros. \n";
    echo "2) Seleccionar teatro. \n";
    echo "3) Cambiar Nombre del Teatro y la Direccion. \n";
    echo "4) Cargar Funcion del teatro. \n";
    echo "5) Modificar una Funcion. \n";
    echo "6) Listar funciones. \n";
    echo "7) Dar costo de las funciones. \n";
    echo "8) Borrar Funciones. \n";
    echo "9) Borrar el Teatro. \n";
    echo "0) Salir. \n";
    echo "***************************************************\n";
}

function opciones($nuevoteatro)
{

    $retorno = true;
    echo "\e[45mingresar opcion: >>\e[0m\n";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            $retorno = false;
            break;
        case 1:

            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
                foreach ($colTeatro as $unaFuncion) {

                    echo $unaFuncion;
                    echo "\n-------------------------------------------------------\n";
                }
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }

            break;
        case 2:
            //seleccionar un teatro

            $resp = cargarTeatro();
            menu();
            opciones($resp);
            break;
        case 3:

            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
                //Cambiar Nombre del Teatro y la Direccion.
                cambiarNombre_direccion($nuevoteatro);
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }


            break;
        case 4: //Cargar Funcion del teatro
            //"Donde desea cambiar el nombre del Teatro: Teatro (a), Teatro del Cine (b), Teatro Musicales (c):\n";
            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
                $respuesta = cargarfuncion($nuevoteatro);
                if ($respuesta == true) {
                    echo "\e[44mSe cargo con exito la funcion.\e[0m\n";
                } else {
                    echo "\e[1;101;92mError de carga.\e[0m\n";
                }
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }
            break;

        case 5:
            //modificar el tipo de funcion ?
            //selecciones el tipo de funcion del Teatro: obra Teatro (a), obra del Cine (b), obra Musical (c):\n";
            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
                modificarFuncion($nuevoteatro);
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }
            break;
        case 6:
            $colTeatro = $nuevoteatro->listar();
            $id  =  $nuevoteatro->getidteatro();
            //$nuevoteatro->BuscarId($id);
            $cond = $id;
            

            if (count($colTeatro) > 0) {

                echo "que funcion desea visualizar: Obra Teatro (a), Obra del Cine (b), Obra Musical (c):\n";
                $tipoSeleccion = trim(fgets(STDIN));
                if ($tipoSeleccion == 'a') {
                    $nuevaFuncion = new obrateatro();
                    $colrespuesta = $nuevaFuncion->listar($cond);

                    if (count($colrespuesta) > 0) {

                        foreach ($colrespuesta as $unaTeatro) {
                            echo $unaTeatro;
                            echo "\n-------------------------------------------------------\n";
                        }
                    } else {
                        echo "\e[1;101;92m\n\tNo hay regitros.\e[0m\n";
                    }
                } elseif ($tipoSeleccion == 'b') {
                    $nuevaFuncion = new obraCine();
                    $colrespuesta = $nuevaFuncion->listar($cond);

                    if (count($colrespuesta) > 0) {

                        foreach ($colrespuesta as $unaTeatro) {
                            echo $unaTeatro;
                            echo "\n-------------------------------------------------------\n";
                        }
                    } else {
                        echo "\e[1;101;92m\n\tNo hay regitros.\e[0m\n";
                    }
                } elseif ($tipoSeleccion == 'c') {
                    $nuevaFuncion = new obraMusical();
                    $colrespuesta = $nuevaFuncion->listar($cond);

                    if (count($colrespuesta) > 0) {

                        foreach ($colrespuesta as $unaTeatro) {
                            echo $unaTeatro;
                            echo "\n-------------------------------------------------------\n";
                        }
                    } else {
                        echo "\e[1;101;92m\n\tNo hay regitros.\e[0m\n";
                    }
                }
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }
            break;
        case 7: //dar costo funcion 

            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {

                //dos opciones 1: dar costo total y el otro, por tipo de obra teatro, cine o musical
                echo "\t█ Desea obtener el costo total de las funciones o de alguna obra, \n\t\t\t>>> seleccion opcion: (1: TOTAL - 2: DE LAS OBRAS)\n";
                $tipoSeleccion = trim(fgets(STDIN));
                if ($tipoSeleccion == 1) {

                    $costototal = $nuevoteatro->darCostos();
                    echo $costototal . "\n";
                } else {
                    echo "seleccione la opcion del cual desea visualizar el costo: obra de Teatro (a), obra del Cine (b), obra Musical (c):\n";
                    $tipoSeleccion = trim(fgets(STDIN));
                    if ($tipoSeleccion == 'a') {
                        $pruebateatro = new obrateatro();
                        echo  "\t╬ El costo de la obra del teatro es $:" .   $nuevoteatro->sumaFuncion($pruebateatro) . "\n";
                    } elseif ($tipoSeleccion == 'b') {
                        $pruebacine = new obracine();
                        echo "\t╬ El costo de la obra de cine es $:" .   $nuevoteatro->sumaFuncion($pruebacine) . "\n";
                    } elseif ($tipoSeleccion == 'c') {
                        $pruebamusical = new obramusical();
                        echo "\t╬ El costo de la obra musical es $:" .  $nuevoteatro->sumaFuncion($pruebamusical) . "\n";
                    }
                }
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }
            break;
        case 8: //remove las funciones
            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
                echo "selecciones la opcion a borrar: obra de Teatro (a), obra del Cine (b), Obra Musical (c):\n";
                $tipoSeleccion = trim(fgets(STDIN));
                if ($tipoSeleccion == 'a') {
                    $pruebateatro = new obrateatro();
                    echo $nuevoteatro->borrarFunciones($pruebateatro) . "\n";
                } elseif ($tipoSeleccion == 'b') {
                    $pruebacine = new obracine();
                    echo $nuevoteatro->borrarFunciones($pruebacine) . "\n";
                } elseif ($tipoSeleccion == 'c') {
                    $pruebamusical = new obramusical();
                    echo $nuevoteatro->borrarFunciones($pruebamusical) . "\n";
                }
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }
            break;

        case 9: //remove un teatro
            $colTeatro = $nuevoteatro->listar("");
            if (count($colTeatro) > 0) {
              $respuesta =  removeTeatro($nuevoteatro);
              echo $respuesta;
            } else {

                echo  "\e[1;101;92mNo existen registros de teatro, DEBE CARGAR UNO.\e[0m\n";
            }
            break;
        default:
            echo "\e[4;103;34m  >>>>> !Opcion invalida, por favor ingrese una opcion valida\e[0m\n";
    }

    return $retorno;
}

/*
$array_teatro = [
'id'=> "", 
'nombre_funcion'=> "",
'precio'=> "", 
'horario_inicio'=> "",
'duracion'=> '', 
'objTeatro'=> ""
];


$array_musical = [
    'id'=> "", 
    'nombre_funcion'=> "",
    'precio'=> "", 
    'horario_inicio'=> "",
    'duracion'=> '', 
    'objTeatro'=> "",
    'director'=>  "",
    'cantidadPersona' => "",
    ];

    $array_cine = [
        'id'=> "", 
        'nombre_funcion'=> "",
        'precio'=> "", 
        'horario_inicio'=> "",
        'duracion'=> '', 
        'objTeatro'=> "",
        'genero' => "",
        'paisorigen'=>"",
     ];
        
    */
#CASE NRO 2
function cargarfuncion($nuevoteatro)
{
    $array_teatro = [];
    $array_cine = [];
    $array_musical = [];
    $ok = false;
    $nuevoteatro->setarregloFunciones($array=[]);
    $nuevoteatro->getarregloFunciones();

    do {
        echo "Donde desea cargar la Funcion: obra de Teatro (a), obra del Cine (b), obra Musical (c):\n";
        $tipoSeleccion = trim(fgets(STDIN));
    } while ($tipoSeleccion != 'a' && $tipoSeleccion != 'b' && $tipoSeleccion != 'c');

    do {
        echo " (*) Ingrese el nombre de la Funcion: \n";
        $nombreFuncion = trim(fgets(STDIN));

        $existe = $nuevoteatro->existeFuncion($nombreFuncion);

        if ($existe <> -1) {
            echo "\e[41mLa funcion ya existe, debe ingresar otra !! \e[0m\n";
        }
    } while ($existe != -1);

    echo " (*) Ingrese el precio de la Funcion: \n";
    $precio = (int)trim(fgets(STDIN));
    echo "(*) Ingrese la hora de inicio de la funcion (hs:min): \n";
    $horarioInicio =  $nuevoteatro->corroborarHorario();
    echo "(*) Ingrese la duracion de la funcion (hs:min): \n";
    $duracion = $nuevoteatro->corroborarHorario();

    switch ($tipoSeleccion) {
        case 'a': //teatro
            $nuevaFuncion = new obrateatro();

            $array_teatro = [
                'id' => 0,
                'nombre_funcion' => $nombreFuncion,
                'precio' =>  $precio,
                'horario_inicio' => $horarioInicio,
                'duracion' => $duracion,
                'objTeatro' => $nuevoteatro,
            ];
            $tipoObra= "obrateatro";
            

            $errorSolapa = $nuevoteatro->controlSolapamiento($array_teatro, $tipoObra);

            while ($errorSolapa) {
                echo "\e[41mS>>> Se solapan las horas, ingrese un nuevo horario para la funcion (hs:min): \e[0m\n";
                $horaInicio =  $nuevoteatro->corroborarHorario();
                $array_teatro['horario_inicio'] = $horaInicio;

                $errorSolapa = $nuevoteatro->controlSolapamiento($array_teatro, $tipoObra);
            }

           // $nuevaFuncion->cargar($array_teatro);

            break;
        case 'b': //cine
            echo "(*) Ingrese el genero de la pelicula: \n";
            $genero = trim(fgets(STDIN));
            echo "(*) Ingrese el pais de origen de la pelicula: \n";
            $paisOrigen = trim(fgets(STDIN));
            $nuevaFuncion = new obraCine();


            $array_cine = [
                'id' => 0,
                'nombre_funcion' => $nombreFuncion,
                'precio' => $precio,
                'horario_inicio' => $horarioInicio,
                'duracion' => $duracion,
                'objTeatro' =>  $nuevoteatro,
                'genero' => $genero,
                'paisorigen' => $paisOrigen,
            ];
            $tipoCine= "obracine";

            $errorSolapa = $nuevoteatro->controlSolapamiento($array_cine,  $tipoCine);

            while ($errorSolapa) {
                echo "\e[41mS>>> Se solapan las horas, ingrese un nuevo horario para la funcion (hs:min): \e[0m\n";
                $horaInicio =  $nuevoteatro->corroborarHorario();
                $array_cine['horario_inicio'] = $horaInicio;

                $errorSolapa = $nuevoteatro->controlSolapamiento($array_cine,    $tipoCine);
            }

           // $nuevaFuncion->cargar($array_cine);
            break;
        case 'c': //musical
            echo "(*) Ingrese el nombre del director: \n";
            $director = trim(fgets(STDIN));
            echo "(*) Ingrese la cantidad de personas en escena: \n";
            $personaEscenario = trim(fgets(STDIN));
            $nuevaFuncion = new obraMusical();


            $array_musical = [
                'id' => 0,
                'nombre_funcion' => $nombreFuncion,
                'precio' => $precio,
                'horario_inicio' => $horarioInicio,
                'duracion' => $duracion,
                'objTeatro' =>  $nuevoteatro,
                'director' =>  $director,
                'cantidadPersona' => $personaEscenario,
            ];
            $tipoMusical= "obramusical";
            $errorSolapa = $nuevoteatro->controlSolapamiento($array_musical, $tipoMusical);

            while ($errorSolapa) {
                echo "\e[41mS>>> Se solapan las horas, ingrese un nuevo horario para la funcion (hs:min): \e[0m\n";
                $horaInicio =  $nuevoteatro->corroborarHorario();
                $array_musical['horario_inicio'] = $horaInicio;

                $errorSolapa = $nuevoteatro->controlSolapamiento($array_musical, $tipoMusical);
            }
           // $nuevaFuncion->cargar($array_musical);
            break;
    }

    //y aca se busca is_a() en que clase se carga la funcion insertar??
    if (is_a($nuevaFuncion, 'obrateatro')) {

        $arreglo = $nuevaFuncion->listar();
        if (count($arreglo) < 4) {

            $nuevaFuncion->cargar($array_teatro);
            $respuesta = $nuevaFuncion->insertar();
            $ok = $respuesta;
        } else {
            echo "╬ Ya se cargaron las 4 obras del teatro del dia\n";
        }
    } elseif (is_a($nuevaFuncion, 'obracine')) {

        $arreglo = $nuevaFuncion->listar();


        if (count($arreglo) < 4) {
            $nuevaFuncion->cargar($array_cine);
            $respuesta = $nuevaFuncion->insertar();
            $ok = $respuesta;
        } else {
            echo "╬ Ya se cargaron las 4  obras del cine del dia\n";
        }
    } elseif (is_a($nuevaFuncion, 'obramusical')) {
        $arreglo = $nuevaFuncion->listar();

        if (count($arreglo) < 4) {
            $nuevaFuncion->cargar($array_musical);
            $respuesta = $nuevaFuncion->insertar();
            $ok = $respuesta;
        } else {
            echo "╬ Ya se cargaron las 4 obras Musical del dia\n";
        }
    }

    return $ok;
}

#CASE NRO 3
function cambiarNombre_direccion($nuevoteatro)
{

    echo "SELECCIONE UN TEATRO DE LA LISTA: \n";
    $colTeatro = $nuevoteatro->listar("");
    foreach ($colTeatro as $unaTeatro) {

        echo $unaTeatro;
        echo "\n-------------------------------------------------------\n";
    }

    do {
        echo " (*) ingrese el nombre del teatro: \n";
        $nombreTeatro = trim(fgets(STDIN));
        $respuesta = $nuevoteatro->Buscar($nombreTeatro);
        if ($respuesta == true) {
            echo "Usted ha selecciono el teatro: " . $nuevoteatro->getNombre() . "\n";
        } else {
            echo "Vuelva a selecionar \n";
        }
    } while ($respuesta != true);


    echo "Ingrese el nuevo nombre del teatro: ";
    $nombre = trim(fgets(STDIN));
    echo "Desea cambiar la direccion (si/no).\n";
    $cambio = trim(fgets(STDIN));
    if ($cambio == "si") {
        echo "Ingrese la direccion del teatro: ";
        $direccion = trim(fgets(STDIN));
    } else {
        $direccion = $nuevoteatro->getDireccion();
    }
    //$teatro = new Teatro($nombre, $direccion);
    $nuevoteatro->cargar($nuevoteatro->getidteatro(), $nombre, $direccion);

    $respuesta = $nuevoteatro->modificar();
    if ($respuesta == true) {
        echo "\nOP MODIFICACION;  del teatro fue ingresada en la BD. \n";
    } else {
        echo $nuevoteatro->getmensajeoperacion();
    }
}

#CASE NRO 4
function modificarFuncion($nuevoteatro)
{
    echo "selecciones el tipo de funcion que desea modificar: obra Teatro (a), obra del Cine (b), obra Musical (c):\n";
    $tipoSeleccion = trim(fgets(STDIN));

    switch ($tipoSeleccion) {
        case ('a'):
            modificarObrateatro($nuevoteatro);
            break;
        case ('b'):
            modificarobracine($nuevoteatro);
            break;
        case ('c'):
            modificarobramusical($nuevoteatro);
            break;
    }
}

#funciones modificar  obra de teatro
function modificarObrateatro($nuevoteatro)
{

    //aca iria conexion BD para buscar
    $nuevaFuncion = new obrateatro();
    $colrespuesta = $nuevaFuncion->listar();

    if (count($colrespuesta) > 0) {

        foreach ($colrespuesta as $unaTeatro) {
            echo $unaTeatro;
            echo "\n-------------------------------------------------------\n";
        }

        //$nuevoteatro->setarregloFunciones($colrespuesta);
        $array_teatro = [];
        echo "Ingrese el id de la obra de la funcion obra de teatro que quiere cambiar: ";
        $funcionBuscada = trim(fgets(STDIN));

        $respuesta = $nuevaFuncion->Buscar($funcionBuscada);
        $idteatro = $nuevoteatro->getidteatro();
        //Retorno la posicion en que se encuentra la funcion
        $posFuncion = $nuevoteatro->existeFuncion($nuevaFuncion->getNombre());

        if ($posFuncion == -1) {
            echo "El nombre de funcion no se encuentra\n";
        } else {

            $arregloFunciones = $nuevoteatro->getarregloFunciones();

            $array_teatro =  cargaData_arreglo($arregloFunciones, $nuevoteatro, $posFuncion, $funcionBuscada,  $nuevaFuncion);
        }
        $nuevaFuncion->cargar($array_teatro);
        $nuevaFuncion->modificar();
        // $respuesta = $modificarobrateatro->insertar();
        if ($respuesta == true) {
            echo "\nOP INSERCION;  de la funcion fue ingresada en la BD \n";
        } else {
            echo $nuevoteatro->getmensajeoperacion();
        }
    } else {
        echo "No se registran funciones de Obra de teatro cargas!!\n";
    }
}
///funcion modifica la obra del cine
function modificarobracine($nuevoteatro)
{

    $nuevaFuncion = new obraCine();
    $colrespuesta = $nuevaFuncion->listar();

    if (count($colrespuesta) > 0) {
        //aca iria conexion BD para buscar

        foreach ($colrespuesta as $unaTeatro) {
            echo $unaTeatro;
            echo "\n-------------------------------------------------------\n";
        }

        $nuevoteatro->setarregloFunciones($colrespuesta);
        $array_cine = [];
        echo "Ingrese el id de la obra de la funcion obra de cine que quiere cambiar: ";
        $funcionBuscada = trim(fgets(STDIN));

        $respuesta = $nuevaFuncion->Buscar($funcionBuscada);
        $idteatro = $nuevoteatro->getidteatro();
        //Retorno la posicion en que se encuentra la funcion
        $posFuncion = $nuevoteatro->existeFuncion($nuevaFuncion->getNombre());

        if ($posFuncion == -1) {
            echo "El nombre de la funcion no se encuentra\n";
        } else {

            $arregloFunciones = $nuevoteatro->getarregloFunciones();

            $array_cine =  cargaData_arreglo($arregloFunciones, $nuevoteatro, $posFuncion, $funcionBuscada,  $nuevaFuncion);
        }

        $nuevaFuncion->cargar($array_cine);
        $nuevaFuncion->modificar();
        // $respuesta = $modificarobrateatro->insertar();
        if ($respuesta == true) {
            echo "\nOP INSERCION;  de la funcion fue ingresada en la BD \n";
        } else {
            echo $nuevoteatro->getmensajeoperacion();
        }
    } else {
        echo "No se registran funciones de Obra de cine cargas!!\n";
    }
}

//funcion modifica la funcion musical
function modificarobramusical($nuevoteatro)
{
    //aca iria conexion BD para buscar
    $nuevaFuncion = new obraMusical();
    $colrespuesta = $nuevaFuncion->listar();

    if (count($colrespuesta) > 0) {
        foreach ($colrespuesta as $unaTeatro) {
            echo $unaTeatro;
            echo "\n-------------------------------------------------------\n";
        }

        $nuevoteatro->setarregloFunciones($colrespuesta);
        $array_musical = [];
        echo "Ingrese el id de la obra de la funcion obra musical que quiere cambiar: ";
        $funcionBuscada = trim(fgets(STDIN));

        $respuesta = $nuevaFuncion->Buscar($funcionBuscada);
        //$idteatro = $nuevoteatro->getidteatro();
        //Retorno la posicion en que se encuentra la funcion
        $posFuncion = $nuevoteatro->existeFuncion($nuevaFuncion->getNombre());

        if ($posFuncion == -1) {
            echo "El nombre de la funcion no se encuentra\n";
        } else {

            $arregloFunciones = $nuevoteatro->getarregloFunciones();

            $array_musical =  cargaData_arreglo($arregloFunciones, $nuevoteatro, $posFuncion, $funcionBuscada, $nuevaFuncion);
        }

        $nuevaFuncion->cargar($array_musical);
        $nuevaFuncion->modificar();
        // $respuesta = $modificarobrateatro->insertar();
        if ($respuesta == true) {
            echo "\nOP INSERCION;  de la funcion fue ingresada en la BD \n";
        } else {
            echo $nuevoteatro->getmensajeoperacion();
        }
    } else {
        echo "No se registran funciones de Obra musical cargas!!\n";
    }
}

function cargaData_arreglo($arregloFunciones, $nuevoteatro, $posFuncion, $funcionBuscada, $nuevaFuncion)
{
    $array_teatro = [];
    //aca se cambia el nombre
    echo "Ingrese el nombre por el que desea cambiarlo: ";
    $nuevoNombre = trim(fgets(STDIN));
    $arregloFunciones[$posFuncion]->setNombre($nuevoNombre);
    //aca se cambia el precio     
    echo "Ingrese el precio por el que desea cambiarlo: ";
    $nuevoPrecio = trim(fgets(STDIN));
    $arregloFunciones[$posFuncion]->setPrecio($nuevoPrecio);
    //aca se cambia la hora
    $f = $arregloFunciones[$posFuncion];

    do {
        echo "Ingrese el nuevo horario por el que desea cambiar (hs:min): ";
        $nuevoHorario = $nuevoteatro->corroborarHorario();
        $f->setHoraInicio($nuevoHorario);
        echo "Ingrese el nuevo horario de duracion que desea cambiar (hs:min): ";
        $nuevaDuracion = $nuevoteatro->corroborarHorario();
        $f->setDuracion($nuevaDuracion);

        $array_cambio = [
            'id' =>  $f->getidFuncion(),
            'nombre_funcion' => $f->getNombre(),
            'precio' =>   $f->getPrecio(),
            'horario_inicio' =>  $f->getHoraInicio(),
            'duracion' =>  $f->getDuracion(),
            'objTeatro' => $f->getObjeTeatro(),
        ];

        $controlSolapamiento = $nuevoteatro->controlSolapamiento($array_cambio, get_class($nuevaFuncion) );
    } while ($controlSolapamiento);
    //aca se modificar la hs de duracion
    $arregloFunciones[$posFuncion] = $f;

    if (is_a($nuevaFuncion, 'obrateatro')) {
        //$nuevoteatro->setarregloFunciones($arregloFunciones);

        $f = $arregloFunciones[$posFuncion];

        $array_teatro = [
            'id' =>  $f->getidFuncion(),
            'nombre_funcion' => $f->getNombre(),
            'precio' =>   $f->getPrecio(),
            'horario_inicio' =>  $f->getHoraInicio(),
            'duracion' =>  $f->getDuracion(),
            'objTeatro' => $f->getObjeTeatro(),
        ];
    } elseif (is_a($nuevaFuncion, 'obracine')) {

        echo "(*) Ingrese el genero de la pelicula: \n";
        $genero = trim(fgets(STDIN));
        $arregloFunciones[$posFuncion]->setGenero($genero);
        echo "(*) Ingrese el pais de origen de la pelicula: \n";
        $paisOrigen = trim(fgets(STDIN));
        $arregloFunciones[$posFuncion]->setPaisOrigen($paisOrigen);

        //$nuevoteatro->setarregloFunciones($arregloFunciones);
        $f = $arregloFunciones[$posFuncion];
        //se carga en el $param 
        $array_teatro = [
            'id' =>  $f->getidFuncion(),
            'nombre_funcion' => $f->getNombre(),
            'precio' =>   $f->getPrecio(),
            'horario_inicio' =>  $f->getHoraInicio(),
            'duracion' =>  $f->getDuracion(),
            'objTeatro' => $f->getObjeTeatro(),
            'genero' =>  $f->getGenero(),
            'paisorigen' => $f->getPaisOrigen(),
        ];
    } elseif (is_a($nuevaFuncion, 'obramusical')) {

        echo "(*) Ingrese el nombre del director: \n";
        $director = trim(fgets(STDIN));
        $arregloFunciones[$posFuncion]->setDirector($director);
        echo "(*) Ingrese la cantidad de personas en escena: \n";
        $personaEscenario = trim(fgets(STDIN));
        $arregloFunciones[$posFuncion]->setCantPersonasEscena($personaEscenario);

        // $nuevoteatro->setarregloFunciones($arregloFunciones);
        $f = $arregloFunciones[$posFuncion];
        $array_teatro = [
            'id' =>  $f->getidFuncion(),
            'nombre_funcion' => $f->getNombre(),
            'precio' =>   $f->getPrecio(),
            'horario_inicio' =>  $f->getHoraInicio(),
            'duracion' =>  $f->getDuracion(),
            'objTeatro' => $f->getObjeTeatro(),
            'director' =>  $f->getDirector(),
            'cantidadPersona' => $f->getCantPersonasEscena(),
        ];
    }
    return $array_teatro;
}


//metodo para remove teatro 
function removeTeatro($teatro)
{
    $respuesta = "";

    $arrayTeatro =  $teatro->listar();
    //mostrar la lista de teatros
    if (count($arrayTeatro) > 0) {

        foreach ($arrayTeatro as $unaTeatro) {
            echo $unaTeatro . "\n";
            echo "\n-------------------------------------------------------\n";
        }
    } else {
        echo "\n\tNo hay regitros del teatro seleccionado.\n";
    }
    //se selecciona el teatro que se desea remove
    echo "Ingrese el nombre del teatro a eliminar. \n";
    $nombreIngresado = trim(fgets(STDIN));

    //primer if chequeo si es string
    if (is_null($nombreIngresado)) {
        echo "El dato ingresado no es el correcto, Seleccione el teatro que desea eliminar. \n";
        foreach ($arrayTeatro as $unaTeatro) {
            echo $unaTeatro . "\n";
            echo "\n-------------------------------------------------------\n";
        }
        $nombreIngresado = trim(fgets(STDIN));
    } else {

        $teatro->Buscar($nombreIngresado);
        //se adjunta a una variable el id seleccionado 
        $id_get =  $teatro->getidteatro();
    
        $teatro->setarregloFunciones($array=[]);
        $arrayFunciones = $teatro->getarregloFunciones();

         $arrayNuevoFunciones = [];

        foreach ($arrayFunciones as $key) {

            $objteatro = $key->getObjeTeatro();

            if ($objteatro->getidteatro() == $id_get) {
                 array_push($arrayNuevoFunciones, $objteatro);
            }
            
        }

        //si en el array no hay registro de funciones se procede a eliminar directamente el teatro seleccionado
        if (count($arrayNuevoFunciones) == 0) {
            $nombreTeatro = $teatro->getNombre();
            $resp = $teatro->eliminar();
            if ($resp == true) {
                echo "\e[41m>>> Se elimino correctamente el teatro: \e[0m " . $nombreTeatro . "\n";
            }
        } else {
            $registro = count($arrayNuevoFunciones);
            $nombreTeatro = $teatro->getNombre();
            $respuesta = "\e[41m>>> El teatro " . $nombreTeatro . " posee " . $registro . " reguistros, primero elimine las funciones del teatro seleccionado: \n\t\tINGRESE OPCION 8 \e[0m\n";
        } //cierre primer if

        return $respuesta;
    } //-----fin function remove teatro


}
